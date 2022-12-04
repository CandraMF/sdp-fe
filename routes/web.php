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

/**
* Mitra routes
*/
$router->get("/mitra/schema", "MitraController@schema");
$router->get("/mitra", "MitraController@index");
$router->get("/mitra/dropdown", "MitraController@dropdown");
$router->post("/mitra", "MitraController@store");
$router->get("/mitra/{id}", "MitraController@show");
$router->put("/mitra/{id}", "MitraController@update");
$router->delete("/mitra/{id}", "MitraController@destroy");

/**
* MitraKontrak routes
*/
$router->get("/mitrakontrak/schema", "MitraKontrakController@schema");
$router->get("/mitrakontrak", "MitraKontrakController@index");
$router->get("/mitrakontrak/dropdown", "MitraKontrakController@dropdown");
$router->post("/mitrakontrak", "MitraKontrakController@store");
$router->get("/mitrakontrak/{id}", "MitraKontrakController@show");
$router->put("/mitrakontrak/{id}", "MitraKontrakController@update");
$router->delete("/mitrakontrak/{id}", "MitraKontrakController@destroy");

/**
* Sarana routes
*/
$router->get("/sarana/schema", "SaranaController@schema");
$router->get("/sarana", "SaranaController@index");
$router->get("/sarana/dropdown", "SaranaController@dropdown");
$router->post("/sarana", "SaranaController@store");
$router->get("/sarana/{id}", "SaranaController@show");
$router->put("/sarana/{id}", "SaranaController@update");
$router->delete("/sarana/{id}", "SaranaController@destroy");

/**
* StatusSarana routes
*/
$router->get("/statussarana/schema", "StatusSaranaController@schema");
$router->get("/statussarana", "StatusSaranaController@index");
$router->get("/statussarana/dropdown", "StatusSaranaController@dropdown");
$router->post("/statussarana", "StatusSaranaController@store");
$router->get("/statussarana/{id}", "StatusSaranaController@show");
$router->put("/statussarana/{id}", "StatusSaranaController@update");
$router->delete("/statussarana/{id}", "StatusSaranaController@destroy");

/**
* PrasaranaLahan routes
*/
$router->get("/prasaranalahan/schema", "PrasaranaLahanController@schema");
$router->get("/prasaranalahan", "PrasaranaLahanController@index");
$router->get("/prasaranalahan/dropdown", "PrasaranaLahanController@dropdown");
$router->post("/prasaranalahan", "PrasaranaLahanController@store");
$router->get("/prasaranalahan/{id}", "PrasaranaLahanController@show");
$router->put("/prasaranalahan/{id}", "PrasaranaLahanController@update");
$router->delete("/prasaranalahan/{id}", "PrasaranaLahanController@destroy");

/**
* StatusPrasaranaLahan routes
*/
$router->get("/statusprasaranalahan/schema", "StatusPrasaranaLahanController@schema");
$router->get("/statusprasaranalahan", "StatusPrasaranaLahanController@index");
$router->get("/statusprasaranalahan/dropdown", "StatusPrasaranaLahanController@dropdown");
$router->post("/statusprasaranalahan", "StatusPrasaranaLahanController@store");
$router->get("/statusprasaranalahan/{id}", "StatusPrasaranaLahanController@show");
$router->put("/statusprasaranalahan/{id}", "StatusPrasaranaLahanController@update");
$router->delete("/statusprasaranalahan/{id}", "StatusPrasaranaLahanController@destroy");

/**
* PrasaranaRuang routes
*/
$router->get("/prasaranaruang/schema", "PrasaranaRuangController@schema");
$router->get("/prasaranaruang", "PrasaranaRuangController@index");
$router->get("/prasaranaruang/dropdown", "PrasaranaRuangController@dropdown");
$router->post("/prasaranaruang", "PrasaranaRuangController@store");
$router->get("/prasaranaruang/{id}", "PrasaranaRuangController@show");
$router->put("/prasaranaruang/{id}", "PrasaranaRuangController@update");
$router->delete("/prasaranaruang/{id}", "PrasaranaRuangController@destroy");

/**
* StatusPrasaranaRuang routes
*/
$router->get("/statusprasaranaruang/schema", "StatusPrasaranaRuangController@schema");
$router->get("/statusprasaranaruang", "StatusPrasaranaRuangController@index");
$router->get("/statusprasaranaruang/dropdown", "StatusPrasaranaRuangController@dropdown");
$router->post("/statusprasaranaruang", "StatusPrasaranaRuangController@store");
$router->get("/statusprasaranaruang/{id}", "StatusPrasaranaRuangController@show");
$router->put("/statusprasaranaruang/{id}", "StatusPrasaranaRuangController@update");
$router->delete("/statusprasaranaruang/{id}", "StatusPrasaranaRuangController@destroy");

/**
* Instruktur routes
*/
$router->get("/instruktur/schema", "InstrukturController@schema");
$router->get("/instruktur", "InstrukturController@index");
$router->get("/instruktur/dropdown", "InstrukturController@dropdown");
$router->post("/instruktur", "InstrukturController@store");
$router->get("/instruktur/{id}", "InstrukturController@show");
$router->put("/instruktur/{id}", "InstrukturController@update");
$router->delete("/instruktur/{id}", "InstrukturController@destroy");

/**
* PembinaanKepribadian routes
*/
$router->get("/pembinaankepribadian/schema", "PembinaanKepribadianController@schema");
$router->get("/pembinaankepribadian", "PembinaanKepribadianController@index");
$router->get("/pembinaankepribadian/dropdown", "PembinaanKepribadianController@dropdown");
$router->post("/pembinaankepribadian", "PembinaanKepribadianController@store");
$router->get("/pembinaankepribadian/{id}", "PembinaanKepribadianController@show");
$router->put("/pembinaankepribadian/{id}", "PembinaanKepribadianController@update");
$router->delete("/pembinaankepribadian/{id}", "PembinaanKepribadianController@destroy");

/**
* JadwalPembinaanKepribadian routes
*/
$router->get("/jadwalpembinaankepribadian/schema", "JadwalPembinaanKepribadianController@schema");
$router->get("/jadwalpembinaankepribadian", "JadwalPembinaanKepribadianController@index");
$router->get("/jadwalpembinaankepribadian/dropdown", "JadwalPembinaanKepribadianController@dropdown");
$router->post("/jadwalpembinaankepribadian", "JadwalPembinaanKepribadianController@store");
$router->get("/jadwalpembinaankepribadian/{id}", "JadwalPembinaanKepribadianController@show");
$router->put("/jadwalpembinaankepribadian/{id}", "JadwalPembinaanKepribadianController@update");
$router->delete("/jadwalpembinaankepribadian/{id}", "JadwalPembinaanKepribadianController@destroy");

/**
* PesertaPembinaanKepribadian routes
*/
$router->get("/pesertapembinaankepribadian/schema", "PesertaPembinaanKepribadianController@schema");
$router->get("/pesertapembinaankepribadian", "PesertaPembinaanKepribadianController@index");
$router->get("/pesertapembinaankepribadian/dropdown", "PesertaPembinaanKepribadianController@dropdown");
$router->post("/pesertapembinaankepribadian", "PesertaPembinaanKepribadianController@store");
$router->get("/pesertapembinaankepribadian/{id}", "PesertaPembinaanKepribadianController@show");
$router->put("/pesertapembinaankepribadian/{id}", "PesertaPembinaanKepribadianController@update");
$router->delete("/pesertapembinaankepribadian/{id}", "PesertaPembinaanKepribadianController@destroy");

/**
* LaporanPembinaanKepribadian routes
*/
$router->get("/laporanpembinaankepribadian/schema", "LaporanPembinaanKepribadianController@schema");
$router->get("/laporanpembinaankepribadian", "LaporanPembinaanKepribadianController@index");
$router->get("/laporanpembinaankepribadian/dropdown", "LaporanPembinaanKepribadianController@dropdown");
$router->post("/laporanpembinaankepribadian", "LaporanPembinaanKepribadianController@store");
$router->get("/laporanpembinaankepribadian/{id}", "LaporanPembinaanKepribadianController@show");
$router->put("/laporanpembinaankepribadian/{id}", "LaporanPembinaanKepribadianController@update");
$router->delete("/laporanpembinaankepribadian/{id}", "LaporanPembinaanKepribadianController@destroy");

/**
* DaftarPesertaPembinaanKepribadian routes
*/
$router->get("/daftarpesertapembinaankepribadian/schema", "DaftarPesertaPembinaanKepribadianController@schema");
$router->get("/daftarpesertapembinaankepribadian", "DaftarPesertaPembinaanKepribadianController@index");
$router->get("/daftarpesertapembinaankepribadian/dropdown", "DaftarPesertaPembinaanKepribadianController@dropdown");
$router->post("/daftarpesertapembinaankepribadian", "DaftarPesertaPembinaanKepribadianController@store");
$router->get("/daftarpesertapembinaankepribadian/{id}", "DaftarPesertaPembinaanKepribadianController@show");
$router->put("/daftarpesertapembinaankepribadian/{id}", "DaftarPesertaPembinaanKepribadianController@update");
$router->delete("/daftarpesertapembinaankepribadian/{id}", "DaftarPesertaPembinaanKepribadianController@destroy");
