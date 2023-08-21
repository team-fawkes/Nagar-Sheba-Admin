<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'bill_id',
        'invid',
        'amount',
        'trxid',
        'billing_period',
        'reference_id',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($invoice) {
            do {
                $invId = 'INV' . strtoupper(Str::random(5));
            } while (static::where('invid', $invId)->exists());

            $invoice->invid = $invId;
        });
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bill(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Bill::class);
    }
}
