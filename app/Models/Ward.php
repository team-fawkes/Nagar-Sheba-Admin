<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ward extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'zone_id',
        'name_en',
        'name_bn',
    ];

    public function zone(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function councilors(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Councilor::class);
    }
}
