<?php

namespace Sagarv1997\RpVelocity\Providers;

use Illuminate\Support\ServiceProvider;
use Sagarv1997\RpVelocity\Console\RepositoryGenerateCommand;
use Sagarv1997\RpVelocity\Console\RepositoryInterfaceMakeCommand;
use Sagarv1997\RpVelocity\Console\RepositoryMakeCommand;
use Sagarv1997\RpVelocity\Console\RepositoryServiceProviderMakeCommand;

class RepositoryPatternServiceProvider extends ServiceProvider {
    public function boot() {

        if ($this->app->runningInConsole()) {
            $this->commands([
                RepositoryServiceProviderMakeCommand::class,
                RepositoryInterfaceMakeCommand::class,
                RepositoryMakeCommand::class,
                RepositoryGenerateCommand::class,
            ]);
        }
    }
}
