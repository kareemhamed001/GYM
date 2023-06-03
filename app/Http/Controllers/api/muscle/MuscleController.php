<?php

namespace App\Http\Controllers\api\muscle;


use App\classes\muscle\MuscleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\user\StoreRequest;
use App\Models\coach;
use App\Models\muscle;
use App\Models\part;
use App\Models\part_file;
use App\Models\product_image;
use App\Models\product;
use App\Models\video;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use function Webmozart\Assert\Tests\StaticAnalysis\null;

class MuscleController extends Controller
{
    use ApiResponse;
    use ImagesOperations;

    private MuscleService $MuscleService;

    function __construct(MuscleService $muscleClass)
    {
        $this->MuscleService = $muscleClass;
    }

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
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }


    function storeRules()
    {
        return [
            'title' => ['required', 'string', 'max:100'],
            'title_ar' => ['required', 'string', 'max:100'],
            'title_ku' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:500'],
            'description_ar' => ['required', 'string', 'max:500'],
            'description_ku' => ['required', 'string', 'max:500'],
            'cover_image' => ['required', 'image'],
            'coach_id' => ['required', Rule::exists('users', 'id')],
        ];
    }

    function updateRules()
    {
        return [
            'title' => ['string', 'max:100'],
            'title_ar' => ['string', 'max:100'],
            'title_ku' => ['string', 'max:100'],
            'description' => ['string', 'max:500'],
            'description_ar' => ['string', 'max:500'],
            'description_ku' => ['string', 'max:500'],
            'cover_image' => ['nullable', 'image'],
            'coach_id' => ['required', Rule::exists('users', 'id')],
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), $this->storeRules());

            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $muscle = $this->MuscleService->store(
                $request->coach_id,
                $request->cover_image,
                $request->title,
                $request->title_ar,
                $request->title_ku,
                $request->description,
                $request->description_ar,
                $request->description_ku,
                $request->parts
            );

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
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }


    /**
     * this function update specific muscle
     * @param Request $request the update request
     * @param int $id the id of muscles which is need to be deleted
     * @returns ApiResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $validator = Validator::make($request->all(), $this->updateRules());
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $muscle = $this->MuscleService->update(
                $id,
                $request->coach_id,
                $request->cover_image ?? null,
                $request->title ?? null,
                $request->title_ar ?? null,
                $request->title_ku ?? null,
                $request->description ?? null,
                $request->description_ar ?? null,
                $request->description_ku ?? null,
                $request->parts ?? null
            );

            return $this->apiResponse($muscle, 'success', 200);
        } catch (\Exception $e) {
            Log::error($e->getTraceAsString());
            return $this->apiResponse('', $e->getTrace(), 400);
        }
    }


    /**
     * this function deletes specific muscle
     * @param Request $request the delete request
     * @param int $id the id of muscles which is need to be deleted
     * @returns ApiResponse
     */
    public function destroy(Request $request, int $id)
    {
        try {
            $this->MuscleService->destroy($id);
            \App\Models\log::create([
                'table_name' => 'muscles',
                'item_id' => $id,
                'action' => 'destroy',
                'user_id' => $request->coach_id,
            ]);
            return $this->apiResponse('', 'Success', 200);
        } catch (\Exception $e) {
            Log::error($e->getTraceAsString());
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }

    /**
     * this function deletes collection of muscles at one time
     * @param Request $request the delete request that contains array of muscles ids
     * @returns ApiResponse
     */
    public function deleteCollection(Request $request)
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

    /**
     * this function deletes specific muscle's part
     * @param int $muscleId the muscle id
     * @param int $partId the part id
     * @returns ApiResponse
     */
    function deletePart(int $muscleId, int $partId)
    {
        try {

            $muscle = muscle::find($muscleId);
            $part = part::find($partId);
            if (!$muscle) {
                return $this->apiResponse('', 'This muscle doesnt exists', 400);
            }
            if (!$part) {
                return $this->apiResponse('', 'This part doesnt exists', 400);
            }

            if ($part->muscle_id == $muscle->id) {
                $this->deleteFile($part->cover_image);
                $part->delete();
                return $this->apiResponse('', 'success', 200);
            }

            return $this->apiResponse('', 'Some went wrong', 400);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }

    /**
     * this function deletes file from specific part
     * @param int $muscleId the muscle id
     * @param int $partId the part id
     * @param int $fileId the file id
     * @returns ApiResponse
     */
    function deletePartFile(int $muscleId, int $partId, int $fileId)
    {
        try {

            $muscle = muscle::find($muscleId);
            $part = part::find($partId);
            $partFile = part_file::find($fileId);
            if (!$muscle) {
                return $this->apiResponse('', 'This muscle doesnt exists', 400);
            }
            if (!$part) {
                return $this->apiResponse('', 'This part doesnt exists', 400);
            }
            if (!$partFile) {
                return $this->apiResponse('', 'This file doesnt exists', 400);
            }

            if ($partFile->part_id == $part->id && $part->muscle_id == $muscle->id) {
                $this->deleteFile($partFile->path);
                $partFile->delete();
                return $this->apiResponse('', 'success', 200);
            }

            return $this->apiResponse('', 'Some went wrong', 400);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }

    /**
     * this function return the parts of specific muscle
     * @param int $id the muscle id
     * @returns ApiResponse
     */
    function parts(int $id)
    {
        try {
            $muscle = muscle::with('parts')->find($id);
            if ($muscle) {
                return $this->apiResponse($muscle, 'success', 200);
            }
            return $this->apiResponse($muscle, 'No muscle with this id', 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }

    /**
     * this function return the files of specific part
     * @param int $muscle_id the muscle id
     * @param int $part_id the muscle's part id
     * @returns ApiResponse
     */
    function partFiles(int $muscle_id, int $part_id)
    {
        try {
            $muscle = muscle::find($muscle_id);
            if ($muscle) {
                $part = part::find($part_id);
                if ($part) {
                    return $this->apiResponse($part->files, 'success', 200);
                } else {
                    return $this->apiResponse('', 'No part with this id', 400);
                }
            }
            return $this->apiResponse('', 'No muscle with this id', 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }
}
