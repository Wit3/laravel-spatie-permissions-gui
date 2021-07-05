<?php

use Illuminate\Support\Facades\Route;
use Wit3\LaravelSpatiePermissionsGui\Components\Permission\Permissions;

/**
 * Routes for the package would go here
 */

// Route::group([
//     'prefix' => config("permission-ui.admin_route_prefix", ""),
//     'as' => 'paksuco.',
// ], function () {
//     Route::get('/permissions', \Paksuco\Permission\Components\Permissions::class)
//         ->name("permissions")
//         ->middleware(config("permission-ui.middleware", []));
// });
Route::get('prova', fn () =>  dd("yes"));
Route::get('permissions', Permissions::class)
    ->name("permissions");
