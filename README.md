# Airdev/medias
A package that quickly provide medias with webp conversion

It's only working with Airdev web base project.

## Installation
```shell
composer require airdev/medias
```

Next, add it to the Laravel's package providers in ``config/app.php``
```php
/*
 * Package Service Providers...
 */
Airdev\Medias\AirdevMediasProvider::class,
```

Publish migrations, configure it if needed, the migrate.
```shell
php artisan vendor:publish --tag=airdev-medias-migrations
php artisan migrate
```

## Usage
You can now post image on Nova's Interface.

### Call the blade component into your view

```blade
<x-airdev::picture slug="your-slug"></x-airdev::picture>
```

You can add a custom class to the generated image tag, or multiple class

```blade
<x-airdev::picture slug="your-slug" class="img-fluid"></x-airdev::picture>
<x-airdev::picture slug="your-slug" class="img-fluid my-second-class"></x-airdev::picture>
```
