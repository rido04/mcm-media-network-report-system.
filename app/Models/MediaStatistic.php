<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaStatistic extends Model
{
    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'media',
        'city',
];


public function user()
{
    return $this->belongsTo(User::class);
}

public function dailyImpressions()
{
    return $this->hasMany(DailyImpression::class);
}

}
