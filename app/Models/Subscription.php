<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Challenge;
use App\Models\User;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscription';

    public function challenges(){//FK
        return $this->belongsTo(Challenge::class);
    }

    public function users(){//FK
        return $this->belongsTo(User::class);
    }
}
