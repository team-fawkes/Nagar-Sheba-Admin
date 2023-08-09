<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name_en',
        'name_bn',
    ];


    public function wards(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Ward::class);
    }
}
