<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = ['page_id', 'section_key', 'content', 'image_path', 'type'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
