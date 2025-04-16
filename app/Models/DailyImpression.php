<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyImpression extends Model
{
    protected $fillable = ['admin_traffic_id','media_statistic_id', 'date', 'impression'];
    protected $casts = [
        'date' => 'date',
    ];


    public function adminTraffic(): BelongsTo
    {
        return $this->belongsTo(AdminTraffic::class);
    }

    public function user()
    {
        return $this->adminTraffic->user();
    }

    public function mediaStatistic()
    {
        return $this->belongsTo(MediaStatistic::class);
    }
}
