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
        'type',
        'thumbnail_path',
        'link_video',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getYoutubeEmbedUrlAttribute(): ?string
    {
        if (!$this->link_video) {
            return null;
        }

        // Extract video ID from YouTube URL
        $pattern = '/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
        preg_match($pattern, $this->link_video, $matches);

        if (isset($matches[1])) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return $this->link_video;
    }
}
