<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Activity;

class Activity_Measurements extends Model
{
    use HasFactory;

    protected $table = 'activity_measurements';

    public function activities(){
        return $this->belongsTo(Activity::class);
    }

}
