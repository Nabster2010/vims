@props(['reportData'])


<div class="report-page">
    <x-reports.shared.header :reportData="$reportData" />
    <main class="report-content">

        <x-reports.shared.photos :reportData="$reportData" />


    </main>
    <x-reports.shared.footer :reportData="$reportData" :page="'Page 7 of 7'" />
</div>
