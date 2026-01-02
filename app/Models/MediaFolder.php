<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MediaFolder extends Model
{
    protected $fillable = ['name', 'slug'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($folder) {
            if (empty($folder->slug)) {
                $folder->slug = Str::slug($folder->name);
            }
        });
    }

    public function mediaItems()
    {
        return $this->hasMany(MediaItem::class, 'folder_id');
    }
}
