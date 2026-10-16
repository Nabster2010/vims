<?php

use Illuminate\Support\Facades\Route;

Route::prefix('administration')->name('administration.')->group(function () {

    Route::livewire(
        '/inspection-types',
        'pages::administration.inspection-types.index'
    )->name('inspection-types.index');

    Route::livewire(
        '/inspection-types/create',
        'pages::administration.inspection-types.create'
    )->name('inspection-types.create');

    Route::livewire(
        '/inspection-types/{inspectionType}/edit',
        'pages::administration.inspection-types.edit'
    )->name('inspection-types.edit');
    Route::livewire(
        '/inspection-types/{inspectionType}/visual-items',
        'pages::administration.inspection-types.visual-items'
    )->name('inspection-types.visual-items');
});
