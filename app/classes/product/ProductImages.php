<?php

namespace App\classes\product;

use App\Models\product_image;
use App\traits\ImagesOperations;

class ProductImages
{
    use ImagesOperations;

    /**
     * @throws \Exception
     */
    public static function store($image, $productId){
        try {
            $image_path='';
            if ($image) {
                if (is_string($image)){
                    $image_path = $image;
                }

            }
            return product_image::create([
                'product_id' => $productId,
                'image' => $image_path
            ]);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

}
