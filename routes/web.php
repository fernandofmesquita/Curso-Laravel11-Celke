<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/index-dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

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