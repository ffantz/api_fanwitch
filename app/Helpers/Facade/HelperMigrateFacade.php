<?php

namespace App\Helpers\Facade;

use Illuminate\Support\Facades\Facade;
use App\Helpers\HelperMigrate;

class HelperMigrateFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return HelperMigrate::class;
    }
}
