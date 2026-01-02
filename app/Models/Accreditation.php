<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accreditation extends Model
{
    protected $fillable = [
        'title',
        'description',
        'acronym',
        'image'
    ];
}
