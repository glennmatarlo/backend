<?php

use App\Http\Controllers\BorrowedbooksController;
use App\Http\Controllers\AuthController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware'=>'auth:api'], function(){
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout',[AuthController::class, 'logout']);

    Route::post('/borrowedbooks/search', [BorrowedbooksController::class, 'search']);
    Route::post('/borrowedbooks', [BorrowedbooksController::class, 'store']);
    Route::get('/borrowedbooks', [BorrowedbooksController::class, 'index']);
    Route::get('/borrowedbooks/{borrowedbook}', [BorrowedbooksController::class, 'show']);
    Route::put('/borrowedbooks/{borrowedbook}', [BorrowedbooksController::class, 'update']);
    Route::delete('/borrowedbooks/{borrowedbook}', [BorrowedbooksController::class, 'destroy']);
});
