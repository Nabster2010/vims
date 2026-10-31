{{-- resources/views/components/reports/IMP/vehicle-information.blade.php --}}
@props(['inspection'])

<section class="vehicle-information">

    <table class="info-table info-left">


        <tr>
            <td>{{ $inspection->vehicleInformation->manufacturer->name }}</td>
            <th>اسم الصانع </th>
        </tr>

        <tr>
            <td>{{ $inspection->vehicleInformation->modelType->name }}</td>
            <th>الطراز</th>
        </tr>
        <tr>
            <td>{{ $inspection->vehicleInformation->model_division }}</td>
            <th>الطراز الفرعي </th>
        </tr>
        <tr>
            <td>{{ $inspection->vehicleInformation->fuel_type }}</td>
            <th> نوع الوقود </th>
        </tr>


        <tr>
            <td>{{ $inspection->vehicleInformation->number_of_seats }}</td>
            <th>عدد الركاب</th>
        </tr>
        <tr>
            <td>{{ $inspection->vehicleInformation->mileage }}</td>
            <th> عداد المسافات</th>
        </tr>

        <tr>
            <td>{{ $inspection->vehicleInformation->color->name_ar }}</td>
            <th>اللون</th>
        </tr>
        <tr>
            <td>{{ $inspection->vehicleInformation->length }}</td>
            <th> الطول</th>
        </tr>
        <tr>
            <td>{{ $inspection->vehicleInformation->gross_weight }}</td>
            <th> الوزن</th>
        </tr>


    </table>

    <table class="info-table info-right">

        <tr>
            <td>{{ $inspection->customer->name }}</td>
            <th>اسم المستورد</th>
        </tr>

        <tr>
            <td>{{ $inspection->request_no }}</td>
            <th>رقم الطلب</th>
        </tr>

        <tr>
            <td>{{ app(\App\Services\DateService::class)->gregorian($inspection->request_date) }}</td>
            <th>تاريخ الطلب</th>
        </tr>

        <tr>
            <td>{{ app(\App\Services\DateService::class)->gregorian($inspection->created_at) }}</td>
            <th>تاريخ التفتيش</th>
        </tr>
        <tr>
            <td>{{ $inspection->vehicleInformation->model_year }}</td>
            <th>سنة الموديل</th>
        </tr>
        <tr>
            <td>{{ $inspection->vehicleInformation->manufacturing_year }}</td>
            <th>سنة التصنيع</th>
        </tr>

        <tr>
            <td>{{ $inspection->vehicleInformation->originCountry->name_ar }}</td>
            <th>بلد المنشأ</th>
        </tr>
        <tr>
            <td>{{ $inspection->vehicleInformation->motorcycle_category }}</td>
            <th> تصنيف الدراجة</th>
        </tr>
        <tr>
            <td>{{ $inspection->vehicleInformation->engine_displacement }}</td>
            <th> سعة المحرك</th>
        </tr>





    </table>


</section>
