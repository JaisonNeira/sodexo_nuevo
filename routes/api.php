<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\loginController;
use App\Http\Controllers\API\RespuestaController;

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

Route::post('/login', [loginController::class, 'login'])->name('auth.login');

Route::post('/post/respuesta', [RespuestaController::class, 'post_respuesta'])->name('post.respuesta');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
