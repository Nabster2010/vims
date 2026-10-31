@props(['inspection'])

<div class="report-page">

    <x-reports.shared.header :inspection="$inspection" />
    <main class="report-content">
        <x-reports.MDH.technical-requirements-table :inspection="$inspection" />
    </main>
    <x-reports.shared.footer :inspection="$inspection" :page="'Page 2 of 3'" />



</div>
