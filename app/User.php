<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'confirm_code', 'activated', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'confirm_code', 'password', 'remember_token',
    ];

    protected $dates = ['last_login'];

    protected $casts = ['activated' => 'boolean',];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function boards()
    {
        return $this->hasMany(Board::class);
    }

    public function scopeSocialUser($query, $email)
    {
        return $query->whereEmail($email)->whereNull('password');
    }

    public function isAdmin()
    {
        return($this->email === "kidult.wesame@gmail.com") ? true : false;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function gcomments()
    {
        return $this->hasMany(Gcomment::class);
    }
}

