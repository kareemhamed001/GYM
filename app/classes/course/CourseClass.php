<?php

namespace App\classes\course;

use App\classes\general\GeneralFunctionsClass;
use App\Models\coach;
use App\Models\course;

class CourseClass extends GeneralFunctionsClass
{

    /**
     * @throws \Exception
     */
    public static function store(array $params)
    {
        try {
            return course::create($params);
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
            return course::update($params);
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
            $course=course::find($id);
            $course->delete();
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
            $course=course::all()->delete();
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
            return course::find($id);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public static function getAll(int $pagination = 15)
    {
        try {
            return course::paginate($pagination);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}
