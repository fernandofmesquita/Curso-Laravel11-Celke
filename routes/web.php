<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//Login
Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'loginProcess'])->name('login.process');

// Dashboard
Route::get('/index-dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

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