<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\QRController;



// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/user/groupbypoint', [App\Http\Controllers\UsersController::class, 'getUsersGroupedByPoint']);
Route::get('/userlist', [App\Http\Controllers\UsersController::class, 'index']);
Route::post('/createuser', [App\Http\Controllers\UsersController::class, 'store']);
Route::get('/user/{id}', [App\Http\Controllers\UsersController::class, 'show']);
Route::put('/updateuser/{id}', [App\Http\Controllers\UsersController::class, 'update']);
Route::delete('/deleteuser/{id}', [App\Http\Controllers\UsersController::class, 'destroy']);