<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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

use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);




