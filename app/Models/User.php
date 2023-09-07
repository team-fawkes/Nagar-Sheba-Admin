<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'unique_id',
        'name',
        'phone',
        'password',
        'dob',
        'gender',
        'image',
        'language',
        'sound',
        'notification',
        'status',
        'emergency_person_name',
        'emergency_person_contact',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'password' => 'hashed',
    ];
    protected static function booted()
    {
        static::creating(function ($user) {
            do {
                $uniqueId = 'UID' . strtoupper(Str::random(5));
            } while (static::where('unique_id', $uniqueId)->exists());

            $user->unique_id = $uniqueId;
        });
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function complains()
    {
        return $this->hasMany(Complain::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }


}
