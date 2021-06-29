<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;

use App\Models\Challenge;
use App\Models\Activity;
use Illuminate\Notifications\Notifiable;

class User extends Authenticable
{
    use HasFactory;
    use Notifiable;

    protected $table = "users";

    protected $primaryKey = 'user_ID';

    protected $fillable = [
        'username',
        'email',
        'password', 
        'role',
        'last_login_at',
        'last_login_ip',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    
    protected $username = 'username';
    
    //Determine if admin
    public function isAdmin() {
        return ($this->role == 1);
    }


    // Ambil data dari field yang bersangkutan
    public function detail() {
        return $this->hasOne('App\Models\\'.ucfirst($this->user_type));
    }


    public function challenge(){//FK
        return $this->morphToMany(Challenge::class);//Challenge has users, user can have multiple challenges
    }

    public function activities(){//FK
        return $this->HasMany(Activity::class);
    }





}

