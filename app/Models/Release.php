<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    protected $fillable = [
        'title',
        'artist',
        'cover_path',
        'spotify_url',
        'soundcloud_url',
        'apple_url',
        'youtube_url',
    ];
}
