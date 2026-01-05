<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'image',
        'hero_image',
        'impact_stories',
        'focus_areas',
        'status',
        'funding_goal',
        'funding_raised',
        'duration',
        'location',
        'factsheet',
        'category',
        'icon',
        'meta_val',
        'country',
        'stats',
    ];

    protected $casts = [
        'impact_stories' => 'array',
        'focus_areas' => 'array',
        'country' => 'array',
        'stats' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($program) {
            if (empty($program->slug)) {
                $program->slug = \Illuminate\Support\Str::slug($program->title);
            }
        });
    }

    public function partners()
    {
        return $this->belongsToMany(Partner::class, 'partner_program');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'programme_id');
    }

    public function mediaFolders()
    {
        return $this->hasMany(MediaFolder::class, 'programme_id');
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'published' => 'bg-emerald-100 text-emerald-700',
            'pending' => 'bg-amber-100 text-amber-700',
            'draft' => 'bg-gray-100 text-gray-700',
            'archived' => 'bg-red-100 text-red-700',
            default => 'bg-gray-100 text-gray-700',
        };
    }
}
