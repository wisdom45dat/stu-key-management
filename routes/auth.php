<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Show login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Handle login submission
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Show registration form
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// Handle registration submission
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
