<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('auth');
Route::get('/impersonate/{userId}', [UserController::class, 'impersonate'])->name('impersonate')->middleware('auth');
Route::patch('/notification/{id}', [NotificationController::class, 'changeStatus'])->middleware('auth');
Route::post('/notifications', [UserController::class, 'notifications']);
Route::get('/settings', [UserController::class, 'settings'])->name('settings')->middleware('auth');
Route::post('/settings/{id}', [UserController::class, 'saveSettings'])->middleware('auth');
;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
