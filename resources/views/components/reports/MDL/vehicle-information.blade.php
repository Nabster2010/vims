{{-- resources/views/components/reports/IMP/vehicle-information.blade.php --}}


<section class="vehicle-information">

    <table class="info-table info-left">

        <tr>
            <td>{{ $reportData['plate_number'] }}</td>
            <th>رقم اللوحة </th>
        </tr>
        <tr>
            <td>{{ $reportData['manufacturer'] }}</td>
            <th>الشركة المصنعة</th>
        </tr>
        <tr>
            <td>{{ $reportData['fuel_type'] }}</td>
            <th>نوع الوقود</th>
        </tr>
        <tr>
            <td>{{ $reportData['modelType'] }}</td>
            <th> الطراز</th>
        </tr>
        <tr>
            <td>{{ $reportData['model_year'] }}</td>
            <th> سنة الموديل </th>
        </tr>
        <tr>
            <td>{{ $reportData['color'] }}</td>
            <th> اللون </th>
        </tr>

        <tr>
            <td>{{ $reportData['old_model'] }}</td>
            <th>الطراز القديم</th>
        </tr>
        <tr>
            <td>{{ $reportData['new_model'] }}</td>
            <th>الطراز الجديد</th>
        </tr>





    </table>

    <table class="info-table info-right">


        <tr>
            <td>{{ $reportData['customer'] }}</td>
            <th> اسم المالك</th>
        </tr>

        <tr>
            <td>{{ $reportData['owner_id'] }}</td>
            <th>رقم الحاسب</th>
        </tr>

        <tr>
            <td>{{ $reportData['request_date'] }}</td>
            <th>تاريخ الاحالة</th>
        </tr>

        <tr>
            <td>{{ $reportData['request_origin'] }}</td>
            <th>مصدر الاحالة</th>
        </tr>
        <tr>
            <td>{{ $reportData['is_authorized_modification_center'] ? 'نعم' : 'لا' }}</td>
            <th>التعديل بمنشأة مسجلة؟</th>
        </tr>
        <tr>
            <td>{{ $reportData['modification_center_name'] }}</td>
            <th>اسم مركز التعديل</th>
        </tr>
        <tr>
            <td>{{ $reportData['modification_center_report_number'] }}</td>
            <th>رقم تقرير المركز</th>
        </tr>
        <tr>
            <td>{{ $reportData['modification_description'] }}</td>
            <th>وصف التعديل</th>
        </tr>

    </table>



</section>
