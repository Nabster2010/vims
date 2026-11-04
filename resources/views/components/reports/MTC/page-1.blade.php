@props(['reportData'])


<div class="report-page">
    <x-reports.shared.header :reportData="$reportData" />
    <main class="report-content">
        <x-reports.shared.vin :reportData="$reportData" />
        <x-reports.MTC.motorcycle-information :reportData="$reportData" />
        <x-reports.MTC.basic-requirements :reportData="$reportData" />
        <x-reports.shared.inspection-result :reportData="$reportData" />
        <x-reports.shared.remarks :reportData="$reportData" />
        <x-reports.shared.signature :reportData="$reportData" />
    </main>
    <x-reports.shared.footer :reportData="$reportData" :page="'Page 1 of 3'" />
</div>
