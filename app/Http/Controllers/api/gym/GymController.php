<?php

namespace App\Http\Controllers\api\gym;

use App\classes\category\CategoryClass;
use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\gym;
use App\Models\log;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class GymController extends Controller
{

    use ApiResponse;
    use ImagesOperations;


    function index(){
        try {
            return $this->apiResponse(gym::all(),'success',200);
        }catch (\Exception $e){
            \Log::error($e->getTraceAsString());
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }

    function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name_en' => ['required', 'string', 'max:100'],
                'name_ar' => ['required', 'string', 'max:100'],
                'name_ku' => ['required', 'string', 'max:100'],
                'description_en' => ['required', 'string', 'max:500'],
                'description_ar' => ['required', 'string', 'max:500'],
                'description_ku' => ['required', 'string', 'max:500'],
                'cover_image' => ['required', 'image'],
                'coach_id' => ['required', Rule::exists('users', 'id')],
                'price' => ['required', 'integer'],
                'phone_number' => ['required','numeric','starts_with:01'],
                'address' => ['required', 'string'],
                'open_at' => ['required'],
                'close_at' => ['required']
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }
            $path = $this->storeFile($request->cover_image, 'images/gyms/coverImages');
            if ($path) {
                $gym = gym::create([
                    'name_en' => $request->name_en,
                    'name_ar' => $request->name_ar,
                    'name_ku' => $request->name_ku,
                    'description_en' => $request->description_en,
                    'description_ar' => $request->description_ar,
                    'description_ku' => $request->description_ku,
                    'cover_image' => $path,
                    'phone_number' => $request->phone_number,
                    'price' => $request->price,
                    'address' => $request->address,
                    'open_at' => $request->open_at,
                    'close_at' => $request->close_at,
                ]);
                \App\Models\log::create([
                    'table_name' => 'gyms',
                    'item_id' => $gym->id,
                    'action' => 'store',
                    'user_id' => $request->coach_id,
                ]);
                return $this->apiResponse($gym, 'success', 200);
            }

            return $this->apiResponse('', 'error while store cover image', 400);
        } catch (\Exception $e) {
            \Log::error($e->getTraceAsString());
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }

    function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name_en' => [ 'string', 'max:100'],
                'name_ar' => [ 'string', 'max:100'],
                'name_ku' => [ 'string', 'max:100'],
                'description_en' => [ 'string', 'max:500'],
                'description_ar' => [ 'string', 'max:500'],
                'description_ku' => [ 'string', 'max:500'],
                'cover_image' => ['image'],
                'coach_id' => ['required', Rule::exists('users', 'id')],
                'price' => [ 'integer'],
                'address' => [ 'string'],
            ]);
            if ($validator->fails()) {
                return $this->apiResponse(null, $validator->errors(), 400);
            }
            $gym = gym::find($id);
            if ($gym) {

                if ($request->cover_image) {
                    $path = $this->replaceFile($gym->cover_image, $request->cover_image, 'images/gyms/coverImages');
                    $gym->cover_image = $path;
                }
                $gym->name_en = $request->name_en;
                $gym->name_ar = $request->name_ar;
                $gym->name_ku = $request->name_ku;
                $gym->description_en = $request->description_en;
                $gym->description_ar = $request->description_ar;
                $gym->description_ku = $request->description_ku;
                $gym->price = $request->price;
                $gym->address = $request->address;
                $gym->open_at = $request->open_at;
                $gym->close_at = $request->close_at;
                $gym->save();
                \App\Models\log::create([
                    'table_name' => 'gyms',
                    'item_id' => $gym->id,
                    'action' => 'update',
                    'user_id' => $request->coach_id,
                ]);
                return $this->apiResponse($gym, 'success', 200);
            }

            return $this->apiResponse('', 'No gym with this id', 200);


        } catch (\Exception $e) {
            \Log::error($e->getTraceAsString());
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }


    public function show(string $id)
    {
        try {
            $gym = gym::find($id);
            if ($gym) {
                return $this->apiResponse($gym, 'success', 200);
            }
            return $this->apiResponse('', 'No gym with this id', 200);

        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function destroy(Request $request,string $id)
    {
        try {

            $gym = gym::find($id);
            if ($gym) {
                $gym->delete();

                \App\Models\log::create([
                    'table_name' => 'gyms',
                    'item_id' => $gym->id,
                    'action' => 'update',
                    'user_id' => $request->coach_id,
                ]);

                return $this->apiResponse('', 'success', 200);
            }
            return $this->apiResponse('', 'No gym with this id', 200);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return $this->apiResponse($e->getMessage(), 'error', 400);
        }
    }

    public function deleteCollection(Request $request)
    {
        try {
            $validator = validator::make($request->all(), [
                'gyms' => ['required', 'array'],
            ]);

            if ($validator->fails()) {
                return $this->apiResponse('',$validator->errors(),400);
            }
            if (!is_array($request->gyms)) {
                return response()->json(['data' => null, 'message' => 'gyms must be in array'], 200);
            }
            $cover_images_pathes = gym::query()->whereIn('id', $request->gyms)->pluck('cover_image');

            if (!$this->deleteCollectionOfFiles($cover_images_pathes)) {
                return $this->apiResponse('', 'something went wrong whiled deleting images ', 400);
            }
            gym::whereIn('id', $request->gyms)->delete();
            foreach ($request->gyms as $gym){
                \App\Models\log::create([
                    'table_name' => 'gyms',
                    'item_id' => $gym,
                    'action' => 'destroy collection',
                    'user_id' => $request->coach_id,
                ]);
            }

            return $this->apiResponse('', 'success', 200);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
