<?php

namespace App\Http\Controllers\api\coach;

use App\classes\brand\BrandClass;
use App\classes\coach\CoachClass;
use App\Models\brand;
use App\Models\coach;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CoachController
{
    use ApiResponse;
    use ImagesOperations;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $coaches = CoachClass::getAll();
            return $this->apiResponse($coaches, 'success', 200);
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
                'nick_name' => ['required', 'string', 'max:100'],
                'description' => ['required', 'string', 'max:500'],
                'user_id' => ['required', 'integer', Rule::exists('users', 'id'), Rule::unique('coaches', 'user_id')],
                'email' => ['required', 'email', Rule::unique('coaches', 'email')],
                'phone_number' => ['required', 'numeric', Rule::unique('coaches', 'phone_number')],
                'experience' => ['required', 'numeric', 'max:20'],
                'intro_video' => ['required', 'mimes:mp4', 'max:1048576'],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }


            $path=$this->storeFile($request->intro_video,'videos/coaches/introVideos');
            $coach = coach::create([
                'nick_name' => $request->nick_name,
                'description' => $request->description,
                'user_id' => $request->user_id,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'experience' => $request->experience,
                'intro_video' => $path,
            ]);
            return $this->apiResponse($coach, 'success', 200);


        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $coach = CoachClass::get($id);
            if ($coach) {
                return $this->apiResponse($coach, 'success', 200);
            }
            return $this->apiResponse('', 'No coach with this id', 200);

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
                'nick_name' => [ 'string', 'max:100'],
                'description' => [ 'string', 'max:500'],
                'user_id' => [ 'integer', Rule::exists('users', 'id'), Rule::unique('coaches', 'user_id')],
                'email' => [ 'email', Rule::unique('coaches', 'email')],
                'phone_number' => [ 'numeric', Rule::unique('coaches', 'phone_number')],
                'experience' => [ 'numeric', 'max:20'],
                'intro_video' => [ 'mimes:mp4', 'max:1048576'],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $coach = CoachClass::get($id);


            if ($coach) {
                if ($request->intro_video) {
                    $path = $this->replaceFile($coach->intro_video, $request->intro_video, 'videos/coaches/introVideos');
                }

                if ($request->nick_name) {
                    $coach->nick_name = $request->nick_name;
                }
                if ($request->description) {
                    $coach->description = $request->description;
                }
                if ($request->user_id) {
                    $coach->user_id = $request->user_id;
                }
                if ($request->email) {
                    $coach->email = $request->email;
                }if ($request->phone_number) {
                    $coach->phone_number = $request->phone_number;
                }if ($request->experience) {
                    $coach->experience = $request->experience;
                }
                if ($request->intro_video) {
                    $coach->intro_video = $path;
                }

                $coach->save();

                return $this->apiResponse($coach, 'success', 200);
            }
            return $this->apiResponse('', 'No coach with this id', 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $coach = CoachClass::get($id);
            if ($coach) {
                CoachClass::destroy($id);
                return $this->apiResponse('', 'success', 200);
            }
            return $this->apiResponse('', 'No coach with this id', 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function getProductsByCoachId($id)
    {
        try {

            $coach = coach::find($id);
            if ($coach) {
                return $this->apiResponse($coach->supplements, 'success', 200);
            }
            return $this->apiResponse('', 'No coach with this id', 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }
    public function getBrandsByCoachId($id)
    {
        try {

            $coach = coach::find($id);
            if ($coach) {
                return $this->apiResponse($coach->brands, 'success', 200);
            }
            return $this->apiResponse('', 'No coach with this id', 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }
    public function getVideosByCoachId($id)
    {
        try {

            $coach = coach::find($id);
            if ($coach) {
                return $this->apiResponse($coach->videos, 'success', 200);
            }
            return $this->apiResponse('', 'No coach with this id', 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }
    public function getCoursesByCoachId($id)
    {
        try {

            $coach = coach::find($id);
            if ($coach) {
                return $this->apiResponse($coach->courses, 'success', 200);
            }
            return $this->apiResponse('', 'No coach with this id', 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }
}
