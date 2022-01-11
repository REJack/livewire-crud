<?php

namespace REJack\LivewireCrud;

use REJack\LivewireCrud\Commands\LivewireCrudCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LivewireCrudServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('livewire-crud')
            ->hasConfigFile()
            ->hasViews()
            ->hasCommand(LivewireCrudCommand::class);
    }
}
