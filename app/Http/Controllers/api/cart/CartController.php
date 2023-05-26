<?php

namespace App\Http\Controllers\api\cart;

use App\classes\cart\CartClass;
use App\Http\Controllers\Controller;
use App\Models\cart;
use App\Models\video;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CartController extends Controller
{
    use ApiResponse;
    use ImagesOperations;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $carts = CartClass::getAll();
            return $this->apiResponse($carts, 'success', 200);
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
                'price' => ['required', 'numeric'],
                'discount' => ['required', 'numeric', 'max:100'],
                'quantity' => ['required', 'numeric', 'min:1'],
                'user_id' => ['required', 'integer', Rule::exists('users', 'id')],
                'product_id' => ['required', 'integer', Rule::exists('products', 'id')],
                'color' => ['nullable', 'integer', Rule::exists('product_colors', 'id')],
                'size' => ['nullable', 'integer', Rule::exists('product_sizes', 'id')],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $cart = cart::where('user_id', $request->user_id)->where('product_id', $request->product_id)->get();

            if ($cart->count() == 0) {
                return cart::create([
                    'price' => $request->price,
                    'discount' => $request->discount,
                    'quantity' => $request->quantity,
                    'color_id' => $request->color,
                    'size_id' => $request->size,
                    'user_id' => $request->user_id,
                    'product_id' => $request->product_id,
                ]);
            }
            $cart = $cart->first();
            if ($cart) {
                if ($request->color){
                    $cart->color_id=$request->color;
                }
                if ($request->size){
                    $cart->size_id=$request->size;
                }
                $cart->quantity = $request->quantity;
                $cart->price = $request->price;
                $cart->discount = $request->discount;
                $cart->save();
            }

            return $this->apiResponse($cart, 'success', 200);
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

            $cart = CartClass::get($id);
            if ($cart) {
                return $this->apiResponse($cart, 'success', 200);
            }
            return $this->apiResponse('', 'No cart with this id', 200);

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
                'price' => ['numeric'],
                'discount' => ['numeric', 'max:100'],
                'number' => ['numeric', 'min:1'],
                'user_id' => ['integer', Rule::exists('users', 'id')],
                'supplement_id' => ['integer', Rule::exists('supplements', 'id')],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $cart = CartClass::get($id);

            if ($cart) {

                if ($request->price) {
                    $cart->price = $request->price;
                }
                if ($request->discount) {
                    $cart->discount = $request->discount;
                }
                if ($request->number) {
                    $cart->number = $request->number;
                }
                if ($request->user_id) {
                    $cart->user_id = $request->user_id;
                }
                if ($request->supplement_id) {
                    $cart->supplement_id = $request->supplement_id;
                }

                $cart->save();

                return $this->apiResponse($cart, 'success', 200);
            }
            return $this->apiResponse('', 'No cart with this id', 200);
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

            $cart = CartClass::get($id);
            if ($cart) {
                CartClass::destroy($id);
                return $this->apiResponse('', 'success', 200);
            }
            return $this->apiResponse('', 'No cart with this id', 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function getUserByCartId($id)
    {
        try {

            $cart = cart::with('user')->find($id);
            if ($cart) {
                return $this->apiResponse($cart, 'success', 200);
            }
            return $this->apiResponse('', 'No cart with this id', 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function getProductByCartId($id)
    {
        try {

            $cart = cart::with('supplement')->find($id);
            if ($cart) {
                return $this->apiResponse($cart, 'success', 200);
            }
            return $this->apiResponse('', 'No cart with this id', 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }
}
