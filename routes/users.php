<?php

use Illuminate\Support\Facades\Route;

Route::prefix('users')
    ->name('users.')
    ->group(function () {

        Route::livewire('/', 'pages::users.index')
            ->name('index');

        Route::livewire('/create', 'pages::users.create')
            ->name('create');

        Route::livewire('/{user}/edit', 'pages::users.edit')
            ->name('edit');
    });
