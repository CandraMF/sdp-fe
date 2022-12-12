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
//$router->get("/daftarpesertapembinaankepribadian/{id}", "DaftarPesertaPembinaanKepribadianController@show");
$router->put("/daftarpesertapembinaankepribadian/{id}", "DaftarPesertaPembinaanKepribadianController@update");
$router->delete("/daftarpesertapembinaankepribadian/{id}", "DaftarPesertaPembinaanKepribadianController@destroy");

/**
 * DaftarReferensi routes
 */
$router->get("/daftarreferensi/schema", "DaftarReferensiController@schema");
$router->get("/daftarreferensi", "DaftarReferensiController@index");
$router->get("/daftarreferensi/dropdown", "DaftarReferensiController@dropdown");
$router->post("/daftarreferensi", "DaftarReferensiController@store");
$router->get("/daftarreferensi/{id}", "DaftarReferensiController@show");
$router->put("/daftarreferensi/{id}", "DaftarReferensiController@update");
$router->delete("/daftarreferensi/{id}", "DaftarReferensiController@destroy");
$router->get("/daftarreferensi/export/excel", "DaftarReferensiController@exportExcel");
$router->get("/daftarreferensi/export/pdf", "DaftarReferensiController@exportPdf");
/**
 * PrasaranaLahanPembinaanKepribadian routes
 */
$router->get("/prasaranalahanpembinaankepribadian/schema", "PrasaranaLahanPembinaanKepribadianController@schema");
$router->get("/prasaranalahanpembinaankepribadian", "PrasaranaLahanPembinaanKepribadianController@index");
$router->get("/prasaranalahanpembinaankepribadian/dropdown", "PrasaranaLahanPembinaanKepribadianController@dropdown");
$router->post("/prasaranalahanpembinaankepribadian", "PrasaranaLahanPembinaanKepribadianController@store");
//$router->get("/prasaranalahanpembinaankepribadian/{id}", "PrasaranaLahanPembinaanKepribadianController@show");
$router->put("/prasaranalahanpembinaankepribadian/{id}", "PrasaranaLahanPembinaanKepribadianController@update");
$router->delete("/prasaranalahanpembinaankepribadian/{id}", "PrasaranaLahanPembinaanKepribadianController@destroy");

/**
 * PrasaranaRuangPembinaanKepribadian routes
 */
$router->get("/prasaranaruangpembinaankepribadian/schema", "PrasaranaRuangPembinaanKepribadianController@schema");
$router->get("/prasaranaruangpembinaankepribadian", "PrasaranaRuangPembinaanKepribadianController@index");
$router->get("/prasaranaruangpembinaankepribadian/dropdown", "PrasaranaRuangPembinaanKepribadianController@dropdown");
$router->post("/prasaranaruangpembinaankepribadian", "PrasaranaRuangPembinaanKepribadianController@store");
//$router->get("/prasaranaruangpembinaankepribadian/{id}", "PrasaranaRuangPembinaanKepribadianController@show");
$router->put("/prasaranaruangpembinaankepribadian/{id}", "PrasaranaRuangPembinaanKepribadianController@update");
$router->delete("/prasaranaruangpembinaankepribadian/{id}", "PrasaranaRuangPembinaanKepribadianController@destroy");

/**
 * SaranaPembinaanKepribadian routes
 */
$router->get("/saranapembinaankepribadian/schema", "SaranaPembinaanKepribadianController@schema");
$router->get("/saranapembinaankepribadian", "SaranaPembinaanKepribadianController@index");
$router->get("/saranapembinaankepribadian/dropdown", "SaranaPembinaanKepribadianController@dropdown");
$router->post("/saranapembinaankepribadian", "SaranaPembinaanKepribadianController@store");
//$router->get("/saranapembinaankepribadian/{id}", "SaranaPembinaanKepribadianController@show");
$router->put("/saranapembinaankepribadian/{id}", "SaranaPembinaanKepribadianController@update");
$router->delete("/saranapembinaankepribadian/{id}", "SaranaPembinaanKepribadianController@destroy");

/**
 * InstrukturPembinaanKepribadian routes
 */
$router->get("/instrukturpembinaankepribadian/schema", "InstrukturPembinaanKepribadianController@schema");
$router->get("/instrukturpembinaankepribadian", "InstrukturPembinaanKepribadianController@index");
$router->get("/instrukturpembinaankepribadian/dropdown", "InstrukturPembinaanKepribadianController@dropdown");
$router->post("/instrukturpembinaankepribadian", "InstrukturPembinaanKepribadianController@store");
//$router->get("/instrukturpembinaankepribadian/{id}", "InstrukturPembinaanKepribadianController@show");
$router->put("/instrukturpembinaankepribadian/{id}", "InstrukturPembinaanKepribadianController@update");
$router->delete("/instrukturpembinaankepribadian/{id}", "InstrukturPembinaanKepribadianController@destroy");

/**
 * PelatihanKeterampilan routes
 */
$router->get("/pelatihanketerampilan/schema", "PelatihanKeterampilanController@schema");
$router->get("/pelatihanketerampilan", "PelatihanKeterampilanController@index");
$router->get("/pelatihanketerampilan/dropdown", "PelatihanKeterampilanController@dropdown");
$router->post("/pelatihanketerampilan", "PelatihanKeterampilanController@store");
$router->get("/pelatihanketerampilan/{id}", "PelatihanKeterampilanController@show");
$router->put("/pelatihanketerampilan/{id}", "PelatihanKeterampilanController@update");
$router->delete("/pelatihanketerampilan/{id}", "PelatihanKeterampilanController@destroy");

/**
 * JadwalPelatihanKeterampilan routes
 */
$router->get("/jadwalpelatihanketerampilan/schema", "JadwalPelatihanKeterampilanController@schema");
$router->get("/jadwalpelatihanketerampilan", "JadwalPelatihanKeterampilanController@index");
$router->get("/jadwalpelatihanketerampilan/dropdown", "JadwalPelatihanKeterampilanController@dropdown");
$router->post("/jadwalpelatihanketerampilan", "JadwalPelatihanKeterampilanController@store");
$router->get("/jadwalpelatihanketerampilan/{id}", "JadwalPelatihanKeterampilanController@show");
$router->put("/jadwalpelatihanketerampilan/{id}", "JadwalPelatihanKeterampilanController@update");
$router->delete("/jadwalpelatihanketerampilan/{id}", "JadwalPelatihanKeterampilanController@destroy");

/**
 * PesertaPelatihanKeterampilan routes
 */
$router->get("/pesertapelatihanketerampilan/schema", "PesertaPelatihanKeterampilanController@schema");
$router->get("/pesertapelatihanketerampilan", "PesertaPelatihanKeterampilanController@index");
$router->get("/pesertapelatihanketerampilan/dropdown", "PesertaPelatihanKeterampilanController@dropdown");
$router->post("/pesertapelatihanketerampilan", "PesertaPelatihanKeterampilanController@store");
$router->get("/pesertapelatihanketerampilan/{id}", "PesertaPelatihanKeterampilanController@show");
$router->put("/pesertapelatihanketerampilan/{id}", "PesertaPelatihanKeterampilanController@update");
$router->delete("/pesertapelatihanketerampilan/{id}", "PesertaPelatihanKeterampilanController@destroy");

/**
 * LaporanPelatihanKeterampilan routes
 */
$router->get("/laporanpelatihanketerampilan/schema", "LaporanPelatihanKeterampilanController@schema");
$router->get("/laporanpelatihanketerampilan", "LaporanPelatihanKeterampilanController@index");
$router->get("/laporanpelatihanketerampilan/dropdown", "LaporanPelatihanKeterampilanController@dropdown");
$router->post("/laporanpelatihanketerampilan", "LaporanPelatihanKeterampilanController@store");
$router->get("/laporanpelatihanketerampilan/{id}", "LaporanPelatihanKeterampilanController@show");
$router->put("/laporanpelatihanketerampilan/{id}", "LaporanPelatihanKeterampilanController@update");
$router->delete("/laporanpelatihanketerampilan/{id}", "LaporanPelatihanKeterampilanController@destroy");

/**
 * DaftarPesertaPelatihanKeterampilan routes
 */
$router->get("/daftarpesertapelatihanketerampilan/schema", "DaftarPesertaPelatihanKeterampilanController@schema");
$router->get("/daftarpesertapelatihanketerampilan", "DaftarPesertaPelatihanKeterampilanController@index");
$router->get("/daftarpesertapelatihanketerampilan/dropdown", "DaftarPesertaPelatihanKeterampilanController@dropdown");
$router->post("/daftarpesertapelatihanketerampilan", "DaftarPesertaPelatihanKeterampilanController@store");
//$router->get("/daftarpesertapelatihanketerampilan/{id}", "DaftarPesertaPelatihanKeterampilanController@show");
$router->put("/daftarpesertapelatihanketerampilan/{id}", "DaftarPesertaPelatihanKeterampilanController@update");
$router->delete("/daftarpesertapelatihanketerampilan/{id}", "DaftarPesertaPelatihanKeterampilanController@destroy");

/**
 * PrasaranaLahanPelatihanKeterampilan routes
 */
$router->get("/prasaranalahanpelatihanketerampilan/schema", "PrasaranaLahanPelatihanKeterampilanController@schema");
$router->get("/prasaranalahanpelatihanketerampilan", "PrasaranaLahanPelatihanKeterampilanController@index");
$router->get("/prasaranalahanpelatihanketerampilan/dropdown", "PrasaranaLahanPelatihanKeterampilanController@dropdown");
$router->post("/prasaranalahanpelatihanketerampilan", "PrasaranaLahanPelatihanKeterampilanController@store");
//$router->get("/prasaranalahanpelatihanketerampilan/{id}", "PrasaranaLahanPelatihanKeterampilanController@show");
$router->put("/prasaranalahanpelatihanketerampilan/{id}", "PrasaranaLahanPelatihanKeterampilanController@update");
$router->delete("/prasaranalahanpelatihanketerampilan/{id}", "PrasaranaLahanPelatihanKeterampilanController@destroy");

/**
 * PrasaranaRuangPelatihanKeterampilan routes
 */
$router->get("/prasaranaruangpelatihanketerampilan/schema", "PrasaranaRuangPelatihanKeterampilanController@schema");
$router->get("/prasaranaruangpelatihanketerampilan", "PrasaranaRuangPelatihanKeterampilanController@index");
$router->get("/prasaranaruangpelatihanketerampilan/dropdown", "PrasaranaRuangPelatihanKeterampilanController@dropdown");
$router->post("/prasaranaruangpelatihanketerampilan", "PrasaranaRuangPelatihanKeterampilanController@store");
//$router->get("/prasaranaruangpelatihanketerampilan/{id}", "PrasaranaRuangPelatihanKeterampilanController@show");
$router->put("/prasaranaruangpelatihanketerampilan/{id}", "PrasaranaRuangPelatihanKeterampilanController@update");
$router->delete("/prasaranaruangpelatihanketerampilan/{id}", "PrasaranaRuangPelatihanKeterampilanController@destroy");

/**
 * SaranaPelatihanKeterampilan routes
 */
$router->get("/saranapelatihanketerampilan/schema", "SaranaPelatihanKeterampilanController@schema");
$router->get("/saranapelatihanketerampilan", "SaranaPelatihanKeterampilanController@index");
$router->get("/saranapelatihanketerampilan/dropdown", "SaranaPelatihanKeterampilanController@dropdown");
$router->post("/saranapelatihanketerampilan", "SaranaPelatihanKeterampilanController@store");
//$router->get("/saranapelatihanketerampilan/{id}", "SaranaPelatihanKeterampilanController@show");
$router->put("/saranapelatihanketerampilan/{id}", "SaranaPelatihanKeterampilanController@update");
$router->delete("/saranapelatihanketerampilan/{id}", "SaranaPelatihanKeterampilanController@destroy");

/**
 * InstrukturPelatihanKeterampilan routes
 */
$router->get("/instrukturpelatihanketerampilan/schema", "InstrukturPelatihanKeterampilanController@schema");
$router->get("/instrukturpelatihanketerampilan", "InstrukturPelatihanKeterampilanController@index");
$router->get("/instrukturpelatihanketerampilan/dropdown", "InstrukturPelatihanKeterampilanController@dropdown");
$router->post("/instrukturpelatihanketerampilan", "InstrukturPelatihanKeterampilanController@store");
//$router->get("/instrukturpelatihanketerampilan/{id}", "InstrukturPelatihanKeterampilanController@show");
$router->put("/instrukturpelatihanketerampilan/{id}", "InstrukturPelatihanKeterampilanController@update");
$router->delete("/instrukturpelatihanketerampilan/{id}", "InstrukturPelatihanKeterampilanController@destroy");