<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CreateController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/contact', function() {
    $mail = 'irsan@gmail.com';
    return view('contact', [
    'mail' => $mail
        ]);
})->name('profile');

Route::get('products/{id}', function(string $id) {
    return view('products', [
        'id' => $id
    ]);
})->name('products');

Route::get('about-us/{section}', [App\Http\Controllers\AboutUsController::class, 'show']);

Route::get('products', [App\Http\Controllers\ProductController::class, 'index']);


Route::get('puzzles', [App\Http\Controllers\PuzzleController::class, 'index']) ->name('puzzles.index') -> middleware('auth');

Route::get('create', [App\Http\Controllers\CreateController::class, 'index']) ->name('create') -> middleware('auth');


Route::get('/comments', [CommentController::class, 'index']);


