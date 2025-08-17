<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    const STATUS_ADDRESS_PENDING = 'address_pending';
    const STATUS_COMPLETED = 'completed';

    protected $fillable = [
        'user_id',
        'item_id',
        'content',
        'postal_code',
        'address',
        'building',
        'status',

    ];

    public function items()
    {
        return $this->belongsTo(Item::class);
    }
    public function isCompleted()
    {
        return $this->status === self::STATUS_COMPLETED;
    }
}
