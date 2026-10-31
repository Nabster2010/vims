<?php
// reports.php - Reports routes

use App\Http\Controllers\ReportPdfController;

use Illuminate\Support\Facades\Route;

Route::prefix('reports')
    ->name('reports.')
    ->group(function () {
        Route::livewire('/{inspection}', 'pages::reports.show')
            ->name('show');
        Route::get('/{inspection}/pdf', ReportPdfController::class)
            ->name('pdf');
    });
