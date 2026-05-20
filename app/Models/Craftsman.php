<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Craftsman extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'address',
        'latitude',
        'longitude',
        'capacity',
        'price',
        'wa',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}