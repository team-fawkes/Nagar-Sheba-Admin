<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Complain extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'service_category_id',
        'user_id',
        'complain_id',
        'title',
        'description',
        'latitude',
        'longitude',
        'picture',
        'voice',
        'video',
        'gallery',
        'status',
        'received_at',
        'solved_at',
        'observed_at',
    ];

    protected $dates = ['received_at', 'solved_at', 'observed_at'];

    protected static function booted()
    {
        static::creating(function ($complain) {
            do {
                $complainId = 'COM' . strtoupper(Str::random(5));
            } while (static::where('complain_id', $complainId)->exists());

            $complain->complain_id = $complainId;
        });
    }

    // Define the relationship with ServiceCategory
    public function service_category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class);
    }
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function files()
    {
        return $this->hasMany(ComplainFile::class);
    }
}
