<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/get-csrf-token', function () {
    return csrf_token();
});

// Route::get('/Api/users', [UserController::class, 'index']);
// Route::get('/Api/users/{id}', [UserController::class, 'show']);
// Route::post('/Api/users', [UserController::class, 'store']);
// Route::put('/Api/users/{id}', [UserController::class, 'update']);
// Route::delete('/Api/users/{id}', [UserController::class, 'destroy']);
