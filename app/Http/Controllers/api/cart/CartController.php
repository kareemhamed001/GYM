<?php

namespace App\Http\Controllers\api\cart;

use App\classes\cart\CartClass;
use App\Http\Controllers\Controller;
use App\Models\cart;
use App\Models\video;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
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
                'number' => ['required', 'numeric', 'min:1'],
                'user_id' => ['required', 'integer', Rule::exists('users', 'id')],
                'supplement_id' => ['required', 'integer', Rule::exists('supplements', 'id')],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $cart = cart::where('user_id', $request->user_id)->where('supplement_id', $request->supplement_id)->get();

            if ($cart->count() == 0) {
                return cart::create($validator->validated());
            }
            $cart=$cart->first();
            if ($cart->number != $request->number) {
                $cart->number = $request->number;
                $cart->price = $request->price;
                $cart->discount = $request->discount;
                $cart->save();
            }

            return $this->apiResponse($cart, 'success', 200);
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

            $cart = CartClass::get($id);
            if ($cart) {
                return $this->apiResponse($cart, 'success', 200);
            }
            return $this->apiResponse('', 'No cart with this id', 200);

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
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }
}
