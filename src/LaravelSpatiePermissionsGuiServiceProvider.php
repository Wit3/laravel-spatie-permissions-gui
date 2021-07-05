<?php

namespace Wit3\LaravelSpatiePermissionsGui;

use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Wit3\LaravelSpatiePermissionsGui\Commands\LaravelSpatiePermissionsGuiCommand;
use Wit3\LaravelSpatiePermissionsGui\Http\Livewire\Permission\Permissions;

class LaravelSpatiePermissionsGuiServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-spatie-permissions-gui')
            ->hasConfigFile()
            ->hasViews()
            // ->hasViewComponents('permissions', [Permissions::class])
            // ->hasMigration('create_laravel-spatie-permissions-gui_table')
            ->hasRoute('web')
            ->hasCommand(LaravelSpatiePermissionsGuiCommand::class);
    }

    public function packageBooted()
    {
        Livewire::component('permissions', Permissions::class);
    }
}
