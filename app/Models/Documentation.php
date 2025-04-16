<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    protected $fillable = [
        'user_id',
        'image_path',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
