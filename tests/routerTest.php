<?php

use Winarcooo\SimpleRouter\Router;

it('can add and match routes', function () {
    $router = new Router();

    $router->add("GET", "/test", function () {
        echo "Test route matched!";
    });

    $_SERVER['REQUEST_METHOD'] = 'GET';
    $_SERVER['REQUEST_URI'] = '/test';

    ob_start();
    $router->matcher();
    $output = ob_get_clean();

    expect($output)->toBe("Test route matched!");
});