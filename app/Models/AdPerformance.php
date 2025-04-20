<?php

/**
 * THIS MODEL IS FOR CATEGORY MANAGEMENT
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdPerformance extends Model
{
    protected $fillable = [
        'admin_traffic_id',
        'used_placement',
        'available_placement',
        'media_statistic_id',
    ];

    public function adminTraffic()
    {
        return $this->belongsTo(AdminTraffic::class);
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, AdminTraffic::class, 'id', 'id', 'admin_traffic_id', 'user_id');
    }

    public function mediaStatistic()
    {
        return $this->belongsTo(MediaStatistic::class);
    }
}
