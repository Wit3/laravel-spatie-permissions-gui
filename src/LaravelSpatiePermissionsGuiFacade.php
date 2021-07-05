<?php

namespace Wit3\LaravelSpatiePermissionsGui;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Wit3\LaravelSpatiePermissionsGui\LaravelSpatiePermissionsGui
 */
class LaravelSpatiePermissionsGuiFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-spatie-permissions-gui';
    }
}
