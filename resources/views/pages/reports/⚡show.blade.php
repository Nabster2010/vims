<?php

use App\Models\Inspection;
use Livewire\Component;
use App\Services\Reports\ImportedVehicleReportService;
use App\Services\Reports\SaberVehicleReportService;

new class extends Component {
    public Inspection $inspection;

    public array $report = [];

    public function mount(Inspection $inspection): void
    {
        $this->inspection = $inspection;
        $this->reprt = match ($inspection->inspectionType->code) {
            'IMP' => app(ImportedVehicleReportService::class)->build($inspection),
            'SBG' => app(SaberVehicleReportService::class)->build($inspection),
            'SBE' => app(SaberVehicleReportService::class)->build($inspection),
            'MDL' => app(SaberVehicleReportService::class)->build($inspection),
            'MDH' => app(SaberVehicleReportService::class)->build($inspection),
            'MTC' => app(SaberVehicleReportService::class)->build($inspection),
            default => abort(404),
        };
    }
};

?>

<x-ui.page>

    @switch($inspection->inspectionType->code)
        @case('IMP')
            <x-reports.imported-vehicle :inspection="$inspection" :report="$report" />
        @break

        @default
            <div class="rounded-lg border border-red-200 bg-red-50 p-6">
                Report template not implemented.
            </div>
    @endswitch

</x-ui.page>
