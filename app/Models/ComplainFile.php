<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComplainFile extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'complain_id',
        'file_path',
    ];

    public function complain()
    {
        return $this->belongsTo(Complain::class);
    }
}
