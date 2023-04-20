<?php

namespace App\traits;

trait ImagesOperations
{

    public function storeFile($file, $path, $disk = 'public')
    {
        try {
            $path = $file->store($path, ['disk' => $disk]);
            if ($disk == 'public') {
                return 'storage/' . $path;
            }
            return $path;
        } catch (\Exception $e) {
            return false;
        }

    }

    public function replaceFile($oldFilePath, $newFile, $newFilePath, $disk = 'public')
    {
        try {
            if ($oldFilePath&& $newFile&& $newFilePath){
                $path = $this->storeFile($newFile, $newFilePath, $disk);
                if ($path){
                    $oldPath = public_path($oldFilePath);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                    return $path;
                }
            }
            return null;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function deleteFile($filePath, $disk = 'public')
    {
        try {
            $oldPath = public_path($filePath);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }


}
