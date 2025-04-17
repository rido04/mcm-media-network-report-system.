<?php
/**
 * THIS MODEL IS FOR CATEGORY MANAGEMENT
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdminTraffic extends Model
{
    protected $table = 'admin_traffic';
    protected $fillable = ['category', 'user_id'];

    public function dailyImpressions(): HasMany
    {
        return $this->hasMany(DailyImpression::class);
    }

    public function getHighestImpressionAttribute(): int
    {
        return $this->dailyImpressions()->max('impression') ?? 0;
    }

    public function getLowestImpressionAttribute(): int
    {
        return $this->dailyImpressions()->min('impression') ?? 0;
    }

    public function getAverageImpressionAttribute(): float
    {
        return $this->dailyImpressions()->avg('impression') ?? 0.0;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function adPerformances()
    {
        return $this->hasMany(AdPerformance::class, 'admin_traffic_id');
    }

    public function dailyImpression()
    {
        return $this->hasMany(DailyImpression::class, 'admin_traffic_id');
    }
}
