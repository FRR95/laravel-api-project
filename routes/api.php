<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RoomController;
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

Route::get('/', function () {
    return "GET ALL ROLES";
});

//Routes Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::delete('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'getProfile'])->middleware('auth:sanctum');

//USER CONTROLLER

Route::put('/me', [AuthController::class, 'updateProfile'])->middleware('auth:sanctum');
//Roles
Route::middleware(['auth:sanctum', 'superadmin'])->group(function () {
    Route::get('/roles', [RoleController::class, 'getAllRoles']); 
    Route::post('/roles', [RoleController::class, 'createRole']); 
    Route::put('/roles/{id}', [RoleController::class, 'updateRoleById']); 
    Route::delete('/roles/{id}', [RoleController::class, 'deleteRoleById']);
});

//Games
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/games', [GameController::class, 'getAllGames']); 
    Route::post('/games', [GameController::class, 'createGame'])->middleware('superadmin'); 
    Route::put('/games/{id}', [GameController::class, 'updateGameById'])->middleware('superadmin'); 
    Route::delete('/games/{id}', [GameController::class, 'deleteGameById'])->middleware('superadmin');
});

// CRUD ROOMS
Route::group([
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/rooms', [RoomController::class, 'getAllRooms']);
    Route::get('/rooms/{game}', [RoomController::class, 'getAllRoomsByGame']);
    Route::post('/rooms', [RoomController::class, 'createNewRoom']);
    Route::put('/rooms/{id}', [RoomController::class, 'updateRoom']);
    Route::delete('/rooms/{id}', [RoomController::class, 'deleteRoom']);
});

//Users_rooms
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/userroom/{id}', [UserRoomController::class, 'getAllUsersFromRoomId']); 
    Route::post('/userroom', [UserRoomController::class, 'joinRoom']);
    Route::delete('/userroom/{id}', [UserRoomController::class, 'leaveRoomById']);
});

//CRUD MESSAGES
Route::group([
    'middleware' => ['auth:sanctum']
], function () {
Route::post('/messages', [MessageController::class, 'createMessage']);
Route::get('/messages/room/{id}', [MessageController::class, 'getAllMessagesFromRoomById']);
Route::put('/messages/{id}', [MessageController::class, 'updateMessageById']);
Route::delete('/messages/{id}', [MessageController::class, 'deleteMessageById']);
});
