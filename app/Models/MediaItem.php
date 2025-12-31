<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MediaItem extends Model
{
    protected $fillable = [
        'filename',
        'original_filename',
        'path',
        'disk',
        'mime_type',
        'size',
        'hash',
        'alt_text',
        'caption',
        'uploaded_by',
    ];

    protected $casts = [
        'size' => 'integer',
    ];

    protected $appends = ['url', 'thumbnail_url', 'size_formatted'];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function heroSlides()
    {
        return $this->hasMany(HeroSlide::class, 'media_id');
    }

    public function getUrlAttribute()
    {
        return Storage::disk($this->disk)->url($this->path);
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->url;
    }

    public function getSizeFormattedAttribute()
    {
        $bytes = $this->size;
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' bytes';
    }

    public static function findByHash(string $hash): ?self
    {
        return static::where('hash', $hash)->first();
    }

    public static function hashFile($file): string
    {
        return hash_file('sha256', $file->getRealPath());
    }

    public function getUsageCount(): int
    {
        return $this->heroSlides()->count();
    }

    public function scopeImages($query)
    {
        return $query->where('mime_type', 'like', 'image/%');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
