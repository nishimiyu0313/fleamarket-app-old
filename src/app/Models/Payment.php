<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'content',
        'postal_code',
        'address',
        'building',

    ];

    public function items()
    {
        return $this->belongsTo(Item::class);
    }
}
