<?php

namespace App\classes\general;

abstract class GeneralFunctionsClass
{

    public abstract static function store(array $params);
    public abstract static function update(array $params);
    public abstract static function destroy(int $id);
    public abstract static function destroyAll();
    public abstract static function get(int $id);
}
