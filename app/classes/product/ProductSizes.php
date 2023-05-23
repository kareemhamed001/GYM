<?php

namespace App\classes\product;

use App\Models\product_color;
use App\Models\product_image;
use App\Models\product_size;
use App\traits\ImagesOperations;

class ProductSizes
{
    use ImagesOperations;

    /**
     * @throws \Exception
     */
    public static function store($size, $productId){
        try {
            return product_size::create([
                'product_id' => $productId,
                'value' => $size
            ]);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

}
