# Filament Unlayer

![image](https://github.com/user-attachments/assets/92204605-3edf-48ba-81a8-0eadce20b2c5)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ZPMLabs/filament-unlayer.svg?style=flat-square)](https://packagist.org/packages/ZPMLabs/filament-unlayer)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/ZPMLabs/filament-unlayer/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/ZPMLabs/filament-unlayer/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ZPMLabs/filament-unlayer.svg?style=flat-square)](https://packagist.org/packages/ZPMLabs/filament-unlayer)


This is a filament wrapper for unlayer editor with custom select field with unlayer templates.

## Requirements

- PHP 8.1+
- Laravel 10+
- Filament 4.x

## Installation

You can install the package via composer:

```bash
composer require ZPMLabs/filament-unlayer
```

### Version Compatibility
- **Filament 4.x** → Use this version (2.x)
- **Filament 3.x** → Use version 1.x: `composer require ZPMLabs/filament-unlayer:^1.0`

Create a cast within your model:

```php
protected $casts = [
   'content' => 'array',
];
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-unlayer-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-unlayer-views"
```

## Usage

As any other filament form field:

```php
Unlayer::make('content')->required()
```

In case you want to select unlayer templates you can use:

```php
SelectTemplate::make('template'),
Unlayer::make('content')->required()
```

By default the Unlayer field name should `content` but if you need to change it you will need to update `SelectTemplate`:

```php
SelectTemplate::make('template')
    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set)
        => $set('description', ZPMLabs\FilamentUnlayer\Services\GetTemplates::find($state))
    ),
Unlayer::make('description')->required()
```

If you want to pass additional options to unlayer, which will join default object set by plugin with your additional data you can use:

```php
Unlayer::make('description')
    ->additionalOptions([
        'option' => 'value'
    ])
```

In case you want to customize SelectTemplate options you can chain these methods:

```php
SelectTemplate::make('template')
    ->type('email') // or 'page', 'popup', ...
    ->isPremium(true) // shows only permium templates
    ->limit(50) // number of templates per search
    ->offset(0) // offset for pagination if needed
    ->collection('my-collection') // filtering by collection
    ->sortBy('recent') // or 'popular', 'oldest', ...
```

Or if you want to fully upgrade template selection by your custom code, you can do it by overriding `'templateResolver' => \ZPMLabs\FilamentUnlayer\Services\GetTemplates::class,` config line.

You can still chain other methods on these since:

`SelectTemplate` is extending filament `Select` field.

`Unlayer` is extending filament `Field` class.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
