<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Councilor extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'ward_id',
        'name_en',
        'name_bn',
        'title_en',
        'title_bn',
        'parliament_members_en',
        'parliament_members_bn',
        'details_en',
        'details_bn',
        'image',
        'phone',

    ];

    public function ward(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

}
