<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category_id', // Changed from category
        'image',
        'author_id',
        'is_featured',
        'status', // draft, pending, published
        'published_at',
        'tags',
        'read_time',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'tags' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getFormattedDateAttribute()
    {
        return $this->published_at?->format('F d, Y') ?? 'Draft';
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'published' => 'bg-emerald-100 text-emerald-700',
            'draft' => 'bg-gray-100 text-gray-700',
            'pending' => 'bg-amber-100 text-amber-700',
            default => 'bg-gray-100 text-gray-700',
        };
    }
}
