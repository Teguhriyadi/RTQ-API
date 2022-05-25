<?php

use App\Http\Controllers\ContohController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\JenjangController;
use App\Http\Controllers\IuranController;
use App\Http\Controllers\AbsensiAsatidzController;

/** @var \Laravel\Lumen\Routing\Router $router */
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

$router->get('/', function () use ($router) {
    // return $router->app->version();
    header('Location: http://rtq-freelance.my.id/');
    die;
});

$router->post('api-v1/login/', 'AuthController@login');

$router->group(['middleware' => 'auth'], function () use ($router) {
    // Detail User
    $router->get('api-v1/profil/user/detail', 'ProfilController@detail');

    // Kategori Pelajaran
    $router->get('api-v1/kategori/pelajaran/view/all', 'KategoriPenilaianController@view');
    $router->get('api-v1/kategori/pelajaran/view/{id_jenjang}/{id_katagori}', 'KategoriPenilaianController@viewByJenjangNPenilaian');

    $router->get('api-v1/pelajaran/view/all', 'KategoriPelajaranController@view');
    $router->get('api-v1/pelajaran/view/{id_kategori_penilaian}/{id_jenjang}', 'KategoriPelajaranController@viewByKategoriNJenjang');

    // Kategori Penilaian
    $router->get('api-v1/penilaian/view/{id_pelajaran}/{id_santri}', 'PenilaianController@get_nilai');

    // List Jenjang
    $router->get('api-v1/jenjang/view/all', 'JenjangController@view');

    // List Jenjang
    $router->get('api-v1/jenjang/view/all', 'JenjangController@view');

    // List Cabang
    $router->get('api-v1/cabang/view/all', 'CabangController@view');

    // List Santri
    $router->get('api-v1/santri/view/all', 'SantriController@view');
    $router->get('api-v1/santri/view/all/wali-santri', 'SantriController@viewByWaliSantri');
    $router->get('api-v1/santri/view/{kode_halaqah}/{id_jenjang}', 'SantriController@viewByHalaqahNJenjang');

    // Abesensi Asatidz
    $router->post('api-v1/absensi/asatidz', 'AbsensiAsatidzController@create');

    // List Detail Iuran
    $router->get('api-v1/iuran/detail/{id}', 'IuranController@detail');
});

$router->get('coba', 'ContohController@coba');
$router->post('coba', 'ContohController@postCoba');
