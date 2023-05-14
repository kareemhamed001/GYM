<?php

namespace App\Http\Controllers\api\products;

use App\Http\Controllers\Controller;
use App\Models\brand;
use App\Models\product;
use App\Models\product_color;
use App\Models\product_image;
use App\Models\product_size;
use App\Models\purchase;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use function PHPUnit\TestFixture\func;

class ProductsController extends Controller
{
    use ApiResponse;
    use ImagesOperations;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = product::all();
            return $this->apiResponse($products, 'success', 200);
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
                'quantity' => ['required', 'numeric', 'min:1'],
                'price' => ['required', 'numeric'],
                'discount' => ['required', 'numeric', 'max:100'],
                'brand_id' => ['integer', Rule::exists('brands', 'id')],
                'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
                'subcategory_id' => [ 'integer', Rule::exists('sub_categories', 'id')],
                'coach_id' => ['required', 'integer', Rule::exists('users', 'id')],
                'images' => ['required', 'array'],
                'cover_image' => ['required', 'image'],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }
            $product = DB::transaction(function () use ($request) {
                $path = $this->storeFile($request->cover_image, 'images/products/coverImages');
                $product = product::create([
                    'name_en' => $request->name,
                    'name_ar' => $request->name_ar,
                    'name_ku' => $request->name_ku,
                    'description_en' => $request->description,
                    'description_ar' => $request->description_ar,
                    'description_ku' => $request->description_ku,
                    'quantity' => $request->quantity,
                    'price' => $request->price,
                    'discount' => $request->discount,
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->category_id,
                    'cover_image' => $path,
                ]);

                foreach ($request->images as $image) {
                    $path = $this->storeFile($image, 'images/products/images');
                    product_image::create([
                        'product_id' => $product->id,
                        'image' => $path
                    ]);
                }
                if ($request->colors) {
                    foreach ($request->colors as $color) {

                        product_color::create([
                            'product_id' => $product->id,
                            'value' => $color
                        ]);
                    }
                }
                if ($request->sizes) {
                    foreach ($request->sizes as $size) {
                        product_size::create([
                            'product_id' => $product->id,
                            'value' => $size
                        ]);
                    }
                }

                \App\Models\log::create([
                    'table_name'=>'products',
                    'item_id'=>$product->id,
                    'action'=>'store',
                    'user_id'=>$request->coach_id,
                ]);
                return $product;
            });

            return $this->apiResponse($product, 'success', 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
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

            $product = product::find($id);
            if ($product) {
                return $this->apiResponse($product, 'success', 200);
            }
            return $this->apiResponse('', 'No product with this id', 200);

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
                'name_ar' => ['required', 'string', 'max:100'],
                'name_ku' => ['required', 'string', 'max:100'],
                'description' => ['required', 'string', 'max:500'],
                'description_ar' => ['required', 'string', 'max:500'],
                'description_ku' => ['required', 'string', 'max:500'],
                'quantity' => ['required', 'numeric', 'min:1'],
                'price' => ['required', 'numeric'],
                'discount' => ['required', 'numeric', 'max:100'],
                'brand_id' => ['integer', Rule::exists('brands', 'id')],
                'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
                'subcategory_id' => [ 'integer', Rule::exists('sub_categories', 'id')],
                'coach_id' => ['required', 'integer', Rule::exists('users', 'id')],
                'images' => [ 'array'],
                'cover_image' => [ 'image'],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }
//            return $validator->validated();
            $product = product::find($id);

            if ($product) {
                if ($request->cover_image) {
                    $path = $this->replaceFile($product->cover_image, $request->cover_image, 'images/products/coverImages');
                    $product->cover_image = $path;
                }

                $product->price = $request->price;
                $product->discount = $request->discount;

                if ($request->name) {
                    $product->name_en = $request->name;
                }
                if ($request->name_ar) {
                    $product->name_ar = $request->name_ar;
                }
                if ($request->name_ku) {
                    $product->name_ku = $request->name_ku;
                }
                if ($request->description) {
                    $product->description_en = $request->description;
                }
                if ($request->description_ar) {
                    $product->description_ar = $request->description_ar;
                }
                if ($request->description_ku) {
                    $product->description_ku = $request->description_ku;
                }
                if ($request->quantity) {
                    $product->quantity = $request->quantity;
                }
                if ($request->brand_id) {
                    $product->brand_id = $request->brand_id;
                }
                if ($request->category_id) {
                    $product->category_id = $request->category_id;
                }
                if ($request->subcategory_id) {
                    $product->subcategory_id = $request->subcategory_id;
                }


                if ($request->images) {
                    foreach ($request->images as $image) {
                        $path = $this->storeFile($image, 'images/products/images');
                        product_image::create([
                            'product_id' => $product->id,
                            'image' => $path
                        ]);
                    }
                }

                if ($request->colors) {
                    foreach ($request->colors as $color) {

                        product_color::create([
                            'product_id' => $product->id,
                            'value' => $color
                        ]);
                    }
                }
                if ($request->sizes) {
                    foreach ($request->sizes as $size) {
                        product_size::create([
                            'product_id' => $product->id,
                            'value' => $size
                        ]);
                    }
                }

                $product->save();

                \App\Models\log::create([
                    'table_name'=>'products',
                    'item_id'=>$product->id,
                    'action'=>'update',
                    'user_id'=>$request->coach_id,
                ]);

                return $this->apiResponse($product, 'success', 200);
            }
            return $this->apiResponse('', 'No product with this id', 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    function deleteImage($productId, $imageId)
    {

        try {

            $product = product::find($productId);
            $image = product_image::find($imageId);
            if (!$product) {
                return $this->apiResponse('', 'This product doesnt exists', 400);
            }
            if (!$image) {
                return $this->apiResponse('', 'This image doesnt exists', 400);
            }

            if ($image->product_id == $product->id) {
                $this->deleteFile($image->image);
                $image->delete();
                return $this->apiResponse('', 'success', 200);
            }

            return $this->apiResponse('', 'Some went wrong', 400);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    function deleteColor($productId, $colorId)
    {

        try {

            $product = product::find($productId);
            $color = product_color::find($colorId);
            if (!$product) {
                return $this->apiResponse('', 'This product doesnt exists', 404);
            }
            if (!$color) {
                return $this->apiResponse('', 'This color doesnt exists', 200);
            }

            if ($color->product_id == $product->id) {

                $color->delete();
                return $this->apiResponse('', 'success', 200);
            }

            return $this->apiResponse('', 'Some went wrong', 400);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    function deleteSize($productId, $sizeId)
    {

        try {

            $product = product::find($productId);
            $size = product_size::find($sizeId);
            if (!$product) {
                return $this->apiResponse('', 'This product doesnt exists', 404);
            }
            if (!$size) {
                return $this->apiResponse('', 'This size doesnt exists', 404);
            }

            if ($size->product_id == $product->id) {

                $size->delete();
                return $this->apiResponse('', 'success', 200);
            }

            return $this->apiResponse('', 'Some went wrong', 400);
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

            $product = product::find($id);
            if ($product) {
                $product->delete();
                \App\Models\log::create([
                    'table_name'=>'products',
                    'item_id'=>$id,
                    'action'=>'destroy',
                    'user_id'=>$request->coach_id,
                ]);
                return $this->apiResponse('', 'success', 200);
            }
            return $this->apiResponse('', 'No product with this id', 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function getBrandByProductId($id)
    {
        try {

            $product = product::with('brand')->find($id);
            if ($product) {
                return $this->apiResponse($product, 'success', 200);
            }
            return $this->apiResponse('', 'No product with this id', 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function getCoachByProductId($id)
    {
        try {

            $product = product::with('coach')->find($id);
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

            $product = product::with('purchases')->find($id);
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

            $cover_images_pathes = product::query()->whereIn('id', $request->products)->pluck('cover_image');

            if (!$this->deleteCollectionOfFiles($cover_images_pathes)) {
                return $this->apiResponse('', 'something went wrong whiled deleting images ', 400);
            }
            product::whereIn('id', $request->products)->delete();
            return $this->apiResponse('', 'success', 200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
