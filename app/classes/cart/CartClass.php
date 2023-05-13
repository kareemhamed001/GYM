<?php

namespace App\classes\cart;

use App\classes\general\GeneralFunctionsClass;
use App\Models\cart;
use Illuminate\Support\Facades\Log;

class CartClass extends GeneralFunctionsClass
{

    /**
     * @throws \Exception
     */
    public static function store(array $params)
    {
        try {
            return cart::create($params);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    public static function update(array $params)
    {
        try {
            return cart::update($params);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    public static function destroy(int $id)
    {
        try {
            $cart=cart::find($id);
            $cart->delete();
            return true;
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    public static function destroyAll()
    {
        try {
            $cart=cart::all()->delete();
            return true;
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    public static function get(int $id)
    {
        try {
            return cart::find($id);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
    public static function getAll(int $pagination = 15)
    {
        try {
            return cart::with(['user', 'supplement'])->paginate($pagination);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }
}
