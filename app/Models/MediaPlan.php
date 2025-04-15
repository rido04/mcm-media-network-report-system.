<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaPlan extends Model
{
    protected $fillable = [
        'media',
        'start_date',
        'end_date',
        'remaining_days',
        'total_impression',
    ];
}
