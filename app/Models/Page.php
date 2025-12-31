<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'template',
        'meta_title',
        'meta_description',
        'is_published',
        'has_hero',
        'hero_slider_enabled',
        'hero_slider_delay',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'has_hero' => 'boolean',
        'hero_slider_enabled' => 'boolean',
        'hero_slider_delay' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    public function sections()
    {
        return $this->hasMany(PageSection::class)->orderBy('sort_order');
    }

    public function heroSlides()
    {
        return $this->hasMany(HeroSlide::class)->orderBy('sort_order');
    }

    public function activeHeroSlides()
    {
        return $this->heroSlides()->where('is_active', true);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function getMetaTitleAttribute($value)
    {
        return $value ?: $this->title;
    }
}
