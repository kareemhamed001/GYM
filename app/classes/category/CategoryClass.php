<?php

namespace App\classes\category;

use App\classes\general\GeneralFunctionsClass;
use App\Models\category;
use App\Models\coach;

class CategoryClass extends GeneralFunctionsClass
{

    /**
     * @throws \Exception
     */
    public static function store(array $params)
    {
        try {
            return category::create($params);
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
            return category::update($params);
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
            $category=category::find($id);
            $category->delete();
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
            $category=category::all()->delete();
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
            return category::with(['brands'])->find($id);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
    public static function getAll(int $pagination = 15)
    {
        try {
            return category::paginate($pagination);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}
