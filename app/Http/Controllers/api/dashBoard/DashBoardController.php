<?php

namespace App\Http\Controllers\api\dashBoard;

use App\Models\brand;
use App\Models\category;
use App\Models\coach;
use App\Models\course;
use App\Models\supplement;
use App\Models\User;
use App\Models\video;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;

class DashBoardController
{
    use ImagesOperations;
    use ApiResponse;
    //users
    //coaches
    //products
    //brands
    //categories
    //courses
    //videos
    function overAllStatistics(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
    {

        try {
            $users=User::count();
            $coaches=coach::count();
            $products=supplement::count();
            $brands=brand::count();
            $categories=category::count();
            $courses=course::count();
            $videos=video::count();

            return $this->apiResponse([
                'users'=>$users,
                'coaches'=>$coaches,
                'products'=>$products,
                'brands'=>$brands,
                'categories'=>$categories,
                'courses'=>$courses,
                'videos'=>$videos,
                'time'=>now()
            ],'success',200);
        }catch (\Exception $e){
            return $this->apiResponse('',$e->getMessage(),400);
        }
    }
}
