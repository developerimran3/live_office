<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

trait FileUpload
{
    /**
     * Handle file upload with replace logic
     *
     * @param mixed  $newFile      Livewire uploaded file
     * @param string|null $oldFile Existing file path
     * @param string $folder       Storage folder
     * @param string|null $filenameBase Filename without extension
     *
     * @return string|null
     */
    public function fileUpload($newFile, $oldFile = null, $folder = 'documents', $filenameBase = null)
    {
        // নতুন file না থাকলে → পুরনোটাই return
        if (!$newFile instanceof TemporaryUploadedFile) {
            return $oldFile;
        }

        // পুরনো file delete
        if ($oldFile && Storage::disk('public')->exists($oldFile)) {
            Storage::disk('public')->delete($oldFile);
        }

        // Extension
        $extension = $newFile->getClientOriginalExtension();

        // Filename
        $filename = $filenameBase
            ? $filenameBase . '.' . $extension
            : uniqid() . '.' . $extension;

        // Store
        return $newFile->storeAs($folder, $filename, 'public');
    }
}
