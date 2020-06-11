<?php

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
//Auth::routes();

//Route::resource('/', 'HomeController')->middleware('auth');
Route::resource('/', 'HomeController');
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/v2', function () {
//    return view('welcome2');
//});


//
//Route::resources([
//    '/catego' => 'CatController',
////    '/militar/armas' => 'MilitarArmasController'
//]);


//Auth::routes();

//Route::get('/home', function() {
//    return view('home');
//})->name('home')->middleware('auth');

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('/produto', 'ProdutoController');
