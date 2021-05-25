<?php

namespace Sagarv1997\RpVelocity\Console;

use Illuminate\Console\GeneratorCommand;
use Sagarv1997\RpVelocity\Services\Constants;

class RepositoryInterfaceMakeCommand extends GeneratorCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:repository-interface';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Interface';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     *
     */
    protected function getStub() {
        return __DIR__ . '/stubs/RepositoryInterface/interface.stub';
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName) {
        return class_exists($rawName);
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace) {
        return $rootNamespace . '\\' . Constants::$DEFAULT_REPOSITORY_DIRECTORY;
    }

}
