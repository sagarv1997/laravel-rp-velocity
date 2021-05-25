<?php

namespace Sagarv1997\RpVelocity\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Sagarv1997\RpVelocity\Services\Constants;
use Symfony\Component\Console\Input\InputOption;

class RepositoryMakeCommand extends GeneratorCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Repository';

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name) {

        $stub = parent::buildClass($name);

        $implements = $this->option('implements');
        $model = $this->option('model');

        if (isset($implements)) {
            $stub = str_replace(
                'DummyInterfaceNamespace', $implements, $stub
            );
        }

        if (isset($model)) {
            $modelNameSpace = 'App\\' . Constants::$DEFAULT_MODELS_DIRECTORY . '\\' . $model;
            $modelNameArray = explode('\\', $model);
            $modelName = end($modelNameArray);

            $stub = str_replace(
                'DummyModelNamespace', $modelNameSpace, $stub
            );
            $stub = str_replace(
                'DummyModelClass', $modelName, $stub
            );
        }

        return $stub;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     *
     */
    protected function getStub() {
        $implements = $this->option('implements');
        $database = $this->option('database');

        return $this->getStubForDatabaseAndImplementation($database, $implements);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     *
     */
    protected function getStubForDatabaseAndImplementation($database, $implements) {

        if (isset($implements)) {

            if (isset($database)) {
                switch ($database) {
                case Constants::$MY_SQL:
                    return __DIR__ . '/stubs/Repository/implementation-mysql-i.stub';
                    break;
                default:
                    return __DIR__ . '/stubs/Repository/implementation-i.stub';
                }

            } else {
                return __DIR__ . '/stubs/Repository/implementation-i.stub';
            }
        } else {

            switch ($database) {
            case Constants::$MY_SQL:
                return __DIR__ . '/stubs/Repository/implementation-mysql.stub';
                break;
            default:
                return __DIR__ . '/stubs/Repository/implementation.stub';
            }
        }
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
        $database = $this->option('database');

        $name = $rootNamespace . '/' . Constants::$DEFAULT_REPOSITORY_DIRECTORY;

        // Adding Database in the Namespace
        if (isset($database)) {
            $name = $rootNamespace . '/' . Constants::$DEFAULT_REPOSITORY_DIRECTORY . '/' . $database;
        }

        return $name;
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name) {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return [
            ['database', 'd', InputOption::VALUE_OPTIONAL, 'The Database which will be used in this repository'],
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'Model for this Repository'],
            ['implements', 'i', InputOption::VALUE_OPTIONAL, 'Path of the Interface class for this repository'],
        ];
    }

}
