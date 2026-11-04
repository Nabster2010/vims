<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Services\Reports\IMPReportService;
use App\Services\Reports\MDHReportService;
use App\Services\Reports\MDLReportService;
use App\Services\Reports\MTCReportService;
use App\Services\Reports\SaberReportService;
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
            'IMP' => app(IMPReportService::class)->build($inspection),
            'SBG' => app(SaberReportService::class)->build($inspection),
            'SBE' => app(SaberReportService::class)->build($inspection),
            'MDL' => app(MDLReportService::class)->build($inspection),
            'MDH' => app(MDHReportService::class)->build($inspection),
            'MTC' => app(MTCReportService::class)->build($inspection),
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
