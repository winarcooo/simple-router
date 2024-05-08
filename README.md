# Simple Router

Simple router for personal use.

## Requirement

* PHP >= 8.1

## Installation

You can install this package via Composer :

```bash
composer require winarcooo/simple-router
```

## Usage

Here's a basic example of how to use the Simple Router :

```php
<?php

use Winarcooo\SimpleRouter\Router;

// Include Composer's autoloader
require 'vendor/autoload.php';

// Create a new router instance
$router = new Router();

// Define routes
$router->addRoute("GET", "/home", [HomeController::class, 'index']);

// Match the route
try {
    $router->matchRoute();
} catch (\Exception $e) {
    // Handle route not found
    echo $e->getMessage();
}
```

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, feel free to open an issue or create a pull request.

## License

This package is open-sourced software licensed under the MIT license.