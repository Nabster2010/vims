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
            '/{inspection}/head-light-inspection',
            'pages::inspections.head-light-inspection.edit'
        )->name('head-light-inspection.edit');
        Route::livewire(
            '/{inspection}/side-slip-inspection',
            'pages::inspections.side-slip-inspection.edit'
        )->name('side-slip-inspection.edit');
        Route::livewire(
            '/{inspection}/suspension-inspection',
            'pages::inspections.suspension-inspection.edit'
        )->name('suspension-inspection.edit');
        Route::livewire(
            '/{inspection}/brake-inspection',
            'pages::inspections.brake-inspection.edit'
        )->name('brake-inspection.edit');
        Route::livewire(
            '/{inspection}/visual-inspection',
            'pages::inspections.visual-inspection.edit'
        )->name('visual-inspection.edit');
        Route::livewire(
            '/{inspection}/photos',
            'pages::inspections.photos.edit'
        )->name('photos.edit');
    });
