<?php

namespace App\Http\Controllers\api\category;


use App\Http\Controllers\Controller;
use App\Models\brand;
use App\Models\brands_category;
use App\Models\category;
use App\Models\coach;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    use ApiResponse;
    use ImagesOperations;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = category::all();
            return $this->apiResponse($categories, 'success', 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
//    public function store(Request $request)
//    {
//        try {
//
//
//            $validator = Validator::make($request->all(), [
//                'name' => ['required', 'string', 'max:100'],
//                'name_ar' => ['nullable', 'string', 'max:100'],
//                'name_ku' => ['nullable', 'string', 'max:100'],
//                'description' => ['required', 'string', 'max:500'],
//                'description_ar' => ['nullable', 'string', 'max:500'],
//                'description_ku' => ['nullable', 'string', 'max:500'],
//                'cover_image' => ['required', 'image'],
//            ]);
//            if ($validator->fails()) {
//                return $this->apiResponse(null, $validator->errors(), 400);
//            }
//
//            $path = $this->storeFile($request->cover_image, 'images/categories/coverImages');
//            if ($path) {
//                $category = category::create([
//                    'name_en' => $request->name,
//                    'name_ar' => $request->name_ar,
//                    'name_ku' => $request->name_ku,
//                    'description_en' => $request->description,
//                    'description_ar' => $request->description_ar,
//                    'description_ku' => $request->description_ku,
//                    'cover_image' => $path
//                ]);
//                return $this->apiResponse($category, 'success', 200);
//            }
//
//            return $this->apiResponse('', 'Something went wrong while storing cover image', 200);
//
//        } catch (\Exception $e) {
//            return $this->apiResponse($e->getMessage(), 'error', 400);
//        }
//    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            if ($id == config('mainCategories.Coaches.id')) {
                $category = category::find(config('mainCategories.Coaches.id'));
                $coaches = coach::select(DB::raw('coaches.id,coaches.nick_name,coaches.email as contact_email,coaches.description,coaches.phone_number as contact_phone_number,coaches.user_id,coaches.experience,coaches.intro_video,coaches.created_at,coaches.updated_at,users.name,users.country,users.address,users.age,users.gender,users.profile_image,users.email,users.phone_number'))->join('users', 'coaches.user_id', '=', 'users.id')->get();
                return $this->apiResponse(['category' => $category, 'coaches' => $coaches], 'success', 200);
            }
            $category = category::with(['products', 'subcategories'])->find($id);
            if ($id == config('mainCategories.Supplements.id')) {
                $brands = brand::all();
                $category['brands'] = $brands;
            }
            if ($category) {
                return $this->apiResponse($category, 'success', 200);
            }
            return $this->apiResponse('', 'No category with this id', 200);

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
                'name' => ['required', 'string', 'max:100'],
                'name_ar' => ['string', 'max:100'],
                'name_ku' => ['string', 'max:100'],
                'description' => ['required', 'string', 'max:500'],
                'description_ar' => ['string', 'max:500'],
                'description_ku' => ['string', 'max:500'],
                'cover_image' => ['image'],
                'coach_id' => ['required', Rule::exists('users', 'id')],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $category = category::find($id);

            if ($category) {
                if ($request->cover_image) {
                    $path = $this->replaceFile($category->cover_image, $request->cover_image, 'images/categories/coverImages');
                }
                if ($request->name) {
                    $category->name_en = $request->name;
                }
                if ($request->name_ar) {
                    $category->name_ar = $request->name_ar;
                }
                if ($request->name_ku) {
                    $category->name_ku = $request->name_ku;
                }
                if ($request->description) {
                    $category->description_en = $request->description;
                }
                if ($request->description_ar) {
                    $category->description_ar = $request->description_ar;
                }
                if ($request->description_ku) {
                    $category->description_ku = $request->description_ku;
                }
                if ($request->cover_image) {
                    $category->cover_image = $path;
                }

                $category->save();

                \App\Models\log::create([
                    'table_name' => 'categories',
                    'item_id' => $category->id,
                    'action' => 'update',
                    'user_id' => $request->coach_id,
                ]);

                return $this->apiResponse($category, 'success', 200);
            }
            return $this->apiResponse('', 'No category with this id', 200);
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

            $category = category::get($id);
            if ($category) {
                category::destroy($id);
                return $this->apiResponse('', 'success', 200);
            }
            return $this->apiResponse('', 'No category with this id', 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function getBrandsByCategoryId($id)
    {
        try {

            $category = category::find($id);
            if ($category) {
                return $this->apiResponse($category->brands, 'success', 200);
            }
            return $this->apiResponse('', 'No category with this id', 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function deleteArrayOfCategories(Request $request)
    {
        try {
            $validator = validator::make($request->all(), [
                'categories' => ['required', 'array'],
            ]);

            if ($validator->fails()) {
                return response()->json(['data' => null, 'message' => $validator->errors()], 400);
            }
            if (!is_array($request->categories)) {
                return response()->json(['data' => null, 'message' => 'categories must be in array'], 200);
            }
            $cover_images_pathes = category::query()->whereIn('id', $request->categories)->pluck('cover_image');

            if (!$this->deleteCollectionOfFiles($cover_images_pathes)) {
                return $this->apiResponse('', 'something went wrong whiled deleting images ', 400);
            }
            category::whereIn('id', $request->categories)->delete();
            return $this->apiResponse('', 'success', 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
