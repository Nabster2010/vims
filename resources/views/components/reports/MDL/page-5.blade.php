@props(['reportData'])

<div class="report-page">
    <x-reports.shared.header :reportData="$reportData" />
    <main class="report-content">
        <x-reports.IMP.visual-inspection-table :reportData="$reportData" />
    </main>
    <x-reports.shared.footer :reportData="$reportData" :page="'Page 5 of 7'" />
</div>
