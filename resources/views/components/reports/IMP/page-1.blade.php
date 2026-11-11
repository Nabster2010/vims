<div class="report-page">
    <x-reports.shared.header :reportData="$reportData" />
    <main class="report-content">
        <x-reports.shared.vin :reportData="$reportData" />
        <x-reports.IMP.vehicle-information :reportData="$reportData" />
        <x-reports.IMP.basic-requirements :reportData="$reportData" />
        <x-reports.shared.inspection-result :reportData="$reportData" />
        <x-reports.shared.remarks :reportData="$reportData" />
        <x-reports.shared.signature :reportData="$reportData" />
    </main>
    <x-reports.shared.footer :reportData="$reportData" :page="'Page 1 of 4'" />
</div>
