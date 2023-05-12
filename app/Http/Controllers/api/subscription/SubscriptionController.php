<?php

namespace App\Http\Controllers\api\subscription;

use App\classes\subscription\SubscriptionClass;
use App\Http\Controllers\Controller;
use App\Models\muscle;
use App\Models\subscription;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SubscriptionController extends Controller
{
    use ApiResponse;
    use ImagesOperations;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $subscriptions = SubscriptionClass::getAll();
            return $this->apiResponse($subscriptions, 'success', 200);
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
                'user_id' => ['required', 'integer', Rule::exists('users', 'id')],
                'course_id' => ['required', 'integer', Rule::exists('courses', 'id')],

            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $subscription = subscription::create([
                'price' => $request->price,
                'discount' => $request->discount,
                'user_id' => $request->user_id,
                'course_id' => $request->course_id

            ]);
            return $this->apiResponse($subscription, 'success', 200);
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

            $subscription = SubscriptionClass::get($id);
            if ($subscription) {
                return $this->apiResponse($subscription, 'success', 200);
            }
            return $this->apiResponse('', 'No subscription with this id', 200);

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
                'user_id' => ['integer', Rule::exists('users', 'id')],
                'course_id' => ['integer', Rule::exists('courses', 'id')],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $subscription = SubscriptionClass::get($id);

            if ($subscription) {

                if ($request->price) {
                    $subscription->price = $request->price;
                }
                if ($request->discount) {
                    $subscription->discount = $request->discount;
                }
                if ($request->user_id) {
                    $subscription->user_id = $request->user_id;
                }
                if ($request->supplement_id) {
                    $subscription->supplement_id = $request->supplement_id;
                }

                $subscription->save();

                return $this->apiResponse($subscription, 'success', 200);
            }
            return $this->apiResponse('', 'No subscription with this id', 200);
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

            $subscription = SubscriptionClass::get($id);
            if ($subscription) {
                SubscriptionClass::destroy($id);
                return $this->apiResponse('', 'success', 200);
            }
            return $this->apiResponse('', 'No subscription with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function getUserBySubscriptionId($id)
    {
        try {

            $subscription = subscription::with('user')->find($id);
            if ($subscription) {
                return $this->apiResponse($subscription, 'success', 200);
            }
            return $this->apiResponse('', 'No subscription with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }
    public function getCourseBySubscriptionId($id)
    {
        try {

            $subscription = subscription::with('course')->find($id);
            if ($subscription) {
                return $this->apiResponse($subscription, 'success', 200);
            }
            return $this->apiResponse('', 'No subscription with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }
}
