<?php

namespace App\Http\Controllers\api\course;

use App\classes\course\CourseClass;
use App\Http\Controllers\Controller;
use App\Models\coach;
use App\Models\course;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    use ApiResponse;
    use ImagesOperations;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $courses = CourseClass::getAll();
            return $this->apiResponse($courses, 'success', 200);
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
                'title_ar' => ['nullable', 'string', 'max:100'],
                'title_ku' => ['nullable', 'string', 'max:100'],
                'description' => ['required', 'string', 'max:500'],
                'description_ar' => ['nullable', 'string', 'max:500'],
                'description_ku' => ['nullable', 'string', 'max:500'],
                'coach_id' => ['required', 'integer', Rule::exists('coaches', 'id')],
                'price' => ['required', 'numeric'],
                'discount' => ['required', 'numeric', 'max:100'],
                'cover_image' => ['required', 'image'],
                'type' => ['required', 'digits_between:0,3', 'in:0,1,2,3'],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }


            $path = $this->storeFile($request->cover_image, 'images/courses/coverImages');
            $course = course::create([
                'title' => $request->title,
                'title_ar' => $request->title_ar,
                'title_ku' => $request->title_ku,
                'description' => $request->description,
                'description_ar' => $request->description_ar,
                'description_ku' => $request->description_ku,
                'coach_id' => $request->coach_id,
                'price' => $request->price,
                'discount' => $request->discount,
                'cover_image' => $path,
                'type' => $request->type,
            ]);
            return $this->apiResponse($course, 'success', 200);


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

            $course = courseClass::get($id);
            if ($course) {
                return $this->apiResponse($course, 'success', 200);
            }
            return $this->apiResponse('', 'No course with this id', 200);

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
                'price' => ['numeric'],
                'discount' => ['numeric'],
                'cover_image' => ['image'],
                'type' => ['in:0,1,2,3']
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $course = CourseClass::get($id);


            if ($course) {
                if ($request->cover_image) {
                    $path = $this->replaceFile($course->cover_image, $request->cover_image, 'images/brands/coverImages');
                }

                if ($request->title) {
                    $course->title = $request->title;
                }
                if ($request->title_ar) {
                    $course->title_ar = $request->title_ar;
                }
                if ($request->title_ku) {
                    $course->title_ku = $request->title_ku;
                }
                if ($request->description) {
                    $course->description = $request->description;
                }
                if ($request->description_ar) {
                    $course->description_ar = $request->description_ar;
                }
                if ($request->description_ku) {
                    $course->description_ku = $request->description_ku;
                }
                if ($request->coach_id) {
                    $course->coach_id = $request->coach_id;
                }
                if ($request->price) {
                    $course->price = $request->price;
                }
                if ($request->discount) {
                    $course->discount = $request->discount;
                }
                if ($request->cover_image) {
                    $course->cover_image = $path;
                }
                if ($request->type) {
                    $course->type = $request->type;
                }

                $course->save();

                return $this->apiResponse($course, 'success', 200);
            }
            return $this->apiResponse('', 'No course with this id', 200);
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

            $course = CourseClass::get($id);
            if ($course) {
                CourseClass::destroy($id);
                return $this->apiResponse('', 'success', 200);
            }
            return $this->apiResponse('', 'No course with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function getVideosByCourseId($id)
    {
        try {

            $course = course::find($id);
            if ($course) {
                return $this->apiResponse($course->videos, 'success', 200);
            }
            return $this->apiResponse('', 'No course with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }
    public function getCourseCoach($id)
    {
        try {

            $course = course::find($id);
            if ($course) {
                return $this->apiResponse($course->coach, 'success', 200);
            }
            return $this->apiResponse('', 'No course with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }
}
