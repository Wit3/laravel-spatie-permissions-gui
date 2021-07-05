<?php

use Illuminate\Support\Facades\Route;
use Wit3\LaravelSpatiePermissionsGui\Http\Controllers\PermissionController;

/**
 * Routes for the package would go here
 */


Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
