<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'country',
        'status',
        'goal_amount',
        'raised_amount',
        'image',
        'start_date',
        'end_date',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'goal_amount' => 'decimal:2',
        'raised_amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function galleryItems()
    {
        return $this->hasMany(GalleryItem::class);
    }

    public function getProgressPercentAttribute()
    {
        if (!$this->goal_amount || $this->goal_amount == 0) {
            return 0;
        }
        return min(100, round(($this->raised_amount / $this->goal_amount) * 100));
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
