<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/formulaire', [FormController::class, 'index'])->name('formulaire');
Route::get('/table', [TableController::class, 'index'])->name('table');
