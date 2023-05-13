<?php

namespace App\classes\coach;

use App\classes\general\GeneralFunctionsClass;
use App\Models\brand;
use App\Models\coach;
use Illuminate\Support\Facades\Log;

class CoachClass extends GeneralFunctionsClass
{

    /**
     * @throws \Exception
     */
    public static function store(array $params)
    {
        try {
            return coach::create($params);
        }catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    public static function update(array $params)
    {
        try {
            return coach::update($params);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    public static function destroy(int $id)
    {
        try {
            $coach = coach::find($id);
            $coach->delete();
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    public static function destroyAll()
    {
        try {
            $coach = coach::all()->delete();
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    public static function get(int $id)
    {
        try {
            return coach::with(['supplements','brands','videos','courses'])->find($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    public static function getAll(int $pagination = 15)
    {
        try {
            return coach::with(['supplements', 'brands', 'videos', 'courses','user'])->paginate($pagination);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }
}
