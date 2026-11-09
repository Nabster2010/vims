<?php

use Illuminate\Support\Facades\Route;

// Route::view('/dashboard', 'dashboard')
//     ->name('dashboard');


Route::prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {

        Route::livewire('/', 'pages::dashboard.index')
            ->name('index');
    });
