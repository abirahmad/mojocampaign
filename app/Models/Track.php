<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Track extends Model
{

    /**
     * newTrack
     *
     * @param string $title
     * @param string $description
     * @return void Create new track entry after any action
     */
    public static function newTrack($title, $description)
    {
        $track = new Track();
        $track->title = $title;
        $track->description = $description;
        $track->user_id = Auth::id();
        $track->save();
    }
}
