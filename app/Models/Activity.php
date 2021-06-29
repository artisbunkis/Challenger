<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Activity_Measurements;
use App\Models\SportsType;


class Activity extends Model
{
    use HasFactory;

    public function users(){//FK
        return $this->belongsTo(User::class);//User has many activities
    }
    public function activity_measurements(){
        return $this->hasMany(Activity_Measurements::class);//activity has many measurements
    }
    public function sports_types(){
        return $this->hasOne(SportsType::class);
    }


}
