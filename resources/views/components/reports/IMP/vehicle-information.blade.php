{{-- resources/views/components/reports/IMP/vehicle-information.blade.php --}}
@props(['inspection'])

<section class="vehicle-information">

    <table class="info-table info-left">

        <tr>
            <td>{{ $inspection->vehicleInformation->number_of_seats }}</td>
            <th>عدد الركاب</th>
        </tr>

        <tr>
            <td>{{ $inspection->vehicleInformation->mileage }}</td>
            <th>قراءة العداد</th>
        </tr>

        <tr>
            <td>{{ $inspection->vehicleInformation->manufacturer->name }}</td>
            <th>نوع المركبة</th>
        </tr>

        <tr>
            <td>{{ $inspection->vehicleInformation->modelType->name }}</td>
            <th>الطراز</th>
        </tr>

        <tr>
            <td>{{ $inspection->vehicleInformation->model_year }}</td>
            <th>الموديل</th>
        </tr>

        <tr>
            <td>{{ $inspection->vehicleInformation->color->name_ar }}</td>
            <th>اللون</th>
        </tr>

        <tr>
            <td>{{ $inspection->vehicleInformation->originCountry->name_ar }}</td>
            <th>بلد المنشأ</th>
        </tr>

    </table>

    <table class="info-table info-right">

        <tr>
            <td>{{ $inspection->branch->name_ar }}</td>
            <th>مكان الفحص</th>
        </tr>

        <tr>
            <td>{{ $inspection->customPort->name_ar }}</td>
            <th>جهة طلب الفحص</th>
        </tr>

        <tr>
            <td>{{ app(\App\Services\DateService::class)->gregorian($inspection->created_at) }}</td>
            <th>تاريخ الفحص</th>
        </tr>

        <tr>
            <td>{{ $inspection->custom_declaration_no }}</td>
            <th>رقم بيان الاستيراد</th>
        </tr>

        <tr>
            <td>{{ app(\App\Services\DateService::class)->hijri($inspection->custom_declaration_date) }}</td>
            <th>تاريخ بيان الاستيراد</th>
        </tr>

        <tr>
            <td>{{ $inspection->request_no }}</td>
            <th>رقم الإحالة</th>
        </tr>

        <tr>
            <td>{{ $inspection->customer->name }}</td>
            <th>اسم المستورد</th>
        </tr>

    </table>



</section>
