<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
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
Route::get('/index-user', [UserController::class, 'index'])->name('users.index')->middleware('permission:index-user');
Route::get('/show-user/{user}', [UserController::class, 'show'])->name('users.show')->middleware('permission:show-user');
Route::get('/create-user', [UserController::class, 'create'])->name('users.create')->middleware('permission:create-user');
Route::post('/store-user', [UserController::class, 'store'])->name('users.store')->middleware('permission:create-user');
Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('users.edit')->middleware('permission:edit-user');
Route::get('/edit-password-user/{user}', [UserController::class, 'editPassword'])->name('users.edit-password')->middleware('permission:editPassword-user');
Route::put('/update-user/{user}', [UserController::class, 'update'])->name('users.update')->middleware('permission:edit-user');
Route::put('/update-password-user/{user}', [UserController::class, 'updatePassword'])->name('users.update-password')->middleware('permission:editPassword-user');
Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:destroy-user');


// Cursos
Route::get('/index-course', [CourseController::class, 'index'])->name('courses.index')->middleware('permission:index-course');
Route::get('/show-course/{course}', [CourseController::class, 'show'])->name('courses.show')->middleware('permission:show-course');
Route::get('/create-course', [CourseController::class, 'create'])->name('courses.create')->middleware('permission:create-course');
Route::post('/store-course', [CourseController::class, 'store'])->name('courses.store')->middleware('permission:create-course');
Route::get('/edit-course/{course}', [CourseController::class, 'edit'])->name('courses.edit')->middleware('permission:edit-course');
Route::put('/update-course/{course}', [CourseController::class, 'update'])->name('courses.update')->middleware('permission:edit-course');
Route::delete('/destroy-course/{course}', [CourseController::class, 'destroy'])->name('courses.destroy')->middleware('permission:destroy-course');

// Aulas

Route::get('/index-classe/{course}', [ClasseController::class, 'index'])->name('classes.index')->middleware('permission:index-classe');
Route::get('/show-classe/{classe}', [ClasseController::class, 'show'])->name('classes.show')->middleware('permission:show-classe');
Route::get('/create-classe/{course}', [ClasseController::class, 'create'])->name('classes.create')->middleware('permission:create-classe');
Route::post('/store-classe', [ClasseController::class, 'store'])->name('classes.store')->middleware('permission:create-classe');
Route::get('/edit-classe/{classe}', [ClasseController::class, 'edit'])->name('classes.edit')->middleware('permission:edit-classe');
Route::put('/update-classe/{classe}', [ClasseController::class, 'update'])->name('classes.update')->middleware('permission:edit-classe');
Route::delete('/destroy-classe/{classe}', [ClasseController::class, 'destroy'])->name('classes.destroy')->middleware('permission:destroy-classe');

// Roles
Route::get('/index-role', [RoleController::class, 'index'])->name('roles.index')->middleware('permission:index-role');
Route::post('/store-role', [RoleController::class, 'store'])->name('roles.store')->middleware('permission:store-role');
Route::put('/update-role/{role}', [RoleController::class, 'update'])->name('roles.update')->middleware('permission:update-role');
Route::delete('/destroy-role/{role}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('permission:destroy-role');

});