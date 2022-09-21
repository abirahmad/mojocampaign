<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QustionAnswer extends Model
{
    public function response()
    {
        return $this->belongsTo(Response::class);
    }
}
