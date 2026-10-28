{{-- ========================================= --}}
{{-- Vehicle Information --}}
{{-- ========================================= --}}

<div dir="rtl" class="mt-6 grid grid-cols-[2fr_1fr] gap-2">

    {{-- ================= Right Table ================= --}}
    <table class="w-full table-fixed border border-gray-400 border-collapse text-sm">
        <tr>
            <td class="w-40 border border-gray-400 px-3 py-2 font-semibold">مكان الفحص</td>
            <td class="border border-gray-400 px-3 py-2">{{ $inspection->branch->name_ar }}</td>
        </tr>

        <tr>
            <td class="border border-gray-400 px-3 py-2 font-semibold">جهة طلب الفحص</td>
            <td class="border border-gray-400 px-3 py-2">{{ $inspection->customPort->name_ar }}</td>
        </tr>

        <tr>
            <td class="border border-gray-400 px-3 py-2 font-semibold">تاريخ الفحص</td>
            <td class="border border-gray-400 px-3 py-2">
                {{ app(\App\Services\DateService::class)->gregorian($inspection->created_at) }} </td>
        </tr>

        <tr>
            <td class="border border-gray-400 px-3 py-2 font-semibold">رقم بيان الاستيراد</td>
            <td class="border border-gray-400 px-3 py-2">
                {{ $inspection->custom_declaration_no }}</td>
        </tr>

        <tr>
            <td class="border border-gray-400 px-3 py-2 font-semibold">تاريخ بيان الاستيراد</td>
            <td class="border border-gray-400 px-3 py-2">
                {{ app(\App\Services\DateService::class)->hijri($inspection->custom_declaration_date) }}</td>
        </tr>

        <tr>
            <td class="border border-gray-400 px-3 py-2 font-semibold">رقم الاحالة</td>
            <td class="border border-gray-400 px-3 py-2">{{ $inspection->request_no }}</td>
        </tr>

        <tr>
            <td class="border border-gray-400 px-3 py-2 font-semibold">اسم المستورد</td>
            <td class="border border-gray-400 px-3 py-2">{{ $inspection->customer->name }}</td>
        </tr>

    </table>

    {{-- ================= Left Table ================= --}}


    <table class="w-full table-fixed border border-gray-400 border-collapse text-sm">



        <tr>
            <td class="w-40 border border-gray-400 px-3 py-2 font-semibold">عدد الركاب</td>
            <td class="border border-gray-400 px-3 py-2">{{ $inspection->vehicleInformation->number_of_seats }}</td>
        </tr>

        <tr>
            <td class="border border-gray-400 px-3 py-2 font-semibold">قراءة العداد</td>
            <td class="border border-gray-400 px-3 py-2">{{ $inspection->vehicleInformation->mileage }}</td>
        </tr>

        <tr>
            <td class="border border-gray-400 px-3 py-2 font-semibold"> نوع المركبة</td>
            <td class="border border-gray-400 px-3 py-2">{{ $inspection->vehicleInformation->manufacturer->name }}</td>
        </tr>

        <tr>
            <td class="border border-gray-400 px-3 py-2 font-semibold">الطراز</td>
            <td class="border border-gray-400 px-3 py-2">{{ $inspection->vehicleInformation->modelType->name }}</td>
        </tr>

        <tr>
            <td class="border border-gray-400 px-3 py-2 font-semibold"> الموديل</td>
            <td class="border border-gray-400 px-3 py-2">{{ $inspection->vehicleInformation->model_year }}</td>
        </tr>

        <tr>
            <td class="border border-gray-400 px-3 py-2 font-semibold"> اللون</td>
            <td class="border border-gray-400 px-3 py-2">{{ $inspection->vehicleInformation->color->name_ar }}</td>
        </tr>

        <tr>
            <td class="border border-gray-400 px-3 py-2 font-semibold"> بلد المنشأ</td>
            <td class="border border-gray-400 px-3 py-2">{{ $inspection->vehicleInformation->originCountry->name_ar }}
            </td>
        </tr>

    </table>

</div>
