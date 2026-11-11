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

    // VisualItems--------

    Route::livewire(
        '/visual-items',
        'pages::administration.visual-items.index'
    )->name('visual-items.index');

    Route::livewire(
        '/visual-items/create',
        'pages::administration.visual-items.create'
    )->name('visual-items.create');

    Route::livewire(
        '/visual-items/{visualItem}/edit',
        'pages::administration.visual-items.edit'
    )->name('visual-items.edit');

    // --------colors--------

    Route::livewire(
        '/colors',
        'pages::administration.colors.index'
    )->name('colors.index');

    Route::livewire(
        '/colors/create',
        'pages::administration.colors.create'
    )->name('colors.create');

    Route::livewire(
        '/colors/{color}/edit',
        'pages::administration.colors.edit'
    )->name('colors.edit');

    // -----SalesRepresentative---------

    Route::livewire(
        '/sales-representatives',
        'pages::administration.sales-representatives.index'
    )->name('sales-representatives.index');

    Route::livewire(
        '/sales-representatives/create',
        'pages::administration.sales-representatives.create'
    )->name('sales-representatives.create');

    Route::livewire(
        '/sales-representatives/{salesRepresentative}/edit',
        'pages::administration.sales-representatives.edit'
    )->name('sales-representatives.edit');

    // --------countries ------------

    Route::livewire(
        '/countries',
        'pages::administration.countries.index'
    )->name('countries.index');

    Route::livewire(
        '/countries/create',
        'pages::administration.countries.create'
    )->name('countries.create');

    Route::livewire(
        '/countries/{country}/edit',
        'pages::administration.countries.edit'
    )->name('countries.edit');

    // -------manufacturers--------
    Route::livewire(
        '/manufacturers',
        'pages::administration.manufacturers.index'
    )->name('manufacturers.index');

    Route::livewire(
        '/manufacturers/create',
        'pages::administration.manufacturers.create'
    )->name('manufacturers.create');

    Route::livewire(
        '/manufacturers/{manufacturer}/edit',
        'pages::administration.manufacturers.edit'
    )->name('manufacturers.edit');

    // --------modelTypes---------
    Route::livewire(
        '/model-types',
        'pages::administration.model-types.index'
    )->name('model-types.index');

    Route::livewire(
        '/model-types/create',
        'pages::administration.model-types.create'
    )->name('model-types.create');

    Route::livewire(
        '/model-types/{modelType}/edit',
        'pages::administration.model-types.edit'
    )->name('model-types.edit');

    // ---------Custom Ports --------

    Route::livewire(
        '/custom-ports',
        'pages::administration.custom-ports.index'
    )->name('custom-ports.index');

    Route::livewire(
        '/custom-ports/create',
        'pages::administration.custom-ports.create'
    )->name('custom-ports.create');

    Route::livewire(
        '/custom-ports/{customPort}/edit',
        'pages::administration.custom-ports.edit'
    )->name('custom-ports.edit');
});
