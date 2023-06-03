<?php

namespace App\classes\muscle;

use App\Models\part;
use App\Models\part_file;
use App\traits\ImagesOperations;
use Illuminate\Support\Facades\Log;

class PartsService
{
    use ImagesOperations;

    /**
     *
     * @param string $title the part title
     * @param int $muscleId the muscle id of this part
     * @param null $coverImage the cover image of the part with type file
     */
    function store(string $title, int $muscleId, $coverImage = null)
    {
        $coverImagePath = '';
        if ($coverImage && is_file($coverImage)) {
            $coverImagePath = $this->storeFile($coverImage, $this->MUSCLES_PARTSIMAGES_PATH);
        }
        try {
            return part::create([
                'title' => $title,
                'cover_image' => $coverImagePath,
                'muscle_id' => $muscleId
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function update(int $id, string $title, $coverImage = null)
    {
        try {
            $stored_part = part::find($id);
            if (isset($stored_part->id)) {
                $stored_part->title = $title;
                if ($coverImage) {
                    $stored_part->cover_image = $this->replaceFile($stored_part->cover_image, $coverImage, $this->MUSCLES_PARTSIMAGES_PATH);
                }
                $stored_part->save();
                return $stored_part;
            }
            throw new \Exception('Part ' . $title . ' not found');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }

    }

    function addFile(int $part_id, string $title, string $description, $file=null): bool
    {
        try {

            if ($file && is_file($file)) {
                $path = $this->storeFile($file, $this->FILES_PATH);
                if ($path) {
                    return part_file::create([
                        'title' => $title,
                        'description' => $description,
                        'path' => $path,
                        'part_id' => $part_id
                    ]);
                } else {
                    throw new \Exception('Error while store file ' . $title);
                }
            }

            throw new \Exception('the' . $title . 'is not a file');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function updateFile(int $fileId, string $title, string $description, $file=null)
    {
        try {

            //get file from database
            $stored_file = part_file::find($fileId);
            //check if file exists on database
            if ($stored_file->id) {
                //update file title
                $stored_file->title = $title;
                //update file description
                $stored_file->description = $description;
                //check if new file is sent
                if (isset($file['file'])) {
                    //replace old file with the new one
                    $stored_file->path = $this->replaceFile($stored_file->path, $file['file'], $this->FILES_PATH);
                }
                $stored_file->save();
                return $stored_file;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }
}
