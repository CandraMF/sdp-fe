<?php

require_once __DIR__ . '/../vendor/autoload.php';

$env = env('APP_ENV');
$file = '.env.' . $env;

// If the specific environment file doesn't exist, null out the $file variable.
if (!file_exists(dirname(__DIR__) . '/' . $file)) {
    $file = null;
}

// Pass in the .env file to load. If no specific environment file
// should be loaded, the $file parameter should be null.
(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__),
    $file
))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

$app->withFacades();
$app->configure('swagger-lume');
$app->configure('healthcheck');
$app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Config Files
|--------------------------------------------------------------------------
|
| Now we will register the "app" configuration file. If the file exists in
| your configuration directory it will be loaded; otherwise, we'll load
| the default version. You may register other files below as needed.
|
*/

$app->configure('app');
$app->configure('cors');
env('APP_ENV', 'local') == 'production' ? $app->configure('swoole') : '';

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

$middleware = [
    // App\Http\Middleware\ExampleMiddleware::class
];

if (env('CORS', 'false') == 'true' || env('CORS', false)) {
    $middleware = Fruitcake\Cors\HandleCors::class;
}

$app->middleware($middleware);



$routeMiddleware = [
    // 'auth' => App\Http\Middleware\Authenticate::class,
    'permission' => App\Http\Middleware\PermissionMiddleware::class,
];

if (env('API_THROTTLE', 'false') == 'true' || env('CORS', false)) {
    $routeMiddleware['throttle'] = \LumenRateLimiting\ThrottleRequests::class;
}

$app->routeMiddleware($routeMiddleware);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);
$app->register(\SwaggerLume\ServiceProvider::class);
$app->register(Illuminate\Redis\RedisServiceProvider::class);
$app->register(\UKFast\HealthCheck\HealthCheckServiceProvider::class);
$app->register(VladimirYuldashev\LaravelQueueRabbitMQ\LaravelQueueRabbitMQServiceProvider::class);
$app->register(Fruitcake\Cors\CorsServiceProvider::class);
$app->register(\LaravelMigrationGenerator\LaravelMigrationGeneratorProvider::class);
$app->register(Maatwebsite\Excel\ExcelServiceProvider::class);
$app->register(\Barryvdh\DomPDF\ServiceProvider::class);
$app->register('Sentry\Laravel\ServiceProvider');
env('APP_ENV', 'local') == 'production' ? $app->register(SwooleTW\Http\LumenServiceProvider::class) : '';

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$group = [
    'namespace' => 'App\Http\Controllers'
];
if (env('API_THROTTLE', false)) {
    $group['middleware'] = 'throttle:global';
}

$app->router->group($group, function ($router) {
    require __DIR__ . '/../routes/web.php';
});

return $app;
