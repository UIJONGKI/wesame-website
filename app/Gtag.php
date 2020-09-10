<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gtag extends Model
{
    protected $fillable = ['name', 'slug'];

    public function galleries()
    {
    	return $this->belongsToMany(Gallery::class);
    }
}
