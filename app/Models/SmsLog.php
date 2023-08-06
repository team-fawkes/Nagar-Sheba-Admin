<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmsLog extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'phone',
        'msg',
        'sender_id',
        'type',
        'status',
    ];
}
