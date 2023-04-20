<?php

namespace App\Http\Controllers\api\wishlist;


use App\Http\Controllers\Controller;
use App\Models\cart;
use App\Models\wish_list;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WishListController extends Controller
{
    use ApiResponse;
    use ImagesOperations;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $wishlists = wish_list::paginate();
            return $this->apiResponse($wishlists, 'success', 200);
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
                'user_id' => ['required', 'integer', Rule::exists('users', 'id')],
                'supplement_id' => ['required', 'integer', Rule::exists('supplements', 'id')],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }
            $wishlist = wish_list::create([
                'user_id'=>$request->user_id,
                'supplement_id'=>$request->supplement_id,
            ]);
            return $this->apiResponse($wishlist, 'success', 200);
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

            $wishlist = wish_list::find($id);
            if ($wishlist) {
                return $this->apiResponse($wishlist, 'success', 200);
            }
            return $this->apiResponse('', 'No wishlist with this id', 200);

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
                'user_id' => ['integer', Rule::exists('users', 'id')],
                'supplement_id' => ['integer', Rule::exists('supplements', 'id')],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }

            $wishlist = wish_list::find($id);

            if ($wishlist) {

                if ($request->user_id) {
                    $wishlist->user_id = $request->user_id;
                }
                if ($request->supplement_id) {
                    $wishlist->supplement_id = $request->supplement_id;
                }

                $wishlist->save();

                return $this->apiResponse($wishlist, 'success', 200);
            }
            return $this->apiResponse('', 'No wishlist with this id', 200);
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

            $wishlist = wish_list::find($id);
            if ($wishlist) {
                $wishlist->delete();
                return $this->apiResponse('', 'success', 200);
            }
            return $this->apiResponse('', 'No wishlist with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function getProductByWishlistId($id)
    {
        try {

            $wish = cart::with('supplement')->find($id);
            if ($wish) {
                return $this->apiResponse($wish, 'success', 200);
            }
            return $this->apiResponse('', 'No wishlist with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }
    public function getUserByWishlistId($id)
    {
        try {

            $wish = cart::with('user')->find($id);
            if ($wish) {
                return $this->apiResponse($wish, 'success', 200);
            }
            return $this->apiResponse('', 'No wishlist with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }
}
