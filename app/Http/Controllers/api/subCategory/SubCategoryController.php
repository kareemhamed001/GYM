<?php

namespace App\Http\Controllers\api\subCategory;

use App\classes\category\CategoryClass;
use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\coach;
use App\Models\subCategory;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller
{
    use ApiResponse;
    use ImagesOperations;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = CategoryClass::getAll();
            return $this->apiResponse($categories, 'success', 200);
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
                'name' => ['required', 'string', 'max:100'],
                'name_ar' => ['required', 'string', 'max:100'],
                'name_ku' => ['required', 'string', 'max:100'],
                'description' => ['required', 'string', 'max:500'],
                'description_ar' => ['required', 'string', 'max:500'],
                'description_ku' => ['required', 'string', 'max:500'],
                'category_id' => ['required', Rule::exists('categories','id')],
                'cover_image' => ['required', 'image'],
                'coach_id' => ['required',Rule::exists('users','id')],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $path = $this->storeFile($request->cover_image, 'images/subCategories/coverImages');
            if ($path) {
                $subCategory = subCategory::create([
                    'name_en' => $request->name,
                    'name_ar' => $request->name_ar,
                    'name_ku' => $request->name_ku,
                    'description_en' => $request->description,
                    'description_ar' => $request->description_ar,
                    'description_ku' => $request->description_ku,
                    'category_id' => $request->category_id,
                    'cover_image' => $path
                ]);

                \App\Models\log::create([
                    'table_name'=>'sub_categories',
                    'item_id'=>$subCategory->id,
                    'action'=>'store',
                    'user_id'=>$request->coach_id,
                ]);
                return $this->apiResponse($subCategory, 'success', 200);
            }

            return $this->apiResponse('', 'Something went wrong while storing cover image', 200);

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

            $subCategory = subCategory::find($id);
            if ($subCategory) {
                return $this->apiResponse($subCategory, 'success', 200);
            }
            return $this->apiResponse('', 'No category with this id', 200);

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
                'name' => ['required', 'string', 'max:100'],
                'name_ar' => ['string', 'max:100'],
                'name_ku' => ['string', 'max:100'],
                'description' => ['required', 'string', 'max:500'],
                'description_ar' => ['string', 'max:500'],
                'description_ku' => ['string', 'max:500'],
                'cover_image' => ['image'],
                'coach_id' => ['required',Rule::exists('users','id')],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $subCategory = subCategory::find($id);

            if ($subCategory) {
                if ($request->cover_image) {
                    $path = $this->replaceFile($subCategory->cover_image, $request->cover_image, 'images/subCategories/coverImages');
                }
                if ($request->name) {
                    $subCategory->name_en = $request->name;
                }
                if ($request->name_ar) {
                    $subCategory->name_ar = $request->name_ar;
                }
                if ($request->name_ku) {
                    $subCategory->name_ku = $request->name_ku;
                }
                if ($request->description) {
                    $subCategory->description_en = $request->description;
                }
                if ($request->description_ar) {
                    $subCategory->description_ar = $request->description_ar;
                }
                if ($request->description_ku) {
                    $subCategory->description_ku = $request->description_ku;
                }
                if ($request->cover_image) {
                    $subCategory->cover_image = $path;
                }

                $subCategory->save();

                \App\Models\log::create([
                    'table_name'=>'sub_categories',
                    'item_id'=>$subCategory->id,
                    'action'=>'update',
                    'user_id'=>$request->coach_id,
                ]);
                return $this->apiResponse($subCategory, 'success', 200);
            }
            return $this->apiResponse('', 'No sub category with this id', 200);
        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        try {

            $subCategory = subCategory::find($id);
            if ($subCategory) {
                $subCategory->delete();
                \App\Models\log::create([
                    'table_name'=>'sub_categories',
                    'item_id'=>$id,
                    'action'=>'destroy',
                    'user_id'=>$request->coach_id,
                ]);
                return $this->apiResponse('', 'success', 200);
            }
            return $this->apiResponse('', 'No category with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }



    public function deleteArrayOfSubCategories(Request $request)
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
            $cover_images_pathes = subCategory::query()->whereIn('id', $request->categories)->pluck('cover_image');

            if (!$this->deleteCollectionOfFiles($cover_images_pathes)) {
                return $this->apiResponse('', 'something went wrong whiled deleting images ', 400);
            }
            subCategory::whereIn('id', $request->categories)->delete();

            foreach ($request->categories as $categoryId){
                \App\Models\log::create([
                    'table_name'=>'sub_categories',
                    'item_id'=>$categoryId,
                    'action'=>'destroy',
                    'user_id'=>$request->coach_id,
                ]);
            }

            return $this->apiResponse('', 'success', 200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }


}
