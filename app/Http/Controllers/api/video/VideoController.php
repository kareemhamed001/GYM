<?php

namespace App\Http\Controllers\api\video;

use App\classes\video\VideoClass;
use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\coach;
use App\Models\supplement;
use App\Models\video;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class VideoController extends Controller
{
    use ApiResponse;
    use ImagesOperations;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $videos = VideoClass::getAll();
            return $this->apiResponse($videos, 'success', 200);
        } catch (\Exception $e) {
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
                'title_ar' => ['nullable','string', 'max:100'],
                'title_ku' => ['nullable','string', 'max:100'],
                'description' => ['required', 'string', 'max:500'],
                'description_ar' => ['nullable','string', 'max:500'],
                'description_ku' => ['nullable','string', 'max:500'],
                'coach_id' => ['required', 'integer', Rule::exists('coaches', 'id')],
                'video' => ['required', 'mimes:mp4', 'max:1048576'],
                'cover_image' => ['required', 'image'],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }


            $coach = coach::find($request->coach_id);
            $videoPath = $this->storeFile($request->video, 'videos/');
            $imagePath = $this->storeFile($request->cover_image, 'images/videos/coverImages');
            $video = video::create([
                'title_en' => $request->title,
                'title_ar' => $request->title_ar,
                'title_ku' => $request->title_ku,
                'description_en' => $request->description,
                'description_ar' => $request->description_ar,
                'description_ku' => $request->description_ku,
                'coach_id' => $request->coach_id,
                'path' => $videoPath,
                'cover_image' => $imagePath,
            ]);
            return $this->apiResponse($video, 'success', 200);


        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $video = VideoClass::get($id);
            if ($video) {
                return $this->apiResponse($video, 'success', 200);
            }
            return $this->apiResponse('', 'No video with this id', 200);

        } catch (\Exception $e) {
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
                'coach_id' => ['integer', Rule::exists('coaches', 'id')],
                'video' => ['mimes:mp4', 'max:1048576'],
                'cover_image' => ['image'],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $video = VideoClass::get($id);
            $coach = coach::find($video->coach_id);

            if ($video &&$coach) {
                if ($request->video) {
                    $videoFile=$request->file('video');
                    $path = $this->replaceFile($video->path, $videoFile, 'videos/'. Str::slug($coach->nick_name) . '/');
                    if ($path){

                    $video->path = $path;
                    }
                }
                if ($request->cover_image) {
                    $image=$request->file('cover_image');
                    $path = $this->replaceFile($video->cover_image, $image, 'images/videos/coverImages');
                    if ($path){
                    $video->cover_image = $path;
                    }
                }

                if ($request->title) {
                    $video->title_en = $request->title;
                }
                if ($request->title_ar) {
                    $video->title_ar = $request->title_ar;
                }
                if ($request->title_ku) {
                    $video->title_ku = $request->title_ku;
                }
                if ($request->description) {
                    $video->description_en = $request->description;
                }
                if ($request->description_ar) {
                    $video->description_ar = $request->description_ar;
                }
                if ($request->description_ku) {
                    $video->description_ku = $request->description_ku;
                }
                if ($request->coach_id) {
                    $video->coach_id = $request->coach_id;
                }

                $video->save();

                return $this->apiResponse($video, 'success', 200);
            }
            return $this->apiResponse('', 'No video with this id', 200);
        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $video = VideoClass::get($id);
            if ($video) {
                VideoClass::destroy($id);
                return $this->apiResponse('', 'success', 200);
            }
            return $this->apiResponse('', 'No video with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function getCoachByVideoId($id)
    {
        try {

            $video = video::with('coach')->find($id);
            if ($video) {
                return $this->apiResponse($video, 'success', 200);
            }
            return $this->apiResponse('', 'No video with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }
    public function getCoursesByVideoId($id)
    {
        try {

            $video = video::with('courses')->find($id);
            if ($video) {
                return $this->apiResponse($video, 'success', 200);
            }
            return $this->apiResponse('', 'No video with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function deleteArrayOfVideos(Request $request)
    {
        try {
            $validator = validator::make($request->all(), [
                'videos' => ['required', 'array'],
            ]);

            if ($validator->fails()) {
                return response()->json(['data' => null, 'message' => $validator->errors()], 400);
            }
            if (!is_array($request->videos)) {
                return response()->json(['data' => null, 'message' => 'videos must be in array'], 200);
            }
            $cover_images_pathes = video::query()->whereIn('id', $request->videos)->pluck('cover_image');
            $videos_pathes = video::query()->whereIn('id', $request->videos)->pluck('path');
            $this->deleteCollectionOfFiles($videos_pathes);
            $this->deleteCollectionOfFiles($cover_images_pathes);
            video::whereIn('id', $request->videos)->delete();
            return $this->apiResponse('', 'success', 200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
