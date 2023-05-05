<?php

namespace App\Http\Controllers\api\brand;

use App\classes\brand\BrandClass;
use App\Http\Controllers\Controller;
use App\Models\brand;
use App\Models\brands_category;
use App\Models\category;
use App\Models\supplement;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            $brands = BrandClass::getAll();
            return $this->apiResponse($brands, 'success', 200);
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
                'name_ar' => ['nullable', 'string', 'max:100'],
                'name_ku' => ['nullable', 'string', 'max:100'],
                'description' => ['required', 'string', 'max:500'],
                'description_ar' => ['nullable', 'string', 'max:500'],
                'description_ku' => ['nullable', 'string', 'max:500'],
                'coach_id' => ['required', 'integer', Rule::exists('coaches', 'id')],
                'cover_image' => ['required', 'image'],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $path = $this->storeFile($request->cover_image, 'images/brands/coverImages');
            if ($path) {
                $brand = brand::create([
                    'name' => $request->name,
                    'name_ar' => $request->name_ar,
                    'name_ku' => $request->name_ku,
                    'description' => $request->description,
                    'description_ar' => $request->description_ar,
                    'description_ku' => $request->description_ku,
                    'coach_id' => $request->coach_id,
                    'cover_image' => $path
                ]);
                return $this->apiResponse($brand, 'success', 200);
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

            $brand = BrandClass::get($id);
            if ($brand) {
                return $this->apiResponse($brand, 'success', 200);
            }
            return $this->apiResponse('', 'No brand with this id', 200);

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
                'name' => ['string', 'max:100'],
                'name_ar' => ['string', 'max:100'],
                'name_ku' => ['string', 'max:100'],
                'description' => ['string', 'max:500'],
                'description_ar' => ['string', 'max:500'],
                'description_ku' => ['string', 'max:500'],
                'coach_id' => ['integer', Rule::exists('coaches', 'id')],
                'cover_image' => ['image'],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $brand = brand::find($id);

            if ($brand) {
                if ($request->cover_image) {
                    $path = $this->replaceFile($brand->cover_image, $request->cover_image, 'images/brands/coverImages');
                }
                if ($request->name) {
                    $brand->name = $request->name;
                }
                if ($request->name_ar) {
                    $brand->name_ar = $request->name_ar;
                }
                if ($request->name_ku) {
                    $brand->name_ku = $request->name_ku;
                }
                if ($request->description) {
                    $brand->description = $request->description;
                }
                if ($request->description_ar) {
                    $brand->description_ar = $request->description_ar;
                }
                if ($request->description_ku) {
                    $brand->description_ku = $request->description_ku;
                }
                if ($request->coach_id) {
                    $brand->coach_id = $request->coach_id;
                }
                if ($request->cover_image) {
                    $brand->cover_image = $path;
                }

                $brand->save();

                return $this->apiResponse($brand, 'success', 200);
            }
            return $this->apiResponse('', 'No brand with this id', 200);
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
            $brand = BrandClass::get($id);
            if ($brand) {
                BrandClass::destroy($id);
                return $this->apiResponse('', 'success', 200);
            }
            return $this->apiResponse('', 'No brand with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function getCoachByBrandId($id)
    {
        try {
            $brand = brand::find($id);
            if ($brand) {
                return $this->apiResponse($brand->coach, 'success', 200);
            }
            return $this->apiResponse('', 'No brand with this id', 200);
        } catch (\Exception $e) {
            return $this->apiResponse('', $e->getMessage(), 400);
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
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }

    public function getCategoriesBrandId($id)
    {
        try {
            $brand = brand::find($id);
            if ($brand) {
                $categories=supplement::select('category_id,categories.name,categories.name_ar,categories.name_ku,categories.description,categories.description_ar,categories.description_ku,categories.cover_image')->join('categories','supplements.category_id','=','categories.id')->where('supplements.brand_id',$brand->id)->get();
                return $this->apiResponse($categories, 'success', 200);
            }
            return $this->apiResponse('', 'No brand with this id', 200);
        } catch (\Exception $e) {
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
            return $this->apiResponse('','success',200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

}
