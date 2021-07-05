<?php

namespace Wit3\LaravelSpatiePermissionsGui\Commands;

use Illuminate\Console\Command;

class LaravelSpatiePermissionsGuiCommand extends Command
{
    public $signature = 'laravel-spatie-permissions-gui';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
