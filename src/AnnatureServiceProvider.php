<?php

declare(strict_types=1);

namespace Dyrynda\Annature\Laravel;

use Dyrynda\Annature\Annature;
use Dyrynda\Annature\Contracts\AnnatureClient;
use Illuminate\Contracts\Foundation\Application;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AnnatureServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-annature')
            ->hasConfigFile();
    }

    public function packageRegistered()
    {
        $this->app->singleton(AnnatureClient::class, function (Application $app) {
            $config = $app['config']->get('annature');

            return new Annature(
                id: $config['id'],
                key: $config['key'],
            );
        });
    }
}
