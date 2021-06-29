<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Challenge;
use App\Models\Activity;

class SportsType extends Model
{
    protected $table = "sports_type";
    use HasFactory;

    public function challenges() {//FK
        return $this->hasMany(Challenge::class);
    }

    public function activities() {//FK
        return $this->hasMany(Activity::class);
    }
}
