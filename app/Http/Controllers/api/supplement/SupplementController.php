<?php

namespace App\Http\Controllers\api\supplement;

use App\classes\supplement\SupplementClass;
use App\Http\Controllers\Controller;
use App\Models\brand;
use App\Models\purchase;
use App\Models\supplement;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
                'name_ar' => ['nullable','string', 'max:100'],
                'name_ku' => ['nullable','string', 'max:100'],
                'description' => ['required', 'string', 'max:500'],
                'description_ar' => ['nullable','string', 'max:500'],
                'description_ku' => ['nullable','string', 'max:500'],
                'price' => ['required', 'numeric'],
                'discount' => ['required', 'numeric', 'max:100'],
                'quantity' => ['required', 'numeric', 'min:1'],
                'brand_id' => ['required', 'integer', Rule::exists('brands', 'id')],
                'coach_id' => ['required', 'integer', Rule::exists('coaches', 'id')],
                'cover_image' => ['required', 'image'],
                'unit' => ['required', 'string','max:20'],

            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

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
                'coach_id' => $request->coach_id,
                'cover_image' => $path,
                'unit' => $request->unit
            ]);
            return $this->apiResponse($supplement, 'success', 200);
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
                'name' => ['string', 'max:100'],
                'name_ar' => ['string', 'max:100'],
                'name_ku' => ['string', 'max:100'],
                'description' => ['string', 'max:500'],
                'description_ar' => ['string', 'max:500'],
                'description_ku' => ['string', 'max:500'],
                'price' => ['numeric'],
                'discount' => ['numeric', 'max:100'],
                'quantity' => ['numeric', 'min:1'],
                'brand_id' => ['integer', Rule::exists('brands', 'id')],
                'coach_id' => ['integer', Rule::exists('coaches', 'id')],
                'cover_image' => ['image'],
                'unit' => ['string','max:20'],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $supplement = SupplementClass::get($id);

            if ($supplement) {
                if ($request->cover_image){
                    $path=$this->replaceFile($supplement->cover_image,$request->cover_image,'images/supplements/coverImages');
                    $supplement->cover_image=$path;
                }
                if ($request->price) {
                    $supplement->price = $request->price;
                }
                if ($request->discount) {
                    $supplement->discount = $request->discount;
                }
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
                if ($request->coach_id) {
                    $supplement->coach_id = $request->coach_id;
                }
                if ($request->unit) {
                    $supplement->unit = $request->unit;
                }

                $supplement->save();

                return $this->apiResponse($supplement, 'success', 200);
            }
            return $this->apiResponse('', 'No supplement with this id', 200);
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
                SupplementClass::destroy($id);
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
    public function deleteArrayOfProducts(Request $request){
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
            supplement::whereIn('id', $request->products)->delete();
            return $this->apiResponse('','success',200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
