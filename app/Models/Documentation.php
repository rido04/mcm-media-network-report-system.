<?php
/**
 * THIS MODEL IS FOR DOCUMENTATION MANAGEMENT
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    public $timestamps = true;
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
