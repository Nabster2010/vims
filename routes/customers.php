<?php

use Illuminate\Support\Facades\Route;

Route::prefix('customers')
    ->name('customers.')
    ->group(function () {

        Route::livewire('/', 'pages::customers.index')
            ->name('index');

        Route::livewire('/create', 'pages::customers.create')
            ->name('create');

        Route::livewire('/search', 'pages::customers.search')
            ->name('search');

        Route::livewire('/{customer}/edit', 'pages::customers.edit')
            ->name('edit');
    });
