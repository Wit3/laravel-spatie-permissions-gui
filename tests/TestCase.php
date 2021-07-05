<?php

namespace Wit3\LaravelSpatiePermissionsGui\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Wit3\LaravelSpatiePermissionsGui\LaravelSpatiePermissionsGuiServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Wit3\\LaravelSpatiePermissionsGui\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelSpatiePermissionsGuiServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        include_once __DIR__.'/../database/migrations/create_laravel-spatie-permissions-gui_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }
}
