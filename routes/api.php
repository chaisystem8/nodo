<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AlumnoAPI;
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


Route::post("guardar", [AlumnoAPI::class, 'guardar']);
Route::get("alumnos/{id?}", [AlumnoAPI::class, 'alumnos']);
Route::put("actualizar", [AlumnoAPI::class, 'actualizar']);
Route::delete("eliminar/{id?}", [AlumnoAPI::class, 'eliminar']);
Route::get("buscar/{cadena?}", [AlumnoAPI::class, 'buscar']);

Route::get("detalle/{id?},{sp?}", [AlumnoAPI::class, 'detalle']);