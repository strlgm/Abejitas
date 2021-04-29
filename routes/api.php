<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\DatosController;
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
Route::group([
    'middleware'=>'api',
    'prefix'=>'auth'
],function ($router) {

    Route::post('/login',[AuthController::class,'login']);
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::post('/refresh',[AuthController::class,'refresh']);
    Route::get('/user-profile',[AuthController::class,'userprofile']);
    Route::get('/users',[AuthController::class,'index']);
    Route::get('/user-hotel',[AuthController::class,'userhotel']);
});

Route::group([
    'middleware'=>'api',
    'prefix'=>'hotel'
],function ($router) {

    Route::post('/',[HotelController::class,'store']);
    Route::get('/',[HotelController::class,'index']);
    Route::get('/hotel-profile',[HotelController::class,'show']);
    Route::put('/edit',[HotelController::class,'edit']);
    Route::delete('/destroy',[HotelController::class,'destroy']);
    Route::post('/preregister',[HotelController::class,'idras']);
    Route::get('/datos-hotel/{id}',[HotelController::class,'datosHotel']);
});

Route::group([
    'middleware'=>'api',
    'prefix'=>'datos'
],function ($router) {

    Route::post('/register',[DatosController::class,'store']);
    Route::get('/',[DatosController::class,'index']);
    Route::put('/edit/{id}',[DatosController::class,'update']);
   

});






Route::get('/pais','App\Http\Controllers\PaisController@index');



