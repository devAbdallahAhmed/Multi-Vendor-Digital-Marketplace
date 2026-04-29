<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait FileUpload {

    public function uploadFile(UploadedFile $file, string $dir = 'uploads', string $disk = 'public')
    {
        try {
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . uniqid() . '.' . $extension;
            $path = $file->storeAs($dir, $fileName, $disk);
            return $path;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function deleteFile($path, $disk = 'public')
    {
        if ($path && Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
        }
    }
}
