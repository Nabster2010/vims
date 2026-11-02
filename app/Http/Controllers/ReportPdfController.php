<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Services\Reports\ImportedVehicleReportService;
use App\Services\Reports\ModifiedVehicleReportService;
use App\Services\Reports\MotorcycleReportService;
use App\Services\Reports\SaberVehicleReportService;
use App\Services\Reports\TrailerReportService;
use Spatie\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Facades\Gate;

class ReportPdfController
{
    public function __invoke(Inspection $inspection)
    {
        Gate::authorize('viewReport', $inspection);

        // we will use it to return inspection type specific data to report
        $reportDate = match ($inspection->inspectionType->code) {
            'IMP' => app(ImportedVehicleReportService::class)->build($inspection),
            'SBG' => app(SaberVehicleReportService::class)->build($inspection),
            'SBE' => app(SaberVehicleReportService::class)->build($inspection),
            'MDL' => app(ModifiedVehicleReportService::class)->build($inspection),
            'MDH' => app(ModifiedVehicleReportService::class)->build($inspection),
            'MTC' => app(MotorcycleReportService::class)->build($inspection),
            'TRL' => app(TrailerReportService::class)->build($inspection),
            default => abort(404),
        };

        return Pdf::view('reports.pdf', [
            'reportData' => $reportDate,
        ])
            ->format('A4')
            ->margins(0, 0, 0, 0)->name("{$inspection->reportNo}.pdf");
    }
}
