<?php

namespace App\Http\Controllers\api\muscle;


use App\Http\Controllers\Controller;
use App\Models\coach;

use App\Models\muscle;
use App\Models\curriculum;
use App\Models\curriculum_file;
use App\Models\product_image;
use App\Models\product;
use App\Models\video;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MuscleController extends Controller
{
    use ApiResponse;
    use ImagesOperations;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $muscles = muscle::with('parts')->get();
            return $this->apiResponse($muscles, 'success', 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'title' => ['required', 'string', 'max:100'],
                'title_ar' => ['required', 'string', 'max:100'],
                'title_ku' => ['required', 'string', 'max:100'],
                'description' => ['required', 'string', 'max:500'],
                'description_ar' => ['required', 'string', 'max:500'],
                'description_ku' => ['required', 'string', 'max:500'],
                'cover_image' => ['required', 'image'],
                'coach_id' => ['required', Rule::exists('users', 'id')],

            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $muscle = DB::transaction(function () use ($request) {
                $path = $this->storeFile($request->cover_image, 'images/muscles/coverImages');

                $muscle = muscle::create([
                    'title_en' => $request->title,
                    'title_ar' => $request->title_ar,
                    'title_ku' => $request->title_ku,
                    'description_en' => $request->description,
                    'description_ar' => $request->description_ar,
                    'description_ku' => $request->description_ku,
                    'cover_image' => $path
                ]);


                if ($request->parts) {
                    foreach ($request->parts as $key => $part) {
                        $partPath = '';
                        if (isset($part['cover_image'])) {
                            $partPath = $this->storeFile($part['cover_image'], 'images/muscles/parts/coverImages');
                        }
                        $curriculum = $this->storeCurriculum($part['title'], $partPath, $muscle->id);
                        if (isset($part['files'])) {
                            foreach ($part['files'] as $title => $file) {
                                $path = '';
                                $type = null;
                                $path = $this->storeFile($file['file'], 'files');
                                if ($path) {
                                    $this->storeCurriculumFile($file['title'], $file['description'], $path, $curriculum->id);
                                }
                            }
                        }
                    }
                }
                \App\Models\log::create([
                    'table_name' => 'muscles',
                    'item_id' => $muscle->id,
                    'action' => 'store',
                    'user_id' => $request->coach_id,
                ]);
                return $muscle;
            });

            return $this->apiResponse($muscle, 'success', 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $muscle = muscle::find($id);
            if ($muscle) {
                return $this->apiResponse($muscle, 'success', 200);
            }
            return $this->apiResponse('', 'No muscle with this id', 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try {


            $validator = Validator::make($request->all(), [
                'title' => ['string', 'max:100'],
                'title_ar' => ['string', 'max:100'],
                'title_ku' => ['string', 'max:100'],
                'description' => ['string', 'max:500'],
                'description_ar' => ['string', 'max:500'],
                'description_ku' => ['string', 'max:500'],
                'cover_image' => ['image'],
                'coach_id' => ['required', Rule::exists('users', 'id')],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $muscle = muscle::find($id);


            if ($muscle) {
                if ($request->cover_image) {
                    if (is_string($request->cover_image)) {
                        $path = $request->cover_image;
                        $muscle->cover_image = $path;
                    } else {
                        $path = $this->replaceFile($muscle->cover_image, $request->cover_image, 'images/muscles/coverImages');
                        $muscle->cover_image = $path;
                    }
                }

                if ($request->title) {
                    $muscle->title_en = $request->title;
                }
                if ($request->title_ar) {
                    $muscle->title_ar = $request->title_ar;
                }
                if ($request->title_ku) {
                    $muscle->title_ku = $request->title_ku;
                }
                if ($request->description) {
                    $muscle->description_en = $request->description;
                }
                if ($request->description_ar) {
                    $muscle->description_ar = $request->description_ar;
                }
                if ($request->description_ku) {
                    $muscle->description_ku = $request->description_ku;
                }


                $muscle->save();

                //check if there is any part
                if ($request->parts) {
                    foreach ($request->parts as $part) {
                        //check if this part is stored before
                        if (isset($part['id'])) {
                            //get part from database
                            $curriculum = curriculum::find($part['id']);
                            //check if curriculum exists on database
                            if (isset($curriculum->id)) {
                                //update part title
                                $curriculum->title = $part['title'];
                                //check if a new cover image is sent
                                if (isset($part['cover_image'])) {
                                    //replace old cover with new cover
                                    $curriculum->cover_image = $this->replaceFile($curriculum->cover_image, $part['cover_image'], 'images/muscles/parts/coverImages');
                                }
                                //save changes
                                $curriculum->save();
                            }
                        } //if this part not stored before create new part
                        else {
                            //part's cover image path
                            $partPath = '';
                            if (isset($part['cover_image'])) {
                                //store part image
                                $partPath = $this->storeFile($part['cover_image'], 'images/muscles/parts/coverImages');
                            }
                            $curriculum = $this->storeCurriculum($part['title'], $partPath, $muscle->id);
                        }

                        //if this part has files
                        if (isset($part['files'])) {

                            foreach ($part['files'] as $title => $file) {

                                //check if this file is stored before
                                if (isset($file['id'])) {
                                    //get file from database
                                    $fileStored = curriculum_file::find($file['id']);
                                    //check if file exists on database
                                    if ($fileStored->id) {
                                        //update file title
                                        $fileStored->title = $file['title'];
                                        //update file description
                                        $fileStored->description = $file['description'];
                                        //check if new file is sent
                                        if (isset($file['file'])) {
                                            //replace old file with the new one
                                            $fileStored->path = $this->replaceFile($fileStored->path, $file['file'], 'files');
                                        }
                                        //if the file is stored before and its type is stored video
                                        if (isset($file['videoId'])) {
                                            //get stored video by its id
                                            $video = video::find($file['videoId']);
                                            if ($video) {
                                                //update the file path with the stored video path
                                                $fileStored->path = $video->path;
                                            }
                                        }
                                        $fileStored->save();
                                    }
                                } //if this file is new one
                                else {
                                    if (is_string($file['file'])){
                                        $path = $file['file'];
                                    }else{
                                        $path = $this->storeFile($file['file'], 'files');
                                    }

                                    if ($path) {
                                        //store this file
                                        $this->storeCurriculumFile($file['title'], $file['description'], $path, $curriculum->id);
                                    }
                                }
                            }
                        }
                    }
                }

                \App\Models\log::create([
                    'table_name' => 'muscles',
                    'item_id' => $muscle->id,
                    'action' => 'update',
                    'user_id' => $request->coach_id,
                ]);
                Log::info('Muscle' . $muscle->id . ' updated successfully');
                return $this->apiResponse($muscle, 'success', 200);
            }
            Log::info('Muscle' . $muscle->id . ' not found while updating it');
            return $this->apiResponse('', 'No muscle with this id', 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getTrace(), 'error', 400);
        }
    }

    function storeCurriculum(string $title, string $coverImagePath, int $muscleId)
    {
        try {
            return curriculum::create([
                'title' => $title,
                'cover_image' => $coverImagePath,
                'muscle_id' => $muscleId
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function storeCurriculumFile(string $title, string $description, string $path, int $curriculum_id)
    {
        try {
            curriculum_file::create([
                'title' => $title,
                'description' => $description,
                'path' => $path,
                'curriculum_id' => $curriculum_id
            ]);
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {


            $muscle = muscle::find($id);
            if ($muscle) {
                muscle::destroy($id);
                \App\Models\log::create([
                    'table_name' => 'muscles',
                    'item_id' => $id,
                    'action' => 'destroy',
                    'user_id' => $request->coach_id,
                ]);
                return $this->apiResponse('', 'success', 200);
            }
            return $this->apiResponse('', 'No muscle with this id', 200);

        } catch (\Exception $e) {
            Log::error($e->getTraceAsString());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function getVideosBymuscleId($id)
    {
        try {

            $muscle = muscle::find($id);
            if ($muscle) {
                return $this->apiResponse($muscle->videos, 'success', 200);
            }
            return $this->apiResponse('', 'No muscle with this id', 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function getmuscleCoach($id)
    {
        try {

            $muscle = muscle::find($id);
            if ($muscle) {
                return $this->apiResponse($muscle->coach, 'success', 200);
            }
            return $this->apiResponse('', 'No muscle with this id', 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function deleteArrayOfmuscles(Request $request)
    {
        try {
            $validator = validator::make($request->all(), [
                'muscles' => ['required', 'array'],
            ]);

            if ($validator->fails()) {
                return response()->json(['data' => null, 'message' => $validator->errors()], 400);
            }
            if (!is_array($request->muscles)) {
                return response()->json(['data' => null, 'message' => 'muscles must be in array'], 200);
            }
            $cover_images_pathes = muscle::query()->whereIn('id', $request->muscles)->pluck('cover_image');


            $this->deleteCollectionOfFiles($cover_images_pathes);

            muscle::whereIn('id', $request->muscles)->delete();

            return $this->apiResponse('', 'success', 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    function deleteCurriculum($muscleId, $curriculumId)
    {
        try {

            $muscle = muscle::find($muscleId);
            $curriculum = curriculum::find($curriculumId);
            if (!$muscle) {
                return $this->apiResponse('', 'This muscle doesnt exists', 400);
            }
            if (!$curriculum) {
                return $this->apiResponse('', 'This curriculum doesnt exists', 400);
            }

            if ($curriculum->muscle_id == $muscle->id) {
                $this->deleteFile($curriculum->cover_image);
                $curriculum->delete();
                return $this->apiResponse('', 'success', 200);
            }

            return $this->apiResponse('', 'Some went wrong', 400);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    function deleteCurriculumFile($muscleId, $curriculumId, $fileId)
    {
        try {

            $muscle = muscle::find($muscleId);
            $curriculum = curriculum::find($curriculumId);
            $curriculumFile = curriculum_file::find($fileId);
            if (!$muscle) {
                return $this->apiResponse('', 'This muscle doesnt exists', 400);
            }
            if (!$curriculum) {
                return $this->apiResponse('', 'This curriculum doesnt exists', 400);
            }
            if (!$curriculumFile) {
                return $this->apiResponse('', 'This file doesnt exists', 400);
            }

            if ($curriculumFile->curriculum_id == $curriculum->id && $curriculum->muscle_id == $muscle->id) {
                $this->deleteFile($curriculumFile->path);
                $curriculumFile->delete();
                return $this->apiResponse('', 'success', 200);
            }

            return $this->apiResponse('', 'Some went wrong', 400);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }


}
