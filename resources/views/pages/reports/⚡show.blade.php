<?php
// resources/views/pages/reports/⚡show.blade.php
use App\Models\Inspection;
use Livewire\Component;
use App\Services\Reports\IMPReportService;
use App\Services\Reports\MDLReportService;
use App\Services\Reports\MDHReportService;
use App\Services\Reports\SaberReportService;
use App\Services\Reports\MTCReportService;
use App\Services\Reports\TRLReportService;
use Spatie\LaravelPdf\Facades\Pdf;

new class extends Component {
    public Inspection $inspection;

    public function getReportDataProperty(): array
    {
        return match ($this->inspection->inspectionType->code) {
            'IMP' => app(IMPReportService::class)->build($this->inspection),
            'SBR' => app(SaberReportService::class)->build($this->inspection),
            'MDL' => app(MDLReportService::class)->build($this->inspection),
            'MDH' => app(MDHReportService::class)->build($this->inspection),
            'MTC' => app(MTCReportService::class)->build($this->inspection),
            'TRL' => app(TRLReportService::class)->build($this->inspection),
        };
    }
};

?>

<x-ui.page>

    <x-reports.sections.vehicle-information :reportData="$this->reportData" />

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
    @can('printReport', $inspection)
        <flux:button href="{{ route('reports.pdf', $inspection) }}" target="_blank" variant="primary">
            Download PDF
        </flux:button>
    @endcan
</x-ui.page>
