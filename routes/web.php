<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\FinancialRecordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('tasks', TaskController::class);
Route::resource('financial-records', FinancialRecordController::class);

// Profile routes
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

// Global Search
Route::get('/search', [SearchController::class, 'index'])->name('search.index');
