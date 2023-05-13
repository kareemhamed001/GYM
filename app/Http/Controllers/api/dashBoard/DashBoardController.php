<?php

namespace App\Http\Controllers\api\dashBoard;

use App\Models\brand;
use App\Models\category;
use App\Models\coach;
use App\Models\muscle;
use App\Models\purchase;
use App\Models\subscription;
use App\Models\product;
use App\Models\User;
use App\Models\video;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashBoardController
{
    use ImagesOperations;
    use ApiResponse;

    //users
    //coaches
    //products
    //brands
    //categories
    //muscles

    function overAllStatistics(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
    {

        try {
            $users = User::count();
            $coaches = coach::count();
            $products = product::count();
            $brands = brand::count();
            $categories = category::count();
            $muscles = muscle::count();
            $sales = subscription::select(DB::raw('count(*) as count,sum(price) as sales'))->first();
            $purchases=purchase::select(DB::raw('count(*) as count,sum(price) as sales'))->first();

            return $this->apiResponse([
                'users' => $users,
                'coaches' => $coaches,
                'products' => $products,
                'brands' => $brands,
                'categories' => $categories,
                'muscles' => $muscles,
                'subscriptions' => $sales->count,
                'purchases' => $purchases->count,
                'muscles_sales'=>$sales->sales,
                'products_sales'=>$purchases->sales,
                'sales' => $sales->sales + $purchases->sales?? 0,
                'time' => now()
            ], 'success', 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
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


            $products = product::select(DB::raw('count(*) as count,month(created_at) as month'))->whereYear('created_at', '=', Carbon::now())->groupBy('month')->orderBy('month', 'asc')->get();
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

            $muscles = muscle::select(DB::raw('count(*) as count,month(created_at) as month'))->whereYear('created_at', '=', Carbon::now())->groupBy('month')->orderBy('month', 'asc')->get();
            $musclesResult = $muscles->map(function ($item)use($months,$counts) {
                $counts[$item->month-1] = $item->count;
                return ['counts' => $counts, 'months' => $months];
            });
            if ($muscles->count()==0){
                $musclesResult=[['counts'=>$counts,'months'=>$months]];
            }

            return $this->apiResponse([
                'users' => $usersResult,
                'coaches' => $coachesResult,
                'products' => $productsResult,
                'brands' => $brandsResult,
                'categories' => $categoriesResult,
                'muscles' => $musclesResult,

                'time' => now()
            ], 'success', 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }

    function topProducts(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
    {

        try {

            $topProducts=purchase::select(DB::raw('count(*) as count,sum(price) as sales,supplement_id'))->groupBy('supplement_id')->get();


            return $this->apiResponse([
                'topProducts' => $topProducts,
                'time' => now()
            ], 'success', 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }

    function recentmusclesClients(int $limit=10){
        try {
            $recent=subscription::select('user_id','muscle_id')->orderBy('created_at', 'desc')
                ->take($limit)
                ->get()->map(function($subscription){
                    return ['user'=>User::find($subscription->user_id),'muscle'=>muscle::find($subscription->muscle_id)];
                });
            return $this->apiResponse([
                'recentClients' => $recent,
                'time' => now()
            ], 'success', 200);
        }catch (\Exception $e){
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }

    function recentProductsClients(int $limit=10){
        try {
            $recent=purchase::select('user_id','supplement_id','number','price','discount')->orderBy('created_at', 'desc')
                ->take($limit)
                ->get()->map(function($subscription){
                    return ['quantity'=>$subscription->number,'price'=>$subscription->price,'discount'=>$subscription->discount,'user'=>User::find($subscription->user_id),'product'=>product::find($subscription->supplement_id)];
                });
            return $this->apiResponse([
                'recentClients' => $recent,
                'time' => now()
            ], 'success', 200);
        }catch (\Exception $e){
            return $this->apiResponse('', $e->getMessage(), 400);
        }
    }
}
