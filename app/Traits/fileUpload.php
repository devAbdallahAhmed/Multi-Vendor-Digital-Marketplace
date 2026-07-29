<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Exception;

trait FileUpload
{
    public function uploadFile(UploadedFile $file,  string $disk = 'local',string $dir = 'uploads')
    {
        try {
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . uniqid() . '.' . $extension;
            $path = $file->storeAs($dir, $fileName, $disk);
            return $path;
        } catch (Exception $e) {
            return null;
        }
    }

    public function uploadFileWithDetails(UploadedFile $file, string $dir = 'uploads/items',  $disk = 'local'): array
    {
        if (!in_array($disk, ['public', 'local'])) {
            throw new Exception('Invalid disk type');
        }

        try {
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . uniqid() . '.' . $extension;

            $file->storeAs($dir, $fileName, $disk);

            return [
                'name' => $file->getClientOriginalName(),
                'extension' => $extension,
                'path' => "/$dir/$fileName",
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
            ];
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function deleteFile($path, $disk = 'local')
    {
        $cleanPath = ltrim($path, '/');

        if ($disk === 'public') {
            if (File::exists(public_path($cleanPath))) {
                File::delete(public_path($cleanPath));
            }
        } else {
            if (File::exists(storage_path('app/private/' . $cleanPath))) {
                File::delete(storage_path('app/private/' . $cleanPath));
            }
        }
    }

    public function movePublicAsset(array $screenShots = [])
    {
        foreach ($screenShots as $filePath) {
            $storagePath = storage_path('app/private/' . $filePath);
            $publicTargetPath = public_path($filePath);

            if (File::exists($storagePath)) {
                $directory = dirname($publicTargetPath);
                if (!File::isDirectory($directory)) {
                    File::makeDirectory($directory, 0755, true, true);
                }

                File::move($storagePath, $publicTargetPath);
            }
        }
    }
}
