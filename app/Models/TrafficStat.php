<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrafficStat extends Model
{
    protected $fillable = ['user_id', 'type', 'date', 'impression'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
