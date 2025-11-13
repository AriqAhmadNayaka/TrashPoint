<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\VoucherController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::post('/users/take-out-trash/{id}', [UserController::class, 'takeOutTrash']);
Route::get('/users/history-take-out-trash/{id}', [UserController::class, 'historyTakeOutTrashes']);
Route::post('/users/redeem-vouchers/{id}', [UserController::class, 'redeem']);
Route::get('/users/history-vouchers/{id}', [UserController::class, 'historyVouchers']);

Route::get('/trash', [TrashController::class, 'index']);
Route::get('/trash/{id}', [TrashController::class, 'show']);
Route::post('/trash', [TrashController::class, 'store']);
Route::put('/trash/{id}', [TrashController::class, 'update']);
Route::delete('/trash/{id}', [TrashController::class, 'destroy']);
Route::post('/trash-schedule/create-trash-schedule', [TrashController::class, 'createTrashSchedule']);
Route::get('/trash-schedule/trash-schedules', [TrashController::class, 'getTrashSchedules']);
Route::post('/trash-schedule/add-detail-trash-schedule', [TrashController::class, 'addDetailTrashSchedule']);
Route::post('/trash-schedule/clean-trash/{id}', [TrashController::class, 'cleanTrash']);
Route::post('/trash-schedule/complete-trash-schedule/{id}', [TrashController::class, 'completeTrashSchedule']);

Route::get('/vouchers', [VoucherController::class, 'index']);
Route::get('/vouchers/{id}', [VoucherController::class, 'show']);
Route::post('/vouchers', [VoucherController::class, 'store']);
Route::put('/vouchers/{id}', [VoucherController::class, 'update']);
Route::delete('/vouchers/{id}', [VoucherController::class, 'destroy']);
