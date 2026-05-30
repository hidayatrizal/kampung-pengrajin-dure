<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'url',
    ];

    public function getUrlAttribute($value)
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
        return Storage::url($value);
    }
}