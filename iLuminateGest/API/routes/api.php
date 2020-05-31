<?php

use Illuminate\Support\Facades\Route;

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
//
//Route::post('/login', 'ApiController@login');
//Route::post('/register', 'ApiController@register');
//
//
//Route::group(['middleware' => 'auth.jwt'], function () {
//
//    Route::resources([
//        '/categoria' => 'CategoriaController',
//    ]);
//});


Route::resources([
    '/categories' => 'CategoryController',
    '/clients' => 'ClientController',
    '/provenances' => 'ProvenanceController',
    '/states' => 'StateController',
    '/warehouses' => 'WarehouseController'
]);

Route::resource('/products', 'ProductController')->except('store');

Route::resource('categories.products', 'CategoryProductController')->only('index', 'store');

Route::resource('/orders', 'OrderController')->except('store');

Route::resource('clients.orders', 'ClientOrderController')->only('index');

Route::get('/orders/{orderId}/provenances', 'OrderController@originOfAnOrder');

Route::post('/clients/{cId}/provenances/{pId}/orders', 'ClientProvenanceOrderController@createOrder');

Route::get('/clients/{id}/provenances', 'ClientController@getClientProvenance');

Route::resource('orders.states', 'OrderStateController')->only('index');

Route::put('/orders/{oId}/states/{sId}', 'OrderStateController@assignStateToTheOrder');

Route::delete('/orders/{oId}/states/{sId}', 'OrderStateController@detachStateFromTheOrder');

Route::resource('orders.products', 'OrderProductController')->only('index');

Route::post('/orders/{oId}/products/{pId}', 'OrderProductController@assignProductToTheOrder');

Route::delete('/orders/{oId}/products/{pId}', 'OrderProductController@detachProductFromTheOrder');

Route::put('/orders/{oId}/products/{pId}', 'OrderProductController@UpdateProductOfAnOrder');

Route::resource('products.warehouses', 'ProductWarehouseController')->only('index');

route::post('/products/{pId}/warehouses/{wId}', 'ProductWarehouseController@putProductsInAWarehouse');

route::put('/products/{pId}/warehouses/{wId}', 'ProductWarehouseController@updateProductsInAWarehouse');
