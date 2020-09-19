<?php

use App\Http\Controllers\HqController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', 'HqController@index');

Route::resources([
    'hq'            => 'HqController',
    'quadrinho'     => 'QuadrinhoController',
    'situar'        => 'SituarController',
    'problematizar' => 'ProblematizarController',
    'solucionar'    => 'SolucionarController'
]);

Route::view('quadrinhos', 'quadrinhos/index')->name('quadrinhos'); //view de quadrinho
Route::view('personagem1', 'hq/modal/personagem')->name('personagem1');

Route::get('mostrarQuadrinho/{hqId}/{quadrinhoId}', 'QuadrinhoController@edit')->name('mostrarQuadrinho');

// Route::resource('hq', 'HqController')->middleware('auth');
// Route::resource('quadrinho', 'QuadrinhoController')->middleware('auth');
// Route::resource('situar', 'SituarController')->middleware('auth');
// Route::resource('problematizar', 'ProblematizarController')->middleware('auth');
// Route::resource('solucionar', 'SolucionarController')->middleware('auth');

Route::post('problematizar/store', 'ProblematizarController@store');
Route::post('solucionar/store', 'SolucionarController@store');

Auth::routes();
Route::resource('usuario', 'Auth\AuthController');
Route::post('usuario/atualizarSenha/{id}', 'Auth\AuthController@atualizarSenha')->name('atualizarSenha');

Route::get('/home', 'HqController@index')->name('home');

