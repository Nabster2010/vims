{{-- resources/views/components/reports/IMP/vehicle-information.blade.php --}}
@props(['inspection'])

<section class="vehicle-information">

    <table class="info-table info-left">

        <tr>
            <td>{{ $inspection->branch->name_ar }}</td>
            <th>رقم اللوحة </th>
        </tr>
        <tr>
            <td>{{ '7777' }}</td>
            <th>نوع المركبة</th>
        </tr>
        <tr>
            <td>{{ '7777' }}</td>
            <th> الطراز</th>
        </tr>
        <tr>
            <td>{{ $inspection->vehicleInformation->mileage }}</td>
            <th> سنة الموديل </th>
        </tr>
        <tr>
            <td>{{ $inspection->vehicleInformation->mileage }}</td>
            <th> اللون </th>
        </tr>

        <tr>
            <td>{{ $inspection->vehicleInformation->model_year }}</td>
            <th>الطراز القديم</th>
        </tr>
        <tr>
            <td>{{ $inspection->vehicleInformation->model_year }}</td>
            <th>الطراز الجديد</th>
        </tr>





    </table>

    <table class="info-table info-right">


        <tr>
            <td>{{ $inspection->vehicleInformation->number_of_seats }}</td>
            <th> اسم المالك</th>
        </tr>

        <tr>
            <td>{{ $inspection->vehicleInformation->modelType->name }}</td>
            <th>رقم الحاسب</th>
        </tr>

        <tr>
            <td>{{ $inspection->custom_declaration_no }}</td>
            <th>تاريخ الاحالة</th>
        </tr>

        <tr>
            <td>{{ $inspection->custom_declaration_no }}</td>
            <th>مصدر الاحالة</th>
        </tr>
        <tr>
            <td>{{ $inspection->custom_declaration_no }}</td>
            <th>التعديل بمنشأة مسجلة؟</th>
        </tr>
        <tr>
            <td>{{ $inspection->custom_declaration_no }}</td>
            <th>اسم مركز التعديل</th>
        </tr>
        <tr>
            <td>{{ $inspection->vehicleInformation->model_year }}</td>
            <th>رقم تقرير المركز</th>
        </tr>

    </table>



</section>
