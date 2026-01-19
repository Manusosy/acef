<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\MediaItem;

class WhoWeAreImage extends Model
{
    protected $fillable = [
        'media_id',
        'country',
        'caption',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function media(): BelongsTo
    {
        return $this->belongsTo(MediaItem::class, 'media_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }
}
