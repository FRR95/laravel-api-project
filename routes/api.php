<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
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


//CRUD MESSAGES
Route::group([
    'middleware' => ['auth:sanctum']
], function () {
Route::post('/messages', [MessageController::class, 'createMessage']);
Route::get('/messages/room/{id}', [MessageController::class, 'getAllMessagesFromRoomById']);
Route::put('/messages/{id}', [MessageController::class, 'updateMessageById']);
Route::delete('/messages/{id}', [MessageController::class, 'deleteMessageById']);
});

