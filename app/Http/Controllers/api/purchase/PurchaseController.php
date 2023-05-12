<?php

namespace App\Http\Controllers\api\purchase;

use App\classes\purchase\PurchaseClass;
use App\Http\Controllers\Controller;
use App\Models\muscle;
use App\Models\purchase;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PurchaseController extends Controller
{
    use ApiResponse;
    use ImagesOperations;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $purchases = PurchaseClass::getAll();
            return $this->apiResponse($purchases, 'success', 200);
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

            $purchase = purchase::create([
                'price' => $request->price,
                'discount' => $request->discount,
                'number' => $request->number,
                'user_id' => $request->user_id,
                'supplement_id' => $request->supplement_id

            ]);
            return $this->apiResponse($purchase, 'success', 200);
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

            $purchase = PurchaseClass::get($id);
            if ($purchase) {
                return $this->apiResponse($purchase, 'success', 200);
            }
            return $this->apiResponse('', 'No purchase with this id', 200);

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

            $purchase = PurchaseClass::get($id);

            if ($purchase) {

                if ($request->price) {
                    $purchase->price = $request->price;
                }
                if ($request->discount) {
                    $purchase->discount = $request->discount;
                }
                if ($request->number) {
                    $purchase->number = $request->number;
                }
                if ($request->user_id) {
                    $purchase->user_id = $request->user_id;
                }
                if ($request->supplement_id) {
                    $purchase->supplement_id = $request->supplement_id;
                }

                $purchase->save();

                return $this->apiResponse($purchase, 'success', 200);
            }
            return $this->apiResponse('', 'No purchase with this id', 200);
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

            $purchase = PurchaseClass::get($id);
            if ($purchase) {
                PurchaseClass::destroy($id);
                return $this->apiResponse('', 'success', 200);
            }
            return $this->apiResponse('', 'No purchase with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function getUserByPurchaseId($id)
    {
        try {

            $purchase = purchase::with('user')->find($id);
            if ($purchase) {
                return $this->apiResponse($purchase, 'success', 200);
            }
            return $this->apiResponse('', 'No purchase with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function getProductByPurchaseId($id)
    {
        try {

            $purchase = purchase::with('supplement')->find($id);
            if ($purchase) {
                return $this->apiResponse($purchase, 'success', 200);
            }
            return $this->apiResponse('', 'No purchase with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }
}
