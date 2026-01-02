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
        'folder_id',
    ];

    public function folder()
    {
        return $this->belongsTo(MediaFolder::class, 'folder_id');
    }

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
        if (str_starts_with($this->mime_type, 'image/')) {
            return $this->url;
        }

        if ($this->mime_type === 'application/pdf') {
            return asset('images/icons/pdf-icon.png'); // I will assume this exists or use a generic SVG placeholder in blade
        }

        return asset('images/icons/file-icon.png');
    }

    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->format('F j, Y');
    }

    public function isImage(): bool
    {
        return str_starts_with($this->mime_type, 'image/');
    }

    public function isPdf(): bool
    {
        return $this->mime_type === 'application/pdf';
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
