<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gcomment extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $fillable = ['commentable_type', 'commentable_id', 'user_id', 'parent_id', 'content'];

    protected $with = ['user',];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function commentable()
    {
    	return $this->morphTo();
    }

    public function replies()
    {
    	return $this->hasMany(Gcomment::class, 'parent_id')->latest();
    }

    public function parent()
    {
    	return $this->belongsTo(Gcomment::class, 'parent_id', 'id');
    }
}
