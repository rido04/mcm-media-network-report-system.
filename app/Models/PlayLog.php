<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayLog extends Model
{
    protected $fillable = [
        'device_id',
        'media_name',
        'playdate',
        'longitude',
        'latitude',
        'location',
        'user_id'
    ];
}
