<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;

use function Pest\Laravel\json;


Route::get('/', [HomeController::class, 'landing'])->name('landing');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('auth.loginProcess');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'registerProcess'])->name('auth.registerProcess');
Route::post('/verify/resend', [AuthController::class, 'verifyResend'])->name('auth.verifyResend');
Route::get('/verify/{id}', [AuthController::class, 'verify'])->name('auth.verify');
Route::post('/verify/{id}', [AuthController::class, 'verifyProcess'])->name('auth.verifyProcess');
Route::get('/forgot-password', [AuthController::class, 'forgot'])->name('auth.forgot');
Route::post('/forgot-password', [AuthController::class, 'forgotProcess'])->name('auth.forgotProcess');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/logout', [AuthController::class, 'logoutGet']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/user', [UserController::class, 'index'])->name('user');

    Route::post('/profile/{id}', [AuthController::class, 'changePassProcess'])->name('profile.update');

    Route::prefix('book')->group(function() {
        Route::get('/', [BookController::class, 'index'])->name('book');
        Route::get('/{id}', [BookController::class, 'show'])->name('book.show');
        Route::get('/create', [BookController::class, 'create'])->name('book.create');
        Route::post('/create', [BookController::class, 'store'])->name('book.store');
        Route::get('/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
        Route::post('/edit/{id}', [BookController::class, 'update'])->name('book.update');
        Route::post('/delete/{id}', [BookController::class, 'destroy'])->name('book.destroy');
    });
});
