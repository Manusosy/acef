<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'website',
        'category',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($partner) {
            if (empty($partner->slug)) {
                $partner->slug = Str::slug($partner->name);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    public function scopeStrategic($query)
    {
        return $query->where('category', 'strategic');
    }

    public function scopeInstitutional($query)
    {
        return $query->where('category', 'institutional');
    }

    public function scopeImplementation($query)
    {
        return $query->where('category', 'implementation');
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'partner_program');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'partner_project');
    }
}
