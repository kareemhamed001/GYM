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
    public static function store($size, $productId):product_size
    {
        try {
            $oldSize=product_size::where('product_id',$productId)->where('value',$size)->first();
            if ($oldSize){
                return $oldSize;
            }
            return product_size::create([
                'product_id' => $productId,
                'value' => $size
            ]);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

}
