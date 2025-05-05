<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class,'showForm'])
    ->name('contact.form');
Route::post('/contact',[ContactController::class,'submit'])
    ->name('contact.submit');

Route::get('/', [HomeController::class, 'index'])->name('pages.home.index');

Route::get('/team', function () {
    return view('pages.team.index');
})->name('team');
