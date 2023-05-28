<?php

namespace App\Http\Controllers\user\store;

use App\classes\brand\BrandClass;
use App\classes\supplement\SupplementClass;
use App\Models\brand;
use App\Models\category;
use App\Models\gym;
use App\Models\muscle;
use App\Models\product;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class StoreController
{

    function index(Request $request, $categoryName)
    {

        $lang = LaravelLocalization::setLocale();
        $categoryId = config('mainCategories.' . $categoryName) ? config('mainCategories.' . $categoryName . '.id') : 0;
        $category = category::find($categoryId);

        if ($category) {

            if ($category->id == config('mainCategories.MusclesVideos.id')) {
                $muscles = muscle::paginate();
                return view('user.trainigVideos.index', compact('category','lang','muscles'));
            }

            if ($category->id == config('mainCategories.GymDiscount.id')) {
                $gyms=gym::paginate();

                return view('user.gymDiscount.index', compact('category','lang','gyms'));
            }

            $products = product::where('category_id', $category->id)->paginate(42);
            if ($category->id == config('mainCategories.Supplements.id')) {
                if ($request->brand) {
                    $brand = brand::find($request->brand);
                    if (!$brand) {
                        return redirect()->back()->with('error', 'No brand with this id');
                    }
                    $products = product::where('brand_id', $brand->id)->paginate(42);
                    $brands = brand::limit(20)->get();
                    return view('user.store.index', compact('products', 'category', 'brands', 'lang'));
                }
                $brands = brand::all();
                return view('user.store.index', compact('products', 'brands', 'lang', 'category'));
            }


            if ($request->subcategory) {
                $subCategory = subCategory::where('id', $request->subcategory)->first();
                if ($subCategory->count() == 0) {
                    return redirect()->back()->with('error', 'No category with this id');
                }
                $products = product::where('subcategory_id', $subCategory->id)->paginate(42);
                $subCategories = subCategory::where('category_id', $category->id)->get();
                return view('user.store.index', compact('products', 'category', 'subCategories', 'lang'));
            }

            $subCategories = subCategory::where('category_id', $category->id)->get();

            return view('user.store.index', compact('products', 'lang', 'category', 'subCategories'));

        } else {
            return redirect()->back()->with('error', 'No category with this name');
        }

    }
}
