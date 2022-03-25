<?php

use App\Http\Controllers\ContohController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\JenjangController;
use App\Http\Controllers\AbsensiPengajarController;
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

// $router->get('api-v1/contoh/', 'ContohController@coba');

$router->post('api-v1/login/', 'AuthController@login');

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('api-v1/profil/user/detail', 'ProfilController@detail');

    $router->get('api-v1/jenjang/view/all', 'JenjangController@view');

    $router->get('api-v1/cabang/view/all', 'CabangController@view');

    $router->post('api-v1/absensi/pengajar', 'AbsensiPengajarController@create');
});