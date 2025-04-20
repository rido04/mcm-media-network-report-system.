<?php
/**
 * THIS MODEL IS FOR MEDIA PLACEMENT MANAGEMENT
 */
namespace App\Models;

use App\Models\DailyImpression;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MediaPlacement extends Model
{
    protected $fillable = [
        'admin_traffic_id',
        'user_id',
        'daily_impression_id',
        'avg_daily_impression',
        'media',
        'size',
        'space_ads',
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

    public function dailyImpressions(): HasMany
    {
        return $this->hasMany(DailyImpression::class);
    }
    public function dailyImpression()
    {
        return $this->belongsTo(DailyImpression::class);
    }

}
