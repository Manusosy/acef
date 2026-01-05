<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimelineAchievement extends Model
{
    protected $fillable = [
        'timeline_year_id',
        'title',
        'description',
        'location',
        'images',
        'is_visible',
        'order'
    ];

    protected $casts = [
        'images' => 'array',
        'is_visible' => 'boolean',
        'order' => 'integer'
    ];

    public function year()
    {
        return $this->belongsTo(TimelineYear::class, 'timeline_year_id');
    }
}
