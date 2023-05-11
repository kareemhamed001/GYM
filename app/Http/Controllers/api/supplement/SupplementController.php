<?php

namespace App\Http\Controllers\api\supplement;

use App\classes\supplement\SupplementClass;
use App\Http\Controllers\Controller;
use App\Models\brand;
use App\Models\product_color;
use App\Models\product_image;
use App\Models\product_size;
use App\Models\purchase;
use App\Models\supplement;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use function PHPUnit\TestFixture\func;

class SupplementController extends Controller
{
    use ApiResponse;
    use ImagesOperations;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $supplements = SupplementClass::getAll();
            return $this->apiResponse($supplements, 'success', 200);
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
                'price' => ['required', 'numeric'],
                'discount' => ['required', 'numeric', 'max:100'],
                'quantity' => ['required', 'numeric', 'min:1'],
                'brand_id' => ['required', 'integer', Rule::exists('brands', 'id')],
                'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
                'coach_id' => ['required', 'integer', Rule::exists('coaches', 'id')],
                'images' => ['required', 'array'],
                'cover_image' => ['required', 'image'],
                'unit' => ['required', 'string', 'max:20'],

            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }
            $supplement = DB::transaction(function () use ($request) {
                $path = $this->storeFile($request->cover_image, 'images/supplements/coverImages');
                $supplement = supplement::create([
                    'name' => $request->name,
                    'name_ar' => $request->name_ar,
                    'name_ku' => $request->name_ku,
                    'description' => $request->description,
                    'description_ar' => $request->description_ar,
                    'description_ku' => $request->description_ku,
                    'price' => $request->price,
                    'discount' => $request->discount,
                    'quantity' => $request->quantity,
                    'brand_id' => $request->brand_id,
                    'category_id' => $request->category_id,
                    'coach_id' => $request->coach_id,
                    'cover_image' => $path,
                    'unit' => $request->unit
                ]);

                foreach ($request->images as $image) {
                    $path = $this->storeFile($image, 'images/supplements/images');
                    product_image::create([
                        'supplement_id' => $supplement->id,
                        'image' => $path
                    ]);
                }
                if ($request->colors) {
                    foreach ($request->colors as $color) {

                        product_color::create([
                            'supplement_id' => $supplement->id,
                            'value' => $color
                        ]);
                    }
                }
                if ($request->sizes) {
                    foreach ($request->sizes as $size) {
                        product_size::create([
                            'supplement_id' => $supplement->id,
                            'value' => $size
                        ]);
                    }
                }
                return $supplement;
            });

            return $this->apiResponse($supplement, 'success', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $supplement = SupplementClass::get($id);
            if ($supplement) {
                return $this->apiResponse($supplement, 'success', 200);
            }
            return $this->apiResponse('', 'No supplement with this id', 200);

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
                'name_ar' => ['required', 'string', 'max:100'],
                'name_ku' => ['required', 'string', 'max:100'],
                'description' => ['required', 'string', 'max:500'],
                'description_ar' => ['required', 'string', 'max:500'],
                'description_ku' => ['required', 'string', 'max:500'],
                'price' => ['required', 'numeric'],
                'discount' => ['required', 'numeric', 'max:100'],
                'quantity' => ['required', 'numeric', 'min:1'],
                'brand_id' => ['required', 'integer', Rule::exists('brands', 'id')],
                'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
                'coach_id' => ['required', 'integer', Rule::exists('coaches', 'id')],
                'images' => ['array'],
                'cover_image' => ['image'],
                'unit' => ['required', 'string', 'max:20'],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }
//            return $validator->validated();
            $supplement = supplement::find($id);

            if ($supplement) {
                if ($request->cover_image) {
                    $path = $this->replaceFile($supplement->cover_image, $request->cover_image, 'images/supplements/coverImages');
                    $supplement->cover_image = $path;
                }

                $supplement->price = $request->price;
                $supplement->discount = $request->discount;

                if ($request->name) {
                    $supplement->name = $request->name;
                }
                if ($request->name_ar) {
                    $supplement->name_ar = $request->name_ar;
                }
                if ($request->name_ku) {
                    $supplement->name_ku = $request->name_ku;
                }
                if ($request->description) {
                    $supplement->description = $request->description;
                }
                if ($request->description_ar) {
                    $supplement->description_ar = $request->description_ar;
                }
                if ($request->description_ku) {
                    $supplement->description_ku = $request->description_ku;
                }
                if ($request->quantity) {
                    $supplement->quantity = $request->quantity;
                }
                if ($request->brand_id) {
                    $supplement->brand_id = $request->brand_id;
                }
                if ($request->category_id) {
                    $supplement->category_id = $request->category_id;
                }
                if ($request->coach_id) {
                    $supplement->coach_id = $request->coach_id;
                }
                if ($request->unit) {
                    $supplement->unit = $request->unit;
                }

                if ($request->images) {
                    foreach ($request->images as $image) {
                        $path = $this->storeFile($image, 'images/supplements/images');
                        product_image::create([
                            'supplement_id' => $supplement->id,
                            'image' => $path
                        ]);
                    }
                }

                if ($request->colors) {
                    foreach ($request->colors as $color) {

                        product_color::create([
                            'supplement_id' => $supplement->id,
                            'value' => $color
                        ]);
                    }
                }
                if ($request->sizes) {
                    foreach ($request->sizes as $size) {
                        product_size::create([
                            'supplement_id' => $supplement->id,
                            'value' => $size
                        ]);
                    }
                }

                $supplement->save();

                return $this->apiResponse($supplement, 'success', 200);
            }
            return $this->apiResponse('', 'No supplement with this id', 200);
        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    function deleteImage($supplementId, $imageId)
    {

        try {

            $supplement = supplement::find($supplementId);
            $image = product_image::find($imageId);
            if (!$supplement) {
                return $this->apiResponse('', 'This product doesnt exists', 400);
            }
            if (!$image) {
                return $this->apiResponse('', 'This image doesnt exists', 400);
            }

            if ($image->supplement_id == $supplement->id) {
                $this->deleteFile($image->image);
                $image->delete();
                return $this->apiResponse('', 'success', 200);
            }

            return $this->apiResponse('', 'Some went wrong', 400);
        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    function deleteColor($supplementId, $colorId)
    {

        try {

            $supplement = supplement::find($supplementId);
            $color = product_color::find($colorId);
            if (!$supplement) {
                return $this->apiResponse('', 'This product doesnt exists', 404);
            }
            if (!$color) {
                return $this->apiResponse('', 'This color doesnt exists', 200);
            }

            if ($color->supplement_id == $supplement->id) {

                $color->delete();
                return $this->apiResponse('', 'success', 200);
            }

            return $this->apiResponse('', 'Some went wrong', 400);
        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    function deleteSize($supplementId, $sizeId)
    {

        try {

            $supplement = supplement::find($supplementId);
            $size = product_size::find($sizeId);
            if (!$supplement) {
                return $this->apiResponse('', 'This product doesnt exists', 404);
            }
            if (!$size) {
                return $this->apiResponse('', 'This size doesnt exists', 404);
            }

            if ($size->supplement_id == $supplement->id) {

                $size->delete();
                return $this->apiResponse('', 'success', 200);
            }

            return $this->apiResponse('', 'Some went wrong', 400);
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

            $supplement = SupplementClass::get($id);
            if ($supplement) {
                if (!SupplementClass::destroy($id)) {
                    return $this->apiResponse('', 'error', 400);
                }
                return $this->apiResponse('', 'success', 200);
            }
            return $this->apiResponse('', 'No supplement with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function getBrandByProductId($id)
    {
        try {

            $product = supplement::with('brand')->find($id);
            if ($product) {
                return $this->apiResponse($product, 'success', 200);
            }
            return $this->apiResponse('', 'No product with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function getCoachByProductId($id)
    {
        try {

            $product = supplement::with('coach')->find($id);
            if ($product) {
                return $this->apiResponse($product, 'success', 200);
            }
            return $this->apiResponse('', 'No product with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function getPurchasesByProductId($id)
    {
        try {

            $product = supplement::with('purchases')->find($id);
            if ($product) {
                return $this->apiResponse($product, 'success', 200);
            }
            return $this->apiResponse('', 'No product with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function deleteArrayOfProducts(Request $request)
    {
        try {
            $validator = validator::make($request->all(), [
                'products' => ['required', 'array'],
            ]);

            if ($validator->fails()) {
                return response()->json(['data' => null, 'message' => $validator->errors()], 400);
            }

            if (!is_array($request->products)) {
                return response()->json(['data' => null, 'message' => 'products must be in array'], 200);
            }

            $cover_images_pathes = supplement::query()->whereIn('id', $request->products)->pluck('cover_image');

            if (!$this->deleteCollectionOfFiles($cover_images_pathes)) {
                return $this->apiResponse('', 'something went wrong whiled deleting images ', 400);
            }
            supplement::whereIn('id', $request->products)->delete();
            return $this->apiResponse('', 'success', 200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
