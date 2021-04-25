<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;

class User extends Authenticable
{
    use HasFactory;

    protected $table = "users";

    protected $primaryKey = 'user_ID';

    protected $fillable = [
        'username',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $username = 'username';
    


    // Ambil data dari field yang bersangkutan
    public function detail() {
        return $this->hasOne('App\Models\\'.ucfirst($this->user_type));
    }

}

