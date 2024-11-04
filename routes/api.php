<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route::get('/admin', [AdminController::class, 'showUser']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin', [AdminController::class, 'showUsers'])->middleware(CheckRole::class . ':admin');
});

// Route::middleware('auth:sanctum', CheckRole::class . ':admin')->group(function () {
//     Route::get('/admin', function() {
//         return response()->json([
//             'message' => 'Wellcome Admin',
//             'data' => User::all()
//         ]);
//     });
// });
