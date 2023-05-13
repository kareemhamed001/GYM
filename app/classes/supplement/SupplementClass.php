<?php

namespace App\classes\supplement;

use App\classes\general\GeneralFunctionsClass;
use App\Models\subscription;
use App\Models\product;
use App\traits\ImagesOperations;
use Illuminate\Support\Facades\DB;
use function PHPUnit\TestFixture\func;

class SupplementClass extends GeneralFunctionsClass
{
    use ImagesOperations;
    /**
     * @throws \Exception
     */
    public static function store(array $params)
    {
        try {
            return product::create($params);
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
            return product::update($params);
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
            $supplement=product::find($id);

            \DB::transaction(function()use($supplement){
                $this->deleteFile($supplement->cover_image);
                $images=$supplement->images;
                foreach ($images as $image){
                    $this->deleteFile($images->image);
                    $$image->delete();
                }

            });
            $supplement->delete();
            return true;
        }catch (\Exception $e){
            DB::rollback();
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    public static function destroyAll()
    {
        try {
            $supplement=product::all()->delete();
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
            return product::with(['brand','coach','purchases'])->find($id);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public static function getAll(int $pagination = 15,$with=['brand','coach'])
    {
        try {
            return product::with($with)->paginate($pagination);
        }catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}
