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

$router->get("test", ["middleware" => "permission", function () {
    return "hai ini kami";
}]);

$router->get("/", function () use ($router) {
    return $router->app->version();
});

$router->get("/routes", function () {
    $except = ["routes", "docs", "swagger", "documentation", "ping", "health", "oauth2", "test"];

    $x = array();
    $routes = Route::getRoutes();
    foreach ($routes as $route) {
        if (!Str::contains($route["uri"], $except) && $route["uri"] != "/") {
            $x[] = [
                "method" => $route["method"],
                "uri" => $route["uri"],
                "base_url" => url("/")
            ];
        }
    }
    return response()->json($x);
});

$router->group(["prefix" => "ref"], function () use ($router) {

 /////////// JENIS SARANA   
 	$ArrRouter=array("jenis-sarana", "RefJenisSaranaController");
	$router->get("{$ArrRouter[0]}", "{$ArrRouter[1]}@index");

    //// CRUDS
    $router->get("{$ArrRouter[0]}/show/{id}", "{$ArrRouter[1]}@show");
	$router->get("{$ArrRouter[0]}/tampil/{id}", "{$ArrRouter[1]}@tampil");
    $router->post("{$ArrRouter[0]}", "{$ArrRouter[1]}@store");
    $router->put("{$ArrRouter[0]}/{id}", "{$ArrRouter[1]}@update");
    $router->delete("{$ArrRouter[0]}/{id}", "{$ArrRouter[1]}@destroy");

    //// EXPORT-DATA
	 
    $router->get("{$ArrRouter[0]}/export-excel", "{$ArrRouter[1]}@exportExcel");
    $router->get("{$ArrRouter[0]}/export-pdf", "{$ArrRouter[1]}@exportPdf");



});
