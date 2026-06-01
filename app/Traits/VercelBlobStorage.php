<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

trait VercelBlobStorage
{
    /**
     * Upload file to Vercel Blob storage using REST API.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $folder
     * @return string  Public URL or local path
     */
    public function uploadToVercelBlob(UploadedFile $file, string $folder = ''): string
    {
        // Determine if we are on Vercel
        $isVercel = (getenv('VERCEL') !== false || ($_SERVER['VERCEL'] ?? null) === '1');

        if (! $isVercel) {
            // Local development: use local storage
            return $file->store($folder, 'public');
        }

        $token = getenv('BLOB_READ_WRITE_TOKEN');
        $storeId = getenv('BLOB_STORE_ID');

        if (! $token || ! $storeId) {
            Log::warning('Vercel Blob credentials missing. Falling back to local storage.');
            return $file->store($folder, 'public');
        }

        try {
            // Generate unique filename
            $filename = Str::uuid() . '_' . $file->getClientOriginalName();
            // Ensure folder does not start or end with slash
            $folder = trim($folder, '/');
            $folder = $folder === '' ? $filename : "{$folder}/{$filename}";
            $url = "https://{$storeId}.blob.vercel-storage.com/{$folder}?access=public";

            // Read file content
            $fileContent = file_get_contents($file->getRealPath());

            // Upload to Vercel Blob
            $response = Http::withToken($token)
                ->withHeader('Content-Type', $file->getMimeType())
                ->withHeader('Content-Disposition', 'inline; filename="' . $file->getClientOriginalName() . '"')
                ->put($url, $fileContent);

            if ($response->successful()) {
                $result = $response->json();
                return $result['url'] ?? "https://{$storeId}.public.blob.vercel-storage.com/{$folder}";
            } else {
                Log::error('Vercel Blob upload failed: HTTP ' . $response->status() . ' - ' . $response->body());
            }
        } catch (\Throwable $e) {
            Log::error('Vercel Blob upload exception: ' . $e->getMessage());
        }

        // Fallback to local storage on any error
        return $file->store($folder, 'public');
    }

    /**
     * Delete file from Vercel Blob storage.
     *
     * @param  string  $url  Public URL of the blob
     * @return void
     */
    public function deleteFromVercelBlob(string $url): void
    {
        if (! filter_var($url, FILTER_VALIDATE_URL) || ! str_contains($url, 'blob.vercel-storage.com')) {
            return;
        }

        $token = getenv('BLOB_READ_WRITE_TOKEN');
        if (! $token) {
            Log::warning('BLOB_READ_WRITE_TOKEN not set. Cannot delete from Vercel Blob.');
            return;
        }

        try {
            // Extract pathname from URL
            $parsedUrl = parse_url($url);
            if (! $parsedUrl || ! isset($parsedUrl['path'])) {
                return;
            }
            $pathname = ltrim($parsedUrl['path'], '/');

            // Vercel Blob delete API
            $apiUrl = 'https://api.vercel.com/v2/blobs';

            Http::withToken($token)
                ->delete($apiUrl, [
                    'pathname' => $pathname,
                ]);
        } catch (\Throwable $e) {
            Log::error('Vercel Blob delete exception: ' . $e->getMessage());
        }
    }

    /**
     * Delete file (local or Vercel Blob).
     *
     * @param  string  $diskOrUrl  Disk name or public URL
     * @return void
     */
    public function deleteStorageFile(string $diskOrUrl): void
    {
        if (filter_var($diskOrUrl, FILTER_VALIDATE_URL) && str_contains($diskOrUrl, 'blob.vercel-storage.com')) {
            $this->deleteFromVercelBlob($diskOrUrl);
            return;
        }

        // Treat as disk path (relative to storage)
        // We assume disk is 'public' for simplicity; if needed, can be made configurable
        $disk = 'public';
        if (Storage::disk($disk)->exists($diskOrUrl)) {
            Storage::disk($disk)->delete($diskOrUrl);
        }
    }
}