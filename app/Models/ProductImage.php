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
        $isVercel = (getenv('IS_NOW') !== false || getenv('VERCEL') !== false ||
                     isset($_SERVER['IS_NOW']) || isset($_SERVER['VERCEL']) ||
                     (isset($_SERVER['VC_ENTRYPOINT']) && $_SERVER['VC_ENTRYPOINT'] === '1'));
        if ($isVercel && !empty($value)) {
            return '/storage/' . $value;
        }
        // Otherwise, assume it's a relative path from the storage disk and return the full URL.
        return \Illuminate\Support\Facades\Storage::url($value);
    }
}