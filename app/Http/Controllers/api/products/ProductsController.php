<?php

namespace App\Http\Controllers\api\products;

use App\classes\product\ProductClass;
use App\Http\Controllers\Controller;
use App\Models\brand;
use App\Models\product;
use App\Models\product_color;
use App\Models\product_image;
use App\Models\product_size;
use App\Models\purchase;
use App\Models\TemporatyFile;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use function PHPUnit\TestFixture\func;
use function Webmozart\Assert\Tests\StaticAnalysis\null;

class ProductsController extends Controller
{
    use ApiResponse;
    use ImagesOperations;
    protected ProductClass $productService;
    function __construct(ProductClass $productClass){
        $this->productService=$productClass;
    }

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

    function storeRules(){
        return [
            'name' => ['required', 'string', 'max:100'],
            'name_ar' => ['required', 'string', 'max:100'],
            'name_ku' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:500'],
            'description_ar' => ['required', 'string', 'max:500'],
            'description_ku' => ['required', 'string', 'max:500'],
            'quantity' => ['required', 'numeric', 'min:1'],
            'price' => ['required', 'numeric'],
            'discount' => ['required', 'numeric', 'max:100'],
            'brand_id' => ['numeric', Rule::exists('brands', 'id')],
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
            'subcategory_id' => [ 'integer', Rule::exists('sub_categories', 'id')],
            'coach_id' => ['required', 'integer', Rule::exists('users', 'id')],
            'images' => ['required', 'array'],
            'colors' => ['nullable', 'array'],
            'sizes' => ['nullable', 'array'],
        ];
    }

    function updateRules(){
        return [
            'name' => ['nullable', 'string', 'max:100'],
            'name_ar' => ['nullable', 'string', 'max:100'],
            'name_ku' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:500'],
            'description_ar' => ['nullable', 'string', 'max:500'],
            'description_ku' => ['nullable', 'string', 'max:500'],
            'quantity' => ['nullable', 'numeric', 'min:1'],
            'price' => ['nullable', 'numeric'],
            'discount' => ['nullable', 'numeric', 'max:100'],
            'brand_id' => ['integer', Rule::exists('brands', 'id')],
            'category_id' => ['nullable', 'integer', Rule::exists('categories', 'id')],
            'subcategory_id' => [ 'integer', Rule::exists('sub_categories', 'id')],
            'coach_id' => ['required', 'integer', Rule::exists('users', 'id')],
            'images' => [ 'array'],
            'oldImages' => [ 'array'],
            'cover_image' => ['nullable', 'image'],
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),$this->storeRules());
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }
            $product=$this->productService->store($request->images[0],$request->name,$request->name_ar,$request->name_ku,$request->description,
                $request->description_ar,$request->description_ku,$request->quantity,$request->price,$request->discount,$request->category_id,
                $request->images,$request->brand_id??null,$request->subcategory_id??null,$request->colors??null,$request->sizes??null);

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

            return $this->apiResponse($this->productService->get($id),'success',200);

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
            $validator = Validator::make($request->all(),$this->updateRules() );
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $product=$this->productService->update($id,$request->coach_id,$request->name,$request->name_ar,$request->name_ku,$request->description,
                $request->description_ar,$request->description_ku,$request->quantity,$request->price,$request->discount,$request->category_id,
                $request->oldImages,$request->cover_image??null,$request->images??null,$request->brand_id??null,$request->subcategory_id??null,$request->colors??null,$request->sizes??null);

            return $this->apiResponse($product, 'success', 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse('', $e->getMessage(), 400);
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

            $deleted=$this->productService->deleteCollection($request->products);
            if (!$deleted){
                return $this->apiResponse('', 'some thing went wrong', 400);
            }
            return $this->apiResponse('', 'success', 200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    function tmpUpload(Request $request){

        if ($request->hasFile('images')){
            $image=is_array($request->file('images'))?$request->file('images')[0]:$request->file('images');

            $path=$this->storeFile($image,'images/products/images');
            TemporatyFile::create([
                'file_path'=>$path
            ]);
            return $path;
        }
        return '';
    }

    function tmpDelete(){
        try {
            $tmp_file=TemporatyFile::where('file_path',request()->getContent())->first();
            if ($tmp_file){

                $this->deleteFile($tmp_file->file_path);
                $tmp_file->delete();
                return response('success',200);
            }
            return response('error',400);
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return response($e->getMessage(),400);
        }

    }
}
