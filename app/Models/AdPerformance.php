<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdPerformance extends Model
{
    protected $fillable = [
        'admin_traffic_id',
        'date',
        'performance',
    ];

    public function adminTraffic()
    {
        return $this->belongsTo(AdminTraffic::class);
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, AdminTraffic::class, 'id', 'id', 'admin_traffic_id', 'user_id');
    }
}
