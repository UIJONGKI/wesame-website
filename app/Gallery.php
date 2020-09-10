<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
    	'title',
    	'content',
    ];
    protected $hidden = [
        'user_id',
        'notification',
        'deleted_at',
    ];

    protected $with = ['user'];
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function gtags()
    {
    	return $this->belongsToMany(Gtag::class);
    }

    public function attachments()
    {
        return $this->hasMany(Gallery_Attachment::class);
    }
    public function gcomments()
    {
        return $this->morphMany(Gcomment::class, 'commentable');
    }
    public function getCommentCountAttribute()
    {
        return (int) $this->gcomments->count();
    }
}
