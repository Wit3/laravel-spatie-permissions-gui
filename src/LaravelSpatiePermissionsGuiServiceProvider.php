<?php

namespace Wit3\LaravelSpatiePermissionsGui;

use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Wit3\LaravelSpatiePermissionsGui\Commands\LaravelSpatiePermissionsGuiCommand;
use Wit3\LaravelSpatiePermissionsGui\Http\Livewire\Button;
use Wit3\LaravelSpatiePermissionsGui\Http\Livewire\PermissionActions;
use Wit3\LaravelSpatiePermissionsGui\Http\Livewire\Permissions;
use Wit3\LaravelSpatiePermissionsGui\Http\Livewire\RoleActions;

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
            ->hasCommand(LaravelSpatiePermissionsGuiCommand::class);
    }

    public function packageBooted()
    {
        Livewire::component('spatie-permissions-gui::button', Button::class);
        Livewire::component('spatie-permissions-gui::permissions', Permissions::class);
        Livewire::component('spatie-permissions-gui::permission-actions', PermissionActions::class);
        Livewire::component('spatie-permissions-gui::role-actions', RoleActions::class);
    }
}
