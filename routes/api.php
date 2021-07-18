<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/epaymaker-payment-status', 'FrontendController@epaymaker_payment_status');
Route::get('/vpos-product', 'VposController@all_products');
Route::get('/vpos-product/{id}', 'VposController@get_products');
Route::get('/vpos-product-all-info/{id}', 'VposController@get_products_all_info');
