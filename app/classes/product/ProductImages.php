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
    public  function store($image, $productId){
        try {
            $image_path=$this->storeFile($image,'images/products/images');

            return product_image::create([
                'product_id' => $productId,
                'image' => $image_path
            ]);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }

    }

}
