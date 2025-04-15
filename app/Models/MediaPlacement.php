<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MediaPlacement extends Model
{
    protected $fillable = [
        'admin_traffic_id',
        'user_id',
        'media',
        'size',
        'space_ads',
        'daily_impression_id',
    ];

    // Di model MediaPlacement
    public function adminTraffic()
    {
        return $this->belongsTo(AdminTraffic::class);
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, AdminTraffic::class, 'id', 'id', 'admin_traffic_id', 'user_id');
    }
}
