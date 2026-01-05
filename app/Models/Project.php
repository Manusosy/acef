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
        'location',
        'status',
        'goal_amount',
        'raised_amount',
        'image',
        'gallery',
        'objectives',
        'video_url',
        'programme_id',
        'start_date',
        'end_date',
        'is_featured',
        'is_active',
        'voices',
    ];

    protected $casts = [
        'goal_amount' => 'decimal:2',
        'raised_amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'country' => 'array',
        'gallery' => 'array',
        'objectives' => 'array',
        'voices' => 'array',
    ];

    public const CATEGORIES = [
        'Marine and Coastal Conservation',
        'Waste Management',
        'Climate Action',
        'Sustainable Agriculture',
        'Cultural Heritage Promotion',
        'Terrestrial Reforestation',
        'Wetland Protection',
        'Wildlife Conservation',
        'Ocean Literacy',
        'Green Skills',
        'Water Management',
        'Climate Smart Agriculture',
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

    public function getCountryNamesAttribute()
    {
        $allCountries = config('acef.countries', []);
        $selected = (array) ($this->country ?? []);
        
        return array_map(function($idx) use ($allCountries) {
            return $allCountries[$idx] ?? $idx;
        }, $selected);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function partners()
    {
        return $this->belongsToMany(Partner::class, 'partner_project');
    }

    public function programme()
    {
        return $this->belongsTo(Program::class, 'programme_id');
    }

    public function mediaFolders()
    {
        return $this->hasMany(MediaFolder::class);
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'ongoing' => 'bg-emerald-100 text-emerald-700',
            'completed' => 'bg-blue-100 text-blue-700',
            'starting' => 'bg-indigo-100 text-indigo-700',
            'pending' => 'bg-amber-100 text-amber-700',
            'draft' => 'bg-gray-100 text-gray-700',
            default => 'bg-gray-100 text-gray-700',
        };
    }
}
