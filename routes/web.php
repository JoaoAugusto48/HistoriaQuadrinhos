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

Route::view('quadrinhos', 'quadrinhos/index')->name('quadrinhos'); //view de quadrinho

Route::resource('hq', 'HqController');
Route::resource('quadrinho', 'QuadrinhoController');
