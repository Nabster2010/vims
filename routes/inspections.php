<?php

use Illuminate\Support\Facades\Route;

Route::prefix('inspections')
    ->name('inspections.')
    ->group(function () {

        Route::livewire('/', 'pages::inspections.index')
            ->name('index');

        Route::livewire('/create', 'pages::inspections.create')
            ->name('create');

        Route::livewire('/{inspection}', 'pages::inspections.show')
            ->name('show');

        Route::livewire('/{inspection}/edit', 'pages::inspections.edit')
            ->name('edit');

        Route::livewire(
            '/{inspection}/vehicle-information',
            'pages::inspections.vehicle-information.edit'
        )->name('vehicle-information.edit');
        Route::livewire(
            '/{inspection}/emission-inspection',
            'pages::inspections.emission-inspection.edit'
        )->name('emission-inspection.edit');
        Route::livewire(
            '/{inspection}/head-light',
            'pages::inspections.head-light.edit'
        )->name('head-light.edit');
    });
