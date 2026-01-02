<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'type',
        'category',
        'size',
        'year',
        'is_locked'
    ];

    protected $casts = [
        'is_locked' => 'boolean',
    ];
}
