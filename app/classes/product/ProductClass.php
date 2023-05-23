<?php

namespace App\classes\product;

use App\classes\general\GeneralFunctionsClass;
use App\Models\product;
use App\Models\product_color;
use App\Models\product_image;
use App\Models\product_size;
use App\Models\TemporatyFile;
use App\traits\ImagesOperations;
use Illuminate\Support\Facades\DB;

class ProductClass
{

    use ImagesOperations;

    private $coverImagepath;
    private $imagespath;

    function __construct()
    {
        $this->coverImagepath = 'images/products/coverImages';
        $this->imagespath = 'images/products/images';
    }


    public static function store(string $coverImage, $name_en, $name_ar, $name_ku, $description_en, $description_ar, $description_ku,
                                 $quantity, $price, $discount, $category_id,$images, $brand_id = null, $subcategory_id = null, $colors = null, $sizes = null)
    {
        try {
            return DB::transaction(function () use (
                $coverImage, $name_en, $name_ar, $name_ku, $description_en, $description_ar, $description_ku,
                $quantity, $price, $discount, $category_id, $brand_id, $subcategory_id, $images, $colors, $sizes
            ) {

                if ($coverImage) {
                    if (is_string($coverImage)){
                        $cover_image_path = $coverImage;
                    }elseif (is_array($coverImage)){
                        $cover_image_path=  $this->storeFile($coverImage,$this->coverImagepath);
                    }

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
                    $product->brand_id = $brand_id;
                } else {
                    $product->subcategory_id = $subcategory_id;
                }
                $product->save();

                if ($images) {
                    foreach ($images as $index => $image) {
                        if ($index != 0) {
                            if ($image) {

                                ProductImages::store($image,$product->id);
                                TemporatyFile::query()->where('file_path', $image)->delete();
                            }
                        }
                    }
                }

                if ($colors) {
                    foreach ($colors as $color) {

                        ProductColors::store($color,$product->id);
                    }
                }
                if ($sizes) {
                    foreach ($sizes as $size) {
                       ProductSizes::store($size,$product->id);
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

    public static function update(array $params)
    {
        // TODO: Implement update() method.
    }

    public static function destroy(int $id)
    {
        // TODO: Implement destroy() method.
    }

    public static function destroyAll()
    {
        // TODO: Implement destroyAll() method.
    }

    public static function get(int $id)
    {
        // TODO: Implement get() method.
    }

    public static function getAll(int $pagination = 15)
    {
        // TODO: Implement getAll() method.
    }
}
