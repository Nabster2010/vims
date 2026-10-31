<?php
// resources/views/pages/reports/⚡show.blade.php
use App\Models\Inspection;
use Livewire\Component;
use App\Services\Reports\ImportedVehicleReportService;
use App\Services\Reports\ModifiedVehicleReportService;
use App\Services\Reports\SaberVehicleReportService;
use App\Services\Reports\MotorcycleReportService;
use App\Services\Reports\TrailerReportService;
use Spatie\LaravelPdf\Facades\Pdf;

new class extends Component {
    public Inspection $inspection;

    public $report = [];

    public function mount(Inspection $inspection): void
    {
        $this->inspection = $inspection;
        $this->report = match ($inspection->inspectionType->code) {
            'IMP' => app(ImportedVehicleReportService::class)->build($inspection),
            'SBG' => app(SaberVehicleReportService::class)->build($inspection),
            // 'SBE' => app(ImportedVehicleReportService::class)->build($inspection),
            'MDL' => app(ModifiedVehicleReportService::class)->build($inspection),
            'MDH' => app(ModifiedVehicleReportService::class)->build($inspection),
            'MTC' => app(MotorcycleReportService::class)->build($inspection),
            'TRL' => app(TrailerReportService::class)->build($inspection),
            default => abort(404),
        };
    }
};

?>

<x-ui.page>

    <x-reports.sections.vehicle-information :inspection="$inspection" />

    {{-- @switch($inspection->inspectionType->code)
        @case('IMP')
            <x-reports.IMP.imported-vehicle :inspection="$inspection" />
        @break

        @case('MDL')
            <x-reports.MDL.modified-vehicle-light :inspection="$inspection" :report="$report" />
        @break

        @case('MDH')
            <x-reports.MDH.modified-vehicle-heavy :inspection="$inspection" :report="$report" />
        @break

        @case('SBG')
            <x-reports.IMP.imported-vehicle :inspection="$inspection" :report="$report" />
            <x-reports.SABER.saber-info :inspection="$inspection" :report="$report" />
        @break

        @default
            <div class="rounded-lg border border-red-200 bg-red-50 p-6">
                Report template not implemented.
            </div>
    @endswitch --}}

    <flux:button href="{{ route('reports.pdf', $inspection) }}" target="_blank" variant="primary">

        Download PDF

    </flux:button>
</x-ui.page>
