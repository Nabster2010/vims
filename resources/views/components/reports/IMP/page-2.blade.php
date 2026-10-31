@props(['inspection'])


<div class="report-page">
    <x-reports.shared.header :inspection="$inspection" />
    <main class="report-content">

        <x-reports.IMP.visual-inspection-table :inspection="$inspection" />

    </main>
    <x-reports.shared.footer :inspection="$inspection" :page="'Page 1 of 3'" />
</div>
