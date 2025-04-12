<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyImpression extends Model
{
    protected $fillable = ['admin_traffic_id', 'date', 'impression'];

    public function adminTraffic(): BelongsTo
    {
        return $this->belongsTo(AdminTraffic::class);
    }

    public function user()
    {
        return $this->adminTraffic->user();
    }
}
