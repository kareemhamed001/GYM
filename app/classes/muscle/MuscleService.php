<?php

namespace App\classes\muscle;

use App\classes\general\GeneralFunctionsClass;
use App\Models\coach;
use App\Models\muscle;
use App\Models\part;
use App\Models\part_file;
use App\traits\ImagesOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use function PHPUnit\TestFixture\func;
use function Webmozart\Assert\Tests\StaticAnalysis\null;

class MuscleService
{

    use ImagesOperations;

    private PartsService $PartsService;

    function __construct(PartsService $PartsService)
    {
        $this->PartsService = $PartsService;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($coachId, $coverImage, $title_en, $title_ar, $title_ku, $description_en, $description_ar, $description_ku, $parts = null)
    {
        try {

            $muscle = DB::transaction(function () use ($coachId, $coverImage, $title_en, $title_ar, $title_ku, $description_en, $description_ar, $description_ku, $parts) {

                $path = $this->storeFile($coverImage, $this->MUSCLES_COVERIMAGES_PATH);

                $muscle = muscle::create([
                    'title_en' => $title_en,
                    'title_ar' => $title_ar,
                    'title_ku' => $title_ku,
                    'description_en' => $description_en,
                    'description_ar' => $description_ar,
                    'description_ku' => $description_ku,
                    'cover_image' => $path ?? ''
                ]);

                if ($parts) {
                    foreach ($parts as $part) {
                        $part = $this->PartsService->store($part['title'], $muscle->id, $part['cover_image']);
                        if (isset($part['files'])) {
                            foreach ($part['files'] as $file) {
                                $this->PartsService->addFile($part->id, $file['title'], $file['description'], $file['file']);
                            }
                        }
                    }
                }
                \App\Models\log::create([
                    'table_name' => 'muscles',
                    'item_id' => $muscle->id,
                    'action' => 'store',
                    'user_id' => $coachId,
                ]);
                return $muscle;
            });

            return $muscle;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function update($id, int $coachId, UploadedFile $coverImage = null, $title_en = null, $title_ar = null, $title_ku = null, $description_en = null, $description_ar = null, $description_ku = null, $parts = null)
    {
        try {

            $muscle = DB::transaction(function () use ($id, $coachId, $coverImage, $title_en, $title_ar, $title_ku, $description_en, $description_ar, $description_ku, $parts) {
                $muscle = muscle::find($id);
                if ($muscle) {
                    if ($coverImage) {
                        if (is_string($coverImage)) {
                            $path = $coverImage;
                            $muscle->cover_image = $path;
                        } else {
                            $path = $this->replaceFile($muscle->cover_image, $coverImage, $this->MUSCLES_COVERIMAGES_PATH);
                            $muscle->cover_image = $path;
                        }
                    }

                    if ($title_en) {
                        $muscle->title_en = $title_en;
                    }
                    if ($title_ar) {
                        $muscle->title_ar = $title_ar;
                    }
                    if ($title_ku) {
                        $muscle->title_ku = $title_ku;
                    }
                    if ($description_en) {
                        $muscle->description_en = $description_en;
                    }
                    if ($description_ar) {
                        $muscle->description_ar = $description_ar;
                    }
                    if ($description_ku) {
                        $muscle->description_ku = $description_ku;
                    }

                    $muscle->save();
                    if ($parts) {
                        foreach ($parts as $part) {
                            if (isset($part['id'])) {
                                $updatedPart = $this->PartsService->update($part['id'], $part['title'], $part['cover_image'] ?? null);
                                $part_id = $updatedPart->id;
                            } else {
                                $newPart = $this->PartsService->store($part['title'], $muscle->id, $part['cover_image']);
                                $part_id = $newPart->id;
                            }

                            if (isset($part['files'])) {
                                foreach ($part['files'] as $title => $file) {
                                    if (isset($file['id'])) {
                                        $this->PartsService->updateFile($file['id'], $file['title'], $file['description'], $file['file'] ?? null);
                                    } else {
                                        $this->PartsService->addFile($part_id, $file['title'], $file['description'], $file['file'] ?? null);
                                    }
                                }
                            }
                        }
                    }

                    \App\Models\log::create([
                        'table_name' => 'muscles',
                        'item_id' => $muscle->id,
                        'action' => 'update',
                        'user_id' => $coachId,
                    ]);
                    Log::info('Muscle' . $muscle->id . ' updated successfully');
                    return $muscle;
                } else {
                    throw new Exception('No muscles with this id found');
                }
            });

            return $muscle;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function destroy(int $id): bool
    {
        try {
            $muscle = muscle::find($id);
            if ($muscle) {
                $muscle->delete();
                return true;
            }
            throw new Exception('No muscle with this id', 200);

        } catch (Exception $e) {
            Log::error($e->getTraceAsString());
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public static function destroyAll()
    {
        try {
            $muscle = muscle::all()->delete();
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public static function get(int $id)
    {
        try {
            return muscle::find($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function getAll(int $pagination = 15)
    {
        try {
            return muscle::paginate($pagination);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
