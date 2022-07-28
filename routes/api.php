<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BabiesController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\PartnersController;
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

//Partners
Route::get('/partner/{parent_id}', [PartnersController::class, 'show']);
Route::post('/partner/add', [PartnersController::class, 'store']);

//Parent
Route::post('/parent/add', [ParentsController::class, 'store']);

//Babies
Route::post('/baby/add', [BabiesController::class, 'store']);
Route::get('/baby', [BabiesController::class, 'show']);
Route::get('/baby/showAll', [BabiesController::class, 'showAll']);
Route::post('/baby/delete/{id}', [BabiesController::class, 'delete']);
Route::post('/baby/edit/{id}', [BabiesController::class, 'edit']);
