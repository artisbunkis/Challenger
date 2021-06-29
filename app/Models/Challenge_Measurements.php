<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Challenge;
class Challenge_Measurements extends Model
{
    use HasFactory;

    protected $table = 'challenge_measurements';

    public function challenges(){
        return $this->belongsTo(Challenge::class);
    }
}
