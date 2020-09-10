<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = ['filename', 'bytes', 'mime'];
    protected $hidden = [
        'article_id',
        'created_at',
        'updated_at',
    ];
    protected $appends = [
        'url',
    ];
    public function article()
    {
    	return $this->belongsTo(Article::class);
    }
    /* Accessors */
    public function getBytesAttribute($value)
    {
        return format_filesize($value);
    }
    public function getUrlAttribute()
    {
        return url('files/'.$this->filename);
    }
}
