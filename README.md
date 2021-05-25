# RpVelocity

RpVelocity Package has Laravel Console command which help in creating a standard repository pattern in Laravel Project.

## Installation

Use the Composer [composer](https://packagist.org/packages/sagarv1997/rp-velocity) to install RpVelocity.

```bash
composer require sagarv1997/rp-velocity
```

## Features

It helps in generating all the following classes for Repository Pattern Implementation

- Model
- Interface
- Implementation
- ServiceProvider

## Configuration

To let our application know which implementation of which interface we want to use, we need to create a Laravel service provider. Use the following command to create the provider.

```bash
php artisan make:repository-provider RepositoryServiceProvider
```

The last step is to register this service provider in the config/app.php. Open config/app.php file and add the newly created provider in the providers

#### Example

```php
'providers' => [
    ...
    App\Providers\RepositoryServiceProvider::class,
]
```

## Usage

```bash
php artisan repository:generate ModelName
```

Once the files are generated you need to bind those files in the RepositoryServiceProvider class which was generated in the Configuration step.

Add the bindings in the mapRepositoryProviders function.

#### Example

```php
$this->app->bind(InterfaceName::class, RepositoryName::class);
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)
