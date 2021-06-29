<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Challenge_Measurements;
use App\Models\SportsType;
use App\Models\Subscription;


class Challenge extends Model
{
    protected $table = "challenge";

    use HasFactory;

    public function challenge_measurements(){//FK
        return $this->hasMany(Challenge_Measurements::class);//Challenge has many activities
    } 
    
    public function subscriptions(){//FK
        return $this->hasMany(Subscription::class);//Challenge has many activities
    } 
    
    public function sportsTypes(){//FK
        return $this->belongsTo(SportsType::class);//Challenge has many activities
    } 
    // public function users(){//FK
    //     return $this->morphToMany(User::class);//Challenge has users, user can have multiple challenges
    // }
    
}
