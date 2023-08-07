<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bulletin extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable  = [
        'headline_en',
        'headline_bn',
        'order',
        'url',
        'status',
    ];
}
