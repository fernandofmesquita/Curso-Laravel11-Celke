<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Cursos
Route::get('/index-course', [CourseController::class, 'index'])->name('courses.index');
Route::get('/show-course', [CourseController::class, 'show'])->name('courses.show');
Route::get('/create-course', [CourseController::class, 'create'])->name('courses.create');
Route::post('/store-course', [CourseController::class, 'store'])->name('courses.store');
Route::get('/edit-course', [CourseController::class, 'edit'])->name('courses.edit');
Route::put('/update-course', [CourseController::class, 'update'])->name('courses.update');
Route::delete('/destroy-course', [CourseController::class, 'destroy'])->name('courses.destroy');

