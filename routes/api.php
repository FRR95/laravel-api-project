<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserRoomController;
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
Route::middleware(['auth:sanctum', 'isSuperAdmin'])->group(function () {
    Route::get('/roles', [RoleController::class, 'getAllRoles'])->middleware('isSuperAdmin'); 
    Route::post('/roles', [RoleController::class, 'createRole'])->middleware('isSuperAdmin'); 
    Route::put('/roles/{id}', [RoleController::class, 'updateRoleById'])->middleware('isSuperAdmin'); 
    Route::delete('/roles/{id}', [RoleController::class, 'deleteRoleById'])->middleware('isSuperAdmin');
});
//Games
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/games', [GameController::class, 'getAllGames']); 
    Route::post('/games', [GameController::class, 'createGame'])->middleware('isSuperAdmin'); 
    Route::put('/games/{id}', [GameController::class, 'updateGameById'])->middleware('isSuperAdmin'); 
    Route::delete('/games/{id}', [GameController::class, 'deleteGameById'])->middleware('isSuperAdmin');
});
//Users_rooms
Route::middleware(['auth:sanctum', 'isSuperAdmin'])->group(function () {
    Route::get('/userroom/{id}', [UserRoomController::class, 'getAllUsersFromRoomId']); 
    Route::post('/userroom', [UserRoomController::class, 'joinRoom']);
    Route::delete('/userroom/{id}', [UserRoomController::class, 'leaveRoomById']);
});