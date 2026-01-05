<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class CorePagesSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Home',
                'slug' => 'home',
                'template' => 'welcome',
                'has_hero' => true,
                'hero_slider_enabled' => true,
                'hero_slider_delay' => 5000,
            ],
            [
                'title' => 'About Us',
                'slug' => 'about',
                'template' => 'about',
                'has_hero' => true,
                'hero_slider_enabled' => false,
            ],
            [
                'title' => 'Programmes',
                'slug' => 'programmes',
                'template' => 'programmes',
                'has_hero' => true,
                'hero_slider_enabled' => false,
            ],
            [
                'title' => 'Projects',
                'slug' => 'projects',
                'template' => 'projects',
                'has_hero' => true,
                'hero_slider_enabled' => false,
            ],
            [
                'title' => 'Impact',
                'slug' => 'impact',
                'template' => 'impact',
                'has_hero' => true,
                'hero_slider_enabled' => false,
            ],
            [
                'title' => 'News',
                'slug' => 'news',
                'template' => 'news',
                'has_hero' => true,
                'hero_slider_enabled' => false,
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact',
                'template' => 'contact',
                'has_hero' => true,
                'hero_slider_enabled' => false,
            ],
            [
                'title' => 'Get Involved',
                'slug' => 'get-involved',
                'template' => 'get-involved',
                'has_hero' => true,
                'hero_slider_enabled' => false,
            ],
            [
                'title' => 'Gallery',
                'slug' => 'gallery',
                'template' => 'gallery',
                'has_hero' => true,
                'hero_slider_enabled' => false,
            ],
            [
                'title' => 'Team',
                'slug' => 'team',
                'template' => 'team',
                'has_hero' => true,
                'hero_slider_enabled' => false,
            ],
            [
                'title' => 'Partners',
                'slug' => 'partners',
                'template' => 'partners',
                'has_hero' => true,
                'hero_slider_enabled' => false,
            ],
        ];

        foreach ($pages as $pageData) {
            Page::updateOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );
        }
    }
}
