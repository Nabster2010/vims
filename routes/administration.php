<?php

use Illuminate\Support\Facades\Route;

Route::prefix('administration')->name('administration.')->group(function () {

    Route::livewire(

        // inspection-types
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

    // branches-----------------

    Route::livewire(

        '/branches',

        'pages::administration.branches.index'

    )->name('branches.index');

    Route::livewire(

        '/branches/create',

        'pages::administration.branches.create'

    )->name('branches.create');

    Route::livewire(

        '/branches/{branch}/edit',

        'pages::administration.branches.edit'

    )->name('branches.edit');



    // category--------


    Route::livewire(
        '/categories',
        'pages::administration.categories.index'
    )->name('categories.index');

    Route::livewire(
        '/categories/create',
        'pages::administration.categories.create'
    )->name('categories.create');

    Route::livewire(
        '/categories/{category}/edit',
        'pages::administration.categories.edit'
    )->name('categories.edit');
});
