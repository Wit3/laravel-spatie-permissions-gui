<?php

namespace Wit3\LaravelSpatiePermissionsGui;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Wit3\LaravelSpatiePermissionsGui\Commands\LaravelSpatiePermissionsGuiCommand;

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
            // ->hasViewComponent('permission',[Permission::class])
            ->hasViewComponents('spatie', [Permission::class])
            ->hasMigration('create_laravel-spatie-permissions-gui_table')
            ->hasRoute('web')
            ->hasCommand(LaravelSpatiePermissionsGuiCommand::class);
    }
}
