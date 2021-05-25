<?php

namespace Sagarv1997\RpVelocity\Console;

use Illuminate\Console\Command;
use Sagarv1997\RpVelocity\Services\Constants;
use Symfony\Component\Console\Input\InputArgument;

class RepositoryGenerateCommand extends Command {
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'repository:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates the Repository Implementation and Interface';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle() {

        $name = $this->argument('name');

        $database = $this->choice(
            'What is the database used for this repository',
            Constants::$database,
            0
        );

        $this->makeRepositoryAndInterface($name, $database);

        $this->info('Repository and Interface generated successfully, Kindly map them in the RepositoryServiceProvider');
    }

    /**
     * Make the Repository and Interface for the given Model.
     *
     * @param string $model
     * @param string $database
     * @return void
     */
    protected function makeRepositoryAndInterface($model, $database) {

        $repositoryName = $model . "Repository";
        $interfaceName = $model . "RepositoryInterface";

        $interfaceLocation = 'App\\' . Constants::$DEFAULT_REPOSITORY_DIRECTORY . '\\' . $interfaceName;

        // Makes the Model if not Present
        $this->callSilent('make:model', ['name' => $model]);

        // Makes the Interface
        $this->callSilent('make:repository-interface', ['name' => $interfaceName]);

        // Makes the Repository
        $this->callSilent('make:repository', ['name' => $repositoryName, '--database' => $database, '--implements' => $interfaceLocation, '--model' => $model]);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments() {
        return [
            ['name', InputArgument::REQUIRED, 'The name Model linked to this class'],
        ];
    }

}
