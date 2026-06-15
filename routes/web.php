<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/search', [\App\Http\Controllers\HomeController::class, 'search'])->name('search');
Route::get('/browse', [\App\Http\Controllers\HomeController::class, 'browse'])->name('browse');

Route::get('/novel/{novel}', [\App\Http\Controllers\NovelController::class, 'show'])->name('novels.show');
Route::get('/novel/{novel}/chapter/{chapter}', [\App\Http\Controllers\ChapterController::class, 'show'])->name('chapters.show');

Route::middleware('auth')->group(function () {
    Route::get('/history', [\App\Http\Controllers\MemberController::class, 'history'])->name('member.history');
    Route::get('/bookmarks', [\App\Http\Controllers\MemberController::class, 'bookmarks'])->name('member.bookmarks');
    Route::post('/novel/{novel}/bookmark', [\App\Http\Controllers\MemberController::class, 'toggleBookmark'])->name('novels.bookmark');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::match(['get', 'post'], '/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('novels', App\Http\Controllers\Admin\NovelController::class);
    Route::resource('chapters', App\Http\Controllers\Admin\ChapterController::class);
});
