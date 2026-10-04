<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Inspections\Create;

Route::view('/', 'welcome')->name('home');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::livewire(
    'inspections/create',
    Create::class
)->name('inspections.create');

});

require __DIR__.'/settings.php';
