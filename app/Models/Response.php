<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(QustionAnswer::class);
    }

    public function correct_answers()
    {
        return $this->hasMany(QustionAnswer::class)->where('is_correct', 1);
    }
}
