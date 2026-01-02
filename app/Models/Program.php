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
}
