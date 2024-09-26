<?php

use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

include 'auth.php';

Route::middleware('auth')->group(function(){
    route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
});


