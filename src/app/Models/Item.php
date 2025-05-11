<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'condition_id',
        'name',
        'brand_name',
        'description',
        'price',
        'image'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_item');
    }

    public function conditions()
    {
        return $this->belongsTo(Condition::class);
    }
}
