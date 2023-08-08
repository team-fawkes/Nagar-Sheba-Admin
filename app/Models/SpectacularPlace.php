<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpectacularPlace extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name_en',
        'name_bn',
        'thumbnail',
        'details_en',
        'details_bn',
        'gallery',
        'latitude',
        'longitude',
        'established_at',
    ];
    protected $casts = [
        'gallery' => 'array',
    ];
}
