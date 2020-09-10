<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'content',
        'notification',
        'view_count',
    ];

    protected $hidden = [
        'user_id',
        'notification',
        'deleted_at',
        'artists',
        'advisors',
        'admin',
    ];

    protected $with = ['user'];

    protected $dates = [
        'deleted_at'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function tags()
    {
    	return $this->belongsToMany(Tag::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function getCommentCountAttribute()
    {
        return (int) $this->comments->count();
    }
}
