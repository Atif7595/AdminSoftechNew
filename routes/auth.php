<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;


Route::get('/',[AuthController::class,'getLogin'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('loginPost');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('/verify-code/{id}',[AuthController::class,'verifyCode'])->name('verification.code.form');
Route::get('/cofirm-code',[AuthController::class,'confirmCode'])->name('confirmCode.code');

