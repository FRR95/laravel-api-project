<?php

use App\Http\Controllers\RoomController;
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


// ROOMS ENDPOINTS

Route::get('/rooms',[RoomController::class, 'getAllRooms']);
Route::post('/rooms',[RoomController::class, 'createNewRoom']);
Route::put('/rooms/{id}',[RoomController::class, 'updateRoom']);
Route::delete('/rooms/{id}',[RoomController::class, 'deleteRoom']);