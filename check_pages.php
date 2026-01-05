<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Page;

$pages = Page::all(['id', 'title', 'slug', 'has_hero', 'hero_slider_enabled']);
foreach ($pages as $page) {
    echo "ID: {$page->id} | Title: {$page->title} | Slug: {$page->slug} | Hero: {$page->has_hero} | Slider: {$page->hero_slider_enabled}\n";
}
