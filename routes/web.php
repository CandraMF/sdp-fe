<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('test', ['middleware' => 'permission', function () {
    return 'hai ini kami';
}]);

$router->get('/', function () use ($router) {

    return $router->app->version();
});

$router->get('/routes', function () {
    $except = ['routes', 'docs', 'swagger', 'documentation', 'ping', 'health', 'oauth2', 'test'];

    $x = array();
    $routes = Route::getRoutes();
    foreach ($routes as $route) {
        if (!Str::contains($route['uri'], $except) && $route['uri'] != "/") {
            $x[] = [
                'method' => $route['method'],
                'uri' => $route['uri'],
                'base_url' => url('/')
            ];
        }
    }
    return response()->json($x);
});
