<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DisasterAlert extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title_en',
        'title_bn',
        'details_en',
        'details_bn',
        'image',
        'file',
        'url',
        'status',
        'order',
    ];
}
