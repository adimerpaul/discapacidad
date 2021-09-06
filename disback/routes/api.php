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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('/login',[\App\Http\Controllers\UserController::class,'login']);
Route::group(['middleware'=>'auth:sanctum'],function (){
    Route::post('/logout',[\App\Http\Controllers\UserController::class,'logout']);
    Route::post('/dia',[\App\Http\Controllers\PagoController::class,'dia']);
    Route::post('/mes',[\App\Http\Controllers\PagoController::class,'mes']);
    Route::post('/anio',[\App\Http\Controllers\PagoController::class,'anio']);
    Route::post('/mesfaltante',[\App\Http\Controllers\PagoController::class,'mesfaltante']);
    Route::post('/aniofaltante',[\App\Http\Controllers\PagoController::class,'aniofaltante']);
    Route::post('/me',[\App\Http\Controllers\UserController::class,'me']);
    Route::post('/mispagos',[\App\Http\Controllers\UserController::class,'mispagos']);
    Route::resource('/user',\App\Http\Controllers\UserController::class);
    Route::put('/pass/{user}',[\App\Http\Controllers\UserController::class,'pass']);
    Route::put('/updatepermisos/{user}',[\App\Http\Controllers\UserController::class,'updatepermisos']);
    Route::resource('/permiso',\App\Http\Controllers\PermisoController::class);

    Route::post('/verpendiente',[\App\Http\Controllers\PagoController::class,'verpendiente']);
    Route::post('/buscaresp',[\App\Http\Controllers\ResponsableController::class,'buscaresp']);
    Route::post('/upload',[\App\Http\Controllers\PagoController::class,'upload']);
	
    Route::resource('/pago',\App\Http\Controllers\PagoController::class);
		
		

});
