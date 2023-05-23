<?php

namespace App\classes\product;

use App\Models\product_color;
use App\Models\product_image;
use App\traits\ImagesOperations;

class ProductColors
{
    use ImagesOperations;

    /**
     * @throws \Exception
     */
    public static function store($color, $productId){
        try {
            return product_color::create([
                'product_id' =>$productId,
                'value' => $color
            ]);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

}
