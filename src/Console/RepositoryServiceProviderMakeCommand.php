<?php

namespace Sagarv1997\RpVelocity\Console;

use Illuminate\Console\GeneratorCommand;

class RepositoryServiceProviderMakeCommand extends GeneratorCommand {
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:repository-provider';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository service provider class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Provider';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub() {
        return __DIR__ . '/stubs/respository-provider.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace) {
        return $rootNamespace . '\Providers';
    }
}
