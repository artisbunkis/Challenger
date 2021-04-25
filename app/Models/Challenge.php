<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Activity;

class Challenge extends Model
{
    use HasFactory;
    public function activities(){//FK
        return $this->hasMany(Activity::class);//Challenge has many activities
    }
    public function users(){//FK
        return $this->morphToMany(User::class);//Challenge has users, user can have multiple challenges
    }
    
}
