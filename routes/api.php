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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return "GET API";
});

Route::get('/roles', function () {
    return "GET ALL ROLES";
});
Route::post('/roles', function () {
    return "CREATE ALL ROLES";
});
Route::put('/roles/{id}', function ($id) {
    return "Update role".$id;
});
Route::delete('/roles/{id}', function ($id) {
    return "Delete role".$id;
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

//AUTH

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/me', [AuthController::class, 'getProfile'])->middleware('auth:sanctum');