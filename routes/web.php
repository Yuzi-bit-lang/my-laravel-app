<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('articles.index');
});

Route::resource('articles', ArticleController::class);
Route::get('/listearticles', [ArticleController::class, 'liste'])->name('listearticles');
Route::get('articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/articles/{id}/pdf', [ArticleController::class, 'generatePDF'])->name('articles.pdf');
