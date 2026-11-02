@props(['reportData'])

<div class="report-page">

    <x-reports.shared.header :reportData="$reportData" />
    <main class="report-content">
        <x-reports.IMP.technical-inspection-table :reportData="$reportData" />

    </main>
    <x-reports.shared.footer :reportData="$reportData" :page="'Page 6 of 7'" />
</div>
