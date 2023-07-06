<?php

namespace App\classes\product;

use App\classes\general\GeneralFunctionsClass;
use App\Models\muscle;
use App\Models\product;
use App\Models\product_color;
use App\Models\product_image;
use App\Models\product_size;
use App\Models\subCategory;
use App\Models\TemporatyFile;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductClass
{

    use ImagesOperations;

    private $coverImagepath;
    private $imagespath;
    private $productImagesService;

    function __construct(ProductImages $productImagesService)
    {
        $this->productImagesService = $productImagesService;
    }


    public function store($coverImage, $name_en, $name_ar, $name_ku, $description_en, $description_ar, $description_ku,
                          $quantity, $price, $discount, $category_id, $images, $brand_id = null, $subcategory_id = null, $colors = null, $sizes = null)
    {

        try {
            return DB::transaction(function () use (
                $coverImage, $name_en, $name_ar, $name_ku, $description_en, $description_ar, $description_ku,
                $quantity, $price, $discount, $category_id, $brand_id, $subcategory_id, $images, $colors, $sizes
            ) {

                if ($coverImage) {
                    $cover_image_path = $this->storeFile($coverImage, $this->PRODUCTS_COVERIMAGES_PATH);
                }

                $product = new product();
                $product->name_en = $name_en;
                $product->name_ar = $name_ar;
                $product->name_ku = $name_ku;
                $product->description_en = $description_en;
                $product->description_ar = $description_ar;
                $product->description_ku = $description_ku;
                $product->quantity = $quantity;
                $product->price = $price;
                $product->discount = $discount;
                $product->category_id = $category_id;
                $product->cover_image = $cover_image_path;

                if (intval($category_id) == config('mainCategories.Supplements.id')) {
                    if ($brand_id){
                        $product->brand_id = $brand_id;
                    }else{
                        throw new \Exception('You should enter brand id to insert new supplement');
                    }

                } else {
                    $subcategory=subCategory::find($subcategory_id);
                    if ($subcategory->count()>0){
                        if ($subcategory->category_id==$category_id){
                            $product->subcategory_id = $subcategory_id;
                        }else{
                            throw new \Exception('You entered subcategory not belongs to this category');
                        }

                    }else{
                        throw new \Exception('No subcategory with this id');
                    }


                }
                $product->save();

                if ($images) {
                    foreach ($images as $index => $image) {
                        if ($index != 0) {
                            if ($image) {

                                $this->productImagesService->store($image, $product->id);
                                TemporatyFile::query()->where('file_path', $image)->delete();
                            }
                        }
                    }
                }

                if ($colors) {
                    foreach ($colors as $color) {

                        ProductColors::store($color, $product->id);
                    }
                }
                if ($sizes) {
                    foreach ($sizes as $size) {
                        ProductSizes::store($size, $product->id);
                    }
                }
                return $product;
            });

        } catch (\Exception $e) {
            \Log::error($e->getTraceAsString());
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }

    }

    public function update($product_id, $coach_id, $name_en, $name_ar, $name_ku, $description_en, $description_ar, $description_ku,
                           $quantity, $price, $discount, $category_id,$oldImages, $coverImage=null, $images = null, $brand_id = null, $subcategory_id = null, $colors = null, $sizes = null)
    {
        try {
            $product = product::find($product_id);

            if ($product) {
                if ($coverImage) {
                    $path = $this->replaceFile($product->cover_image, $coverImage, $this->PRODUCTS_COVERIMAGES_PATH);
                    $product->cover_image = $path;
                }

                if ($name_en) {
                    $product->name_en = $name_en;
                }
                if ($name_ar) {
                    $product->name_ar = $name_ar;
                }
                if ($name_ku) {
                    $product->name_ku = $name_ku;
                }
                if ($description_en) {
                    $product->description_en = $description_en;
                }
                if ($description_ar) {
                    $product->description_ar = $description_ar;
                }
                if ($description_ku) {
                    $product->description_ku = $description_ku;
                }
                if ($quantity) {
                    $product->quantity = $quantity;
                }
                if ($price) {
                    $product->price = $price;
                }
                if ($discount) {
                    $product->discount = $discount;
                } else {
                    $product->discount = 0;
                }

                if ($category_id) {
                    if ($category_id == config('mainCategories.Supplements.id')) {
                        if ($brand_id) {
                            $product->category_id = $category_id;
                            $product->brand_id = $brand_id;
                        } else {
                            throw new \Exception('to add this product to supplement category you needs brand id');
                        }
                    } else {
                        if ($subcategory_id) {
                            $product->category_id = $category_id;
                            $product->subcategory_id = $subcategory_id;
                        }
                    }
                } else {
                    if ($brand_id) {

                        if ($product->category_id == config('mainCategories.Supplements.id')) {

                            $product->brand_id = $brand_id;
                        } else {
                            throw new \Exception('you try to add brand to category that doesn\'t contains brands or add subcategory to category doesn\'t contains subcategories ');
                        }
                    } elseif ($subcategory_id) {

                        if ($product->category_id != config('mainCategories.Supplements.id')) {

                            $product->subcategory_id = $subcategory_id;
                        } else {
                            throw new \Exception('you try to add brand to category that doesn\'t contains brands or add subcategory to category doesn\'t contains subcategories ');
                        }
                    }
                }

                if ($oldImages){
                    if (is_array($oldImages)){
                        $oldImages=array_map('intval',$oldImages);
                        $old_images_pathes = product_image::query()->whereNotIn('id', $oldImages)->pluck('image');
                        $this->deleteCollectionOfFiles($old_images_pathes);
                        Log::info($oldImages);
                        product_image::query()->whereNotIn('id',$oldImages)->delete();
                    }
                }else{

                    $old_images_pathes = product_image::query()->where('product_id', $product->id)->pluck('image');
                    $this->deleteCollectionOfFiles($old_images_pathes);
                    Log::info($old_images_pathes);
                    product_image::query()->where('product_id', $product->id)->delete();
                }

                if ($images) {
                    foreach ($images as $image) {
                        if ($image) {
                            $this->productImagesService->store($image, $product->id);
                            TemporatyFile::query()->where('file_path', $image)->delete();
                        }
                    }
                }

                if ($colors) {
                    foreach ($colors as $color) {
                        ProductColors::store($color, $product->id);
                    }
                }

                if ($sizes) {
                    foreach ($sizes as $size) {
                        ProductSizes::store($size, $product->id);
                    }
                }

                $product->save();

                \App\Models\log::create([
                    'table_name' => 'products',
                    'item_id' => $product->id,
                    'action' => 'update',
                    'user_id' => $coach_id,
                ]);

                return $product;
            }
            throw new \Exception('No product with this id');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }


    public static function destroy(int $id)
    {
        // TODO: Implement destroy() method.
    }

    public
    static function destroyAll()
    {
        // TODO: Implement destroyAll() method.
    }

    public
    static function get(int $id)
    {
        try {
            $product = product::with(['brand', 'subcategory', 'category', 'colors', 'sizes', 'images'])->find($id);
            if ($product) {
                return $product;
            }
            throw new \Exception('No product with this id');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    public
    static function getAll(int $pagination = 15)
    {
        // TODO: Implement getAll() method.
    }


    public function deleteCollection(array $products)
    {
        try {

            if (!is_array($products)) {
                throw new \Exception('products should be array');
            }

            $cover_images_pathes = product::query()->whereIn('id', $products)->pluck('cover_image');

            if (!$this->deleteCollectionOfFiles($cover_images_pathes)) {
                throw new \Exception( 'something went wrong whiled deleting images');
            }
            product::whereIn('id', $products)->delete();
            return true;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage);
            return false;
        }
    }
}
