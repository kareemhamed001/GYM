<?php

namespace App\Http\Controllers\api\course;

use App\classes\course\CourseClass;
use App\Http\Controllers\Controller;
use App\Models\coach;
use App\Models\course;
use App\Models\curriculum;
use App\Models\curriculum_file;
use App\Models\product_image;
use App\Models\supplement;
use App\Models\video;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

            DB::transaction(function () use ($request) {
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


                if ($request->topics) {
                    foreach ($request->topics as $key => $topic) {
                        $topicPath = $this->storeFile($topic['cover_image'], 'images/courses/topics/coverImages');
                        $curriculum=$this->storeCurriculum($topic['title'],$topicPath,$course->id);
                        if ($topic['files']) {
                            foreach ($topic['files'] as $title => $file) {
                                $path = '';
                                $type = null;
                                if (intval($file['type']) == 0) {
                                    $type = 0;
                                    $video = video::find($file['videoId']);
                                    if ($video) {
                                        $path = $video->path;
                                    }
                                } elseif (intval($file['type']) == 1) {
                                    $type = 1;
                                    $path = $this->storeFile($file['file'], 'files');
                                }
                                if ($path) {
                                    $this->storeCurriculumFile($file['title'],$file['description'], $path,$type,$curriculum->id);
                                }
                            }
                        }
                    }
                }
            });
            return $this->apiResponse(null, 'success', 200);
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

                //check if there is any topic
                if ($request->topics)
                {
                    foreach ($request->topics as $topic) {
                        //check if this topic is stored before
                        if (isset($topic['id'])) {
                            //get topic from database
                            $curriculum = curriculum::find($topic['id']);
                            //check if curriculum exists on database
                            if ($curriculum->id) {
                                //update topic title
                                $curriculum->title = $topic['title'];
                                //check if a new cover image is sent
                                if (isset($topic['cover_image'])) {
                                    //replace old cover with new cover
                                    $curriculum->cover_image = $this->replaceFile($curriculum->cover_image, $topic['cover_image'], 'images/courses/topics/coverImages');
                                }
                                //save changes
                                $curriculum->save();
                            }
                        } //if this topic not stored before create new topic
                        else {
                            //topic's cover image path
                            $topicPath = '';
                            if (isset($topic['cover_image'])) {
                                //store topic image
                                $topicPath = $this->storeFile($topic['cover_image'], 'images/courses/topics/coverImages');
                            }
                            $curriculum=$this->storeCurriculum($topic['title'],$topicPath,$course->id);
                        }

                        //if this topic has files
                        if (isset($topic['files'])) {

                            foreach ($topic['files'] as $title => $file) {

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
                                }
                                //if this file is new one
                                else
                                {
                                    //if file type is stored video
                                    if (intval($file['type']) == 0) {
                                        $path = '';
                                        $type = 0;

                                        //check if stored video id is sent
                                        if (isset($file['videoId'])) {
                                            //get video by id
                                            $video = video::find($file['videoId']);
                                            if ($video) {
                                                //make the file path = stored video path
                                                $path = $video->path;
                                            }
                                        }

                                    }
                                    //if file type is uploaded file
                                    elseif (intval($file['type']) == 1) {
                                        $type = 1;
                                        //the file path
                                        $path = $this->storeFile($file['file'], 'files');
                                    }

                                    if ($path) {
                                        //store this file
                                        $this->storeCurriculumFile($file['title'], $file['description'], $path, $type, $curriculum->id);
                                    }
                                }
                            }
                        }
                    }
                }

                return $this->apiResponse($course, 'success', 200);
            }
            return $this->apiResponse('', 'No course with this id', 200);
        } catch (\Exception $e) {
            return $this->apiResponse($e->getTrace(), 'error', 400);
        }
    }

    function storeCurriculum(string $title, string $coverImagePath, int $courseId)
    {
        try {
            return curriculum::create([
                'title' => $title,
                'cover_image' => $coverImagePath,
                'course_id' => $courseId
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    function storeCurriculumFile(string $title, string $description, string $path, string $type, int $curriculum_id)
    {
        try {
            curriculum_file::create([
                'title' => $title,
                'description' => $description,
                'path' => $path,
                'type' => $type,
                'curriculum_id' => $curriculum_id
            ]);
            return true;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
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

    public function deleteArrayOfCourses(Request $request)
    {
        try {
            $validator = validator::make($request->all(), [
                'courses' => ['required', 'array'],
            ]);

            if ($validator->fails()) {
                return response()->json(['data' => null, 'message' => $validator->errors()], 400);
            }
            if (!is_array($request->courses)) {
                return response()->json(['data' => null, 'message' => 'courses must be in array'], 200);
            }
            $cover_images_pathes = course::query()->whereIn('id', $request->courses)->pluck('cover_image');

            $this->deleteCollectionOfFiles($cover_images_pathes);

            course::whereIn('id', $request->courses)->delete();

            return $this->apiResponse('', 'success', 200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    function deleteCurriculum($courseId, $curriculumId)
    {
        try {

            $course = course::find($courseId);
            $curriculum = curriculum::find($curriculumId);
            if (!$course) {
                return $this->apiResponse('', 'This course doesnt exists', 400);
            }
            if (!$curriculum) {
                return $this->apiResponse('', 'This curriculum doesnt exists', 400);
            }

            if ($curriculum->course_id == $course->id) {
                $this->deleteFile($curriculum->cover_image);
                $curriculum->delete();
                return $this->apiResponse('', 'success', 200);
            }

            return $this->apiResponse('', 'Some went wrong', 400);
        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    function deleteCurriculumFile($courseId, $curriculumId, $fileId)
    {
        try {

            $course = course::find($courseId);
            $curriculum = curriculum::find($curriculumId);
            $curriculumFile = curriculum_file::find($fileId);
            if (!$course) {
                return $this->apiResponse('', 'This course doesnt exists', 400);
            }
            if (!$curriculum) {
                return $this->apiResponse('', 'This curriculum doesnt exists', 400);
            }
            if (!$curriculumFile) {
                return $this->apiResponse('', 'This file doesnt exists', 400);
            }

            if ($curriculumFile->curriculum_id == $curriculum->id && $curriculum->course_id == $course->id) {
                $this->deleteFile($curriculumFile->path);
                $curriculumFile->delete();
                return $this->apiResponse('', 'success', 200);
            }

            return $this->apiResponse('', 'Some went wrong', 400);
        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }


}
