<?php

namespace App;

use App\Lien;
use App\Comment;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'email', 'employeur', 'job', 'github', 'twitter', 'github_id', 'avatar'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function liens() {
        return $this->hasMany(Lien::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
