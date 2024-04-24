<?php

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


//Routes Auth

Route::post('/register', [AuthController::class, 'register']);
// Route::post('login', [UserController::class, 'login']);
// Route::middleware('auth:sanctum')->post('logout', [UserController::class, 'logout']);


