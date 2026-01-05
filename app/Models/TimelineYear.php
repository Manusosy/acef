<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimelineYear extends Model
{
    protected $fillable = ['year', 'order', 'is_visible'];
    
    protected $casts = [
        'is_visible' => 'boolean',
        'year' => 'integer',
        'order' => 'integer'
    ];

    public function achievements()
    {
        return $this->hasMany(TimelineAchievement::class)->orderBy('order', 'asc');
    }
}
