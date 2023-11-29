<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

Route::get('/', [Controller::class, 'index'])->name('home');
Route::post('/form-submit', [Controller::class, 'store'])->name('form.submit');
Route::post('/quiz-submit', [Controller::class, 'submit'])->name('quiz.submit');
Route::get('/search-history', [Controller::class, 'show'])->name('search.history');
