<?php

namespace App\Traits;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
trait HandlesImage
{
     /**
     * Upload an image to the specified directory.
     *
     * @param UploadedFile $image
     * @param string $directory
     * @return string|null
     */
    public function uploadImage(UploadedFile $image, string $directory = 'products')
    {
        if ($image) {
            $imagePath = $image->store($directory, 'public');
            return $imagePath;
        }
        return null;
    }

    /**
     * Delete an existing image.
     *
     * @param string|null $imagePath
     * @return void
     */
    public function deleteImage(?string $imagePath)
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }
}
