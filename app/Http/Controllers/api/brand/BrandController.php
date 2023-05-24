<?php

namespace App\Http\Controllers\api\brand;


use App\Http\Controllers\Controller;
use App\Models\brand;
use App\Models\brands_category;
use App\Models\category;
use App\Models\product;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use function PHPUnit\TestFixture\func;

class BrandController extends Controller
{
    use ApiResponse;
    use ImagesOperations;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $brands = brand::all();
            return $this->apiResponse($brands, 'success', 200);
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
                'name' => ['required', 'string', 'max:100'],
                'name_ar' => ['nullable', 'string', 'max:100'],
                'name_ku' => ['nullable', 'string', 'max:100'],
                'description' => ['required', 'string', 'max:500'],
                'description_ar' => ['nullable', 'string', 'max:500'],
                'description_ku' => ['nullable', 'string', 'max:500'],
                'coach_id' => ['required', 'integer', Rule::exists('users', 'id')],
                'cover_image' => ['required', 'image'],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $path = $this->storeFile($request->cover_image, 'images/brands/coverImages');
            if ($path) {
                $brand = brand::create([
                    'name_en' => $request->name,
                    'name_ar' => $request->name_ar,
                    'name_ku' => $request->name_ku,
                    'description_en' => $request->description,
                    'description_ar' => $request->description_ar,
                    'description_ku' => $request->description_ku,
                    'cover_image' => $path
                ]);
                \App\Models\log::create([
                    'table_name'=>'brands',
                    'item_id'=>$brand->id,
                    'action'=>'store',
                    'user_id'=>$request->coach_id,
                ]);
                return $this->apiResponse($brand, 'success', 200);
            }

            return $this->apiResponse('', 'Something went wrong while storing cover image', 200);

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

            $brand = brand::find($id);
            if ($brand) {
                return $this->apiResponse($brand, 'success', 200);
            }
            return $this->apiResponse('', 'No brand with this id', 200);

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
                'name' => ['nullable','string', 'max:100'],
                'name_ar' => ['nullable','string', 'max:100'],
                'name_ku' => ['nullable','string', 'max:100'],
                'description' => ['nullable','string', 'max:500'],
                'description_ar' => ['nullable','string', 'max:500'],
                'description_ku' => ['nullable','string', 'max:500'],
                'coach_id' => ['nullable','integer', Rule::exists('users', 'id')],
                'cover_image' => ['nullable','image'],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $brand = brand::find($id);

            if ($brand) {
                if ($request->cover_image) {
                    $path = $this->replaceFile($brand->cover_image, $request->cover_image, 'images/brands/coverImages');
                    $brand->cover_image = $path;
                }
                if ($request->name) {
                    $brand->name_en = $request->name;
                }
                if ($request->name_ar) {
                    $brand->name_ar = $request->name_ar;
                }
                if ($request->name_ku) {
                    $brand->name_ku = $request->name_ku;
                }
                if ($request->description) {
                    $brand->description_en = $request->description;
                }
                if ($request->description_ar) {
                    $brand->description_ar = $request->description_ar;
                }
                if ($request->description_ku) {
                    $brand->description_ku = $request->description_ku;
                }

                $brand->save();

                \App\Models\log::create([
                    'table_name'=>'brands',
                    'item_id'=>$brand->id,
                    'action'=>'update',
                    'user_id'=>$request->coach_id,
                ]);
                return $this->apiResponse($brand, 'success', 200);
            }
            return $this->apiResponse('', 'No brand with this id', 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {

        try {
            $brand = brand::find($id);
            if ($brand) {
                brand::destroy($id);
                \App\Models\log::create([
                    'table_name'=>'brands',
                    'item_id'=>$id,
                    'action'=>'destroy',
                    'user_id'=>$request->coach_id,
                ]);
                return $this->apiResponse('', 'success', 200);
            }
            return $this->apiResponse('', 'No brand with this id', 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function getProductsByBrandId($id)
    {
        try {
            $brand = brand::find($id);
            if ($brand) {
                return $this->apiResponse($brand->supplements, 'success', 200);
            }
            return $this->apiResponse('', 'No brand with this id', 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }

    public function getCategoriesBrandId($id)
    {
        try {
            $brand = brand::find($id);
            if ($brand) {
                $categories=product::query()->select('category_id')->where('brand_id',$brand->id)->orderBy('category_id')->groupBy('category_id')->get();
                $categories=$categories->map(function ($category){
                    return category::where('id',$category->category_id)->get();
                });
                return $this->apiResponse($categories, 'success', 200);
            }
            return $this->apiResponse('', 'No brand with this id', 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }

    public function deleteArrayOfBrands(Request $request){
        try {
            $validator = validator::make($request->all(), [
                'brands' => ['required', 'array'],
            ]);

            if ($validator->fails()) {
                return response()->json(['data' => null, 'message' => $validator->errors()], 400);
            }

            if (!is_array($request->brands)) {
                return response()->json(['data' => null, 'message' => 'brands must be in array'], 200);
            }
            $cover_images_pathes=brand::query()->whereIn('id', $request->brands)->pluck('cover_image');

            if (!$this->deleteCollectionOfFiles($cover_images_pathes)){
                return $this->apiResponse('','something went wrong whiled deleting images ',400);
            }
            brand::whereIn('id', $request->brands)->delete();
            foreach ($request->brands as $brand){
                \App\Models\log::create([
                    'table_name'=>'brands',
                    'item_id'=>$brand,
                    'action'=>'delete'
                ]);
            }
            return $this->apiResponse('','success',200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

}
