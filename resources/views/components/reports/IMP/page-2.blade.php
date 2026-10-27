@props(['inspection'])

<div class="page">

    <x-reports.shared.header :inspection="$inspection" />
    <h2 class="mb-4 border-b pb-2 text-center text-xl font-bold">
        تقرير الفحص الظاهري / ملحق (2)
    </h2>

    <x-reports.IMP.visual-inspection-table :inspection="$inspection" />

    <x-reports.shared.footer :inspection="$inspection" />



</div>
