<?php
/**
 * THIS MODEL IS FOR PLAY LOGS MANAGEMENT
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayLog extends Model
{
    protected $fillable = [
        'device_id',
        'media_name',
        'play_date',
        'longitude',
        'latitude',
        'location',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
