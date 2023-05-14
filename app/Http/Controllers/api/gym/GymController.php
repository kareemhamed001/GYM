<?php

namespace App\Http\Controllers\api\gym;

use App\Http\Controllers\Controller;
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
                    'price' => $request->price,
                    'address' => $request->address,
                    'open_at' => $request->open_at,
                    'close_at' => $request->close_at,
                ]);
                \App\Models\log::create([
                    'table_name'=>'gyms',
                    'item_id'=>$gym->id,
                    'action'=>'store',
                    'user_id'=>$request->coach_id,
                ]);
                return $this->apiResponse($gym,'success',200);
            }

            return $this->apiResponse('','error while store cover image',400);
        } catch (\Exception $e) {
            \Log::error($e->getTraceAsString());
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }
}
