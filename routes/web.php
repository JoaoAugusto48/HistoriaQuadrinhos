<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', 'SoftwareController@index')->middleware('auth');
Route::get('/home', 'SoftwareController@index')->name('home')->middleware('auth');
Route::view('/', 'nonUser/index')->name('index');

Route::resources([
    'hq'            => 'HqController',
    'quadrinho'     => 'QuadrinhoController',
    'situar'        => 'SituarController',
    'problematizar' => 'ProblematizarController',
    'solucionar'    => 'SolucionarController',

    'gerencia'      => 'Gerencia\GerenciarController',
    'personagem'    => 'Utensilio\PersonagemController',
    'ambiente'      => 'Utensilio\AmbienteController',
    'balao'         => 'Utensilio\BalaoController',
    'utensilio'     => 'Utensilio\UtensilioController',
    'quadrinhoPersonagem' => 'Quadrinho\QuadrinhoPersonagemController',
    'software'      => 'SoftwareController',

    'cliente'       => 'ClienteController',
]);

//criar uma HQ pelo software cadastrado
Route::get('hq/create/{softwareId}', 'HqController@create')->name('criarHq');

Route::view('quadrinhos', 'quadrinhos/index')->name('quadrinhos'); //view de quadrinho
Route::view('personagem1', 'hq/modal/personagem')->name('personagem1');

Route::get('mostrarQuadrinho/{hqId}/{quadrinhoId}', 'QuadrinhoController@edit')->name('mostrarQuadrinho');

Route::post('problematizar/store', 'ProblematizarController@store');
Route::post('solucionar/store', 'SolucionarController@store');

Auth::routes();
Route::resource('usuario', 'Auth\AuthController');
Route::post('usuario/atualizarUsuario', 'Auth\AuthController@atualizarUsuario')->name('atualizarUsuario');
Route::post('usuario/atualizarSenha', 'Auth\AuthController@atualizarSenha')->name('atualizarSenha');

