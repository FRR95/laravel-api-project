<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\RoleController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return "GET ALL ROLES";
});
//Roles
Route::get('/roles', [RoleController::class, 'getAllRoles']); 
Route::post('/roles', [RoleController::class, 'createRole']); 
Route::put('/roles/{id}', [RoleController::class, 'updateRoleById']); 
Route::delete('/roles/{id}', [RoleController::class, 'deleteRoleById']); 
//Games
Route::get('/games', [GameController::class, 'getAllGames']); 
Route::post('/games', [GameController::class, 'createGame']); 
Route::put('/games/{id}', [GameController::class, 'updateGameById']); 
Route::delete('/games/{id}', [GameController::class, 'deleteGameById']); 
