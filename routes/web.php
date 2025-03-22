<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('Login');
Route::post('/', [LoginController::class, 'login'])->name('Login_iniciar');

Route::middleware(['auth'])->group(function()
{

    Route::get('/home', [HomeController::class,'index'])->name('home');

});
