<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image',
        'sort_order',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getImageAttribute($value)
    {
        // If the value is already a full URL, return it as-is.
        if (preg_match('/^https?:\/\//', $value)) {
            return $value;
        }
        // If the value already starts with /storage/, it's already a public URL path
        if (preg_match('#^/storage/#', $value)) {
            return $value;
        }
        // If we're using the vercel disk, the path is already relative to /storage
        if ((env('IS_NOW') || env('VERCEL')) && !empty($value)) {
            return '/storage/' . $value;
        }
        // Otherwise, assume it's a relative path from the storage disk and return the full URL.
        return \Illuminate\Support\Facades\Storage::url($value);
    }
}