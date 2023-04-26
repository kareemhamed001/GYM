<?php

namespace App\Http\Controllers\api\dashBoard;

use App\Models\brand;
use App\Models\category;
use App\Models\coach;
use App\Models\course;
use App\Models\purchase;
use App\Models\subscription;
use App\Models\supplement;
use App\Models\User;
use App\Models\video;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
            $users = User::count();
            $coaches = coach::count();
            $products = supplement::count();
            $brands = brand::count();
            $categories = category::count();
            $courses = course::count();
            $videos = video::count();
            $sales = subscription::select(DB::raw('count(*) as count,sum(price) as sales'))->first();;

            return $this->apiResponse([
                'users' => $users,
                'coaches' => $coaches,
                'products' => $products,
                'brands' => $brands,
                'categories' => $categories,
                'courses' => $courses,
                'videos' => $videos,
                'subscriptions' => $sales->count,
                'sales' => $sales->sales ?? 0,
                'time' => now()
            ], 'success', 200);
        } catch (\Exception $e) {
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }

    function yearStatistics(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
    {

        try {
            $months=[1,2,3,4,5,6,7,8,9,10,11,12];
            $counts = array_fill(0, 12, 0);
            $users = User::select(DB::raw('count(*) as count,month(created_at) as month'))->whereYear('created_at', '=', Carbon::now())->groupBy('month')->orderBy('month', 'asc')->get();
            $usersResult = $users->map(function ($item)use($months,$counts) {
                $counts[$item->month-1] = $item->count;
                return ['counts' => $counts, 'months' => $months];
            });
            if ($users->count()==0){
                $usersResult=[['counts'=>$counts,'months'=>$months]];
            }

            $coaches = coach::select(DB::raw('count(*) as count,month(created_at) as month'))->whereYear('created_at', '=', Carbon::now())->groupBy('month')->orderBy('month', 'asc')->get();
            $coachesResult = $coaches->map(function ($item)use($months,$counts) {
                $counts[$item->month-1] = $item->count;
                return ['counts' => $counts, 'months' => $months];
            });
            if ($coaches->count()==0){
                $coachesResult=[['counts'=>$counts,'months'=>$months]];
            }


            $products = supplement::select(DB::raw('count(*) as count,month(created_at) as month'))->whereYear('created_at', '=', Carbon::now())->groupBy('month')->orderBy('month', 'asc')->get();
            $productsResult = $products->map(function ($item)use($months,$counts) {
                $counts[$item->month-1] = $item->count;
                return ['counts' => $counts, 'months' => $months];
            });
            if ($products->count()==0){
                $productsResult=[['counts'=>$counts,'months'=>$months]];
            }

            $brands = brand::select(DB::raw('count(*) as count,month(created_at) as month'))->whereYear('created_at', '=', Carbon::now())->groupBy('month')->orderBy('month', 'asc')->get();
            $brandsResult = $brands->map(function ($item)use($months,$counts) {
                $counts[$item->month-1] = $item->count;
                return ['counts' => $counts, 'months' => $months];
            });
            if ($brands->count()==0){
                $brandsResult=[['counts'=>$counts,'months'=>$months]];
            }

            $categories = category::select(DB::raw('count(*) as count,month(created_at) as month'))->whereYear('created_at', '=', Carbon::now())->groupBy('month')->orderBy('month', 'asc')->get();
            $categoriesResult = $categories->map(function ($item)use($months,$counts) {
                $counts[$item->month-1] = $item->count;
                return ['counts' => $counts, 'months' => $months];
            });
            if ($categories->count()==0){
                $categoriesResult=[['counts'=>$counts,'months'=>$months]];
            }

            $courses = course::select(DB::raw('count(*) as count,month(created_at) as month'))->whereYear('created_at', '=', Carbon::now())->groupBy('month')->orderBy('month', 'asc')->get();
            $coursesResult = $courses->map(function ($item)use($months,$counts) {
                $counts[$item->month-1] = $item->count;
                return ['counts' => $counts, 'months' => $months];
            });
            if ($courses->count()==0){
                $coursesResult=[['counts'=>$counts,'months'=>$months]];
            }

            $videos = video::select(DB::raw('count(*) as count,month(created_at) as month'))->whereYear('created_at', '=', Carbon::now())->groupBy('month')->orderBy('month', 'asc')->get();
            $videosResult = $videos->map(function ($item)use($months,$counts) {
                $counts[$item->month-1] = $item->count;
                return ['counts' => $counts, 'months' => $months];
            });
            if ($videos->count()==0){
                $videosResult=[['counts'=>$counts,'months'=>$months]];
            }

            return $this->apiResponse([
                'users' => $usersResult,
                'coaches' => $coachesResult,
                'products' => $productsResult,
                'brands' => $brandsResult,
                'categories' => $categoriesResult,
                'courses' => $coursesResult,
                'videos' => $videosResult,
                'time' => now()
            ], 'success', 200);
        } catch (\Exception $e) {
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }

    function topProducts(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
    {

        try {

            $topProducts=purchase::select(DB::raw('count(*) as count,sum(price) as sales,supplement_id'))->groupBy('')->get();


            return $this->apiResponse([
                'topProducts' => $topProducts,
                'time' => now()
            ], 'success', 200);
        } catch (\Exception $e) {
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }

}
