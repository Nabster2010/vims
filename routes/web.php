<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::livewire(
        'inspections/create',
        'pages::inspections.create'
    )->name('inspections.create');


    Route::livewire('/customers/search', 'pages::customers.search')
        ->name('customers.search');
});




require __DIR__ . '/settings.php';
