<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/users', [UserController::class, 'index'])->name('users')->middleware('auth');
Route::get('/impersonate/{userId}', [UserController::class, 'impersonate']);
Route::post('/notifications', [UserController::class, 'notifications']);
Route::get('/settings', [UserController::class, 'settings']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
