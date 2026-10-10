<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::livewire(
        'inspections/create',
        'pages::inspections.create'
    )->name('inspections.create');
    Route::livewire(
        'inspections',
        'pages::inspections.index'
    )->name('inspections.index');
    Route::livewire(
        'inspections/{inspection}/edit',
        'pages::inspections.edit'
    )->name('inspections.edit');

    Route::livewire(
        'inspections/{inspection}',
        'pages::inspections.show'
    )->name('inspections.show');


    Route::livewire('customers/search', 'pages::customers.search')
        ->name('customers.search');
    Route::livewire('customers/create', 'pages::customers.create')
        ->name('customers.create');
    Route::livewire('customers', 'pages::customers.index')
        ->name('customers.index');
    Route::livewire('customers/{customer}/edit', 'pages::customers.edit')
        ->name('customers.edit');
});

require __DIR__ . '/settings.php';
