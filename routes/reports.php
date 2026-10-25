<?php

use Illuminate\Support\Facades\Route;


Route::prefix('reports')
    ->name('reports.')
    ->group(function () {

        Route::livewire('/{inspection}', 'pages::reports.show')
            ->name('reports.show');
        Route::livewire('/{inspection}/pdf', function ($inspection) {
            //
        })->name('pdf.report');
    });
