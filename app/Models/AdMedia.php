<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AdMedia extends Model
{
    //

    protected $fillable = [
        'user_id',
        'media_statistic_id',
        'image_path',
        'title',
        'description',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image_path ? Storage::url($this->image_path) : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mediaStatistic()
    {
        return $this->belongsTo(MediaStatistic::class, 'media_statistic_id');
    }
}
