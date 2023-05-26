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
    public static function store($color, $productId):product_color
    {
        try {
            $oldColor=product_color::where('product_id',$productId)->where('value',$color)->first();
            if ($oldColor){
                return $oldColor;
            }
            return product_color::create([
                'product_id' =>$productId,
                'value' => $color
            ]);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

}
