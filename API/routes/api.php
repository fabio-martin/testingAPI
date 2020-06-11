<?php

use App\Model\Category\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});



Route::get('/test', function (Request $request) {
    return Hash::make('isel');
    //return Category::get();
});

//Route::get('/categorias', 'CategoriaController@categorias');

//Route::get('categoria', 'CategoriaController@index');
//Route::get('categoria/{id}', 'CategoriaController@show');
//Route::post('categoria', 'CategoriaController@store');
//Route::put('categoria/{id}', 'CategoriaController@update');
//Route::delete('categoria/{id}', 'CategoriaController@delete');

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');


Route::group(['middleware' => 'auth.jwt'], function () {
//    Route::get('logout', 'ApiController@logout');
//
//    Route::get('tasks', 'TaskController@index');
//    Route::get('tasks/{id}', 'TaskController@show');
//    Route::post('tasks', 'TaskController@store');
//    Route::put('tasks/{id}', 'TaskController@update');
//    Route::delete('tasks/{id}', 'TaskController@destroy');

    Route::resources([
        '/dashboard' => 'DashboardController',
        '/category' => 'CategoryController',
        '/product' => 'ProductController',
        '/request' => 'RequestController',
        '/user' => 'UserController',
        '/provenance' => 'ProvenanceController',
        '/warehouse' => 'WarehouseController',
    ]);
    Route::resource('product.warehouse', 'ProductWarehouseController')->only('index');

    Route::post('/warehouse/{wId}/product/{pId}', 'WarehouseProductController@putProductsInAWarehouse');

    Route::put('/warehouse/{wId}/product/{pId}', 'WarehouseProductController@addProductsToTheWarehouse');

    Route::resource('warehouse.product', 'WarehouseProductController')->only('index', 'destroy');

    Route::put('product/{id}/price', 'ProductController@updateProductPrice');

});


