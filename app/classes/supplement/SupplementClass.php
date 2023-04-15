<?php

namespace App\classes\supplement;

use App\classes\general\GeneralFunctionsClass;
use App\Models\supplement;

class SupplementClass extends GeneralFunctionsClass
{
    /**
     * @throws \Exception
     */
    public static function store(array $params)
    {
        try {
            return supplement::create($params);
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
            return supplement::update($params);
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
            $supplement=supplement::find($id);
            $supplement->delete();
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
            $supplement=supplement::all()->delete();
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
            return supplement::find($id);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}
