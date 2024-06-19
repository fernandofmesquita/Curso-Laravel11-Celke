<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Inicio das Rotas Publicas
//Login
Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'loginProcess'])->name('login.process');
Route::get('/logout', [LoginController::class, 'destroy'])->name('login.destroy');
Route::get('/create-login', [LoginController::class, 'create'])->name('login.create');
Route::post('/store-login', [LoginController::class, 'store'])->name('login.store');

// Recuperar Senha
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPassword'])->name('forgot-password.show');
Route::post('/forgot-password', [ForgotPasswordController::class, 'submitForgotPassword'])->name('forgot-password.submint');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPassword'])->name('reset-password.submit');


//Inicio das  Rotas Privadas
Route::group(['middleware' => 'auth'], function(){

// Dashboard
Route::get('/index-dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Perfil
Route::get('/show-profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::get('/edit-password-profile', [ProfileController::class, 'editPassword'])->name('profile.edit-password');
Route::put('/update-profile', [ProfileController::class, 'update'])->name('profile.update');
Route::put('/update-password-profile', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

// Usuário
Route::get('/index-user', [UserController::class, 'index'])->name('users.index');
Route::get('/show-user/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/create-user', [UserController::class, 'create'])->name('users.create');
Route::post('/store-user', [UserController::class, 'store'])->name('users.store');
Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('users.edit');
Route::get('/edit-password-user/{user}', [UserController::class, 'editPassword'])->name('users.edit-password');
Route::put('/update-user/{user}', [UserController::class, 'update'])->name('users.update');
Route::put('/update-password-user/{user}', [UserController::class, 'updatePassword'])->name('users.update-password');
Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('users.destroy');


// Cursos
Route::get('/index-course', [CourseController::class, 'index'])->name('courses.index');
Route::get('/show-course/{course}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/create-course', [CourseController::class, 'create'])->name('courses.create');
Route::post('/store-course', [CourseController::class, 'store'])->name('courses.store');
Route::get('/edit-course/{course}', [CourseController::class, 'edit'])->name('courses.edit');
Route::put('/update-course/{course}', [CourseController::class, 'update'])->name('courses.update');
Route::delete('/destroy-course/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

// Aulas

Route::get('/index-classe/{course}', [ClasseController::class, 'index'])->name('classes.index');
Route::get('/show-classe/{classe}', [ClasseController::class, 'show'])->name('classes.show');
Route::get('/create-classe/{course}', [ClasseController::class, 'create'])->name('classes.create');
Route::post('/store-classe', [ClasseController::class, 'store'])->name('classes.store');
Route::get('/edit-classe/{classe}', [ClasseController::class, 'edit'])->name('classes.edit');
Route::put('/update-classe/{classe}', [ClasseController::class, 'update'])->name('classes.update');
Route::delete('/destroy-classe/{classe}', [ClasseController::class, 'destroy'])->name('classes.destroy');

});