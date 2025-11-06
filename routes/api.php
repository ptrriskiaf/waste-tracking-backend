<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PengangkutanController;
use App\Http\Controllers\Jasa_PengangkutanController;
use App\Http\Controllers\Lokasi_kendaraanController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('perusahaan', PerusahaanController::class);
Route::apiResource('kendaraan', KendaraanController::class);
Route::apiResource('pengangkutan', PengangkutanController::class);
Route::apiResource('jasa-pengangkutan', Jasa_PengangkutanController::class);
Route::apiResource('lokasi-kendaraan', Lokasi_kendaraanController::class);
