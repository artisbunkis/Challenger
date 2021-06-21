<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Challenge;
use App\Models\User;


class Activity extends Model
{
    use HasFactory;
    public function challenge(){//FK
        return $this->belongsTo(Challenge::class);//Challenge has many activities
    }
    public function users(){//FK
        return $this->belongsTo(User::class);//User has many activities
    }
}
