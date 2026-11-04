{{-- resources/views/components/reports/IMP/vehicle-information.blade.php --}}
@props(['reportData'])



<section class="vehicle-information">

    <table class="info-table info-left">

        <tr>
            <td>{{ $reportData['number_of_seats'] }}</td>
            <th>عدد الركاب</th>
        </tr>
        <tr>
            <td>{{ $reportData['fuel_type'] }}</td>
            <th>نوع الوقود</th>
        </tr>

        <tr>
            <td>{{ $reportData['mileage'] }}</td>
            <th>قراءة العداد</th>
        </tr>

        <tr>
            <td>{{ $reportData['manufacturer'] }}</td>
            <th>نوع المركبة</th>
        </tr>

        <tr>
            <td>{{ $reportData['modelType'] }}</td>
            <th>الطراز</th>
        </tr>

        <tr>
            <td>{{ $reportData['model_year'] }}</td>
            <th>الموديل</th>
        </tr>

        <tr>
            <td>{{ $reportData['color'] }}</td>
            <th>اللون</th>
        </tr>

        <tr>
            <td>{{ $reportData['originCountry'] }}</td>
            <th>بلد المنشأ</th>
        </tr>

    </table>

    <table class="info-table info-right">

        <tr>
            <td>{{ $reportData['branch'] }}</td>
            <th>مكان الفحص</th>
        </tr>

        <tr>
            <td>{{ $reportData['customPort'] }}</td>
            <th>جهة طلب الفحص</th>
        </tr>

        <tr>
            <td>{{ $reportData['created_at'] }}</td>
            <th>تاريخ الفحص</th>
        </tr>

        <tr>
            <td>{{ $reportData['custom_declaration_no'] }}</td>
            <th>رقم بيان الاستيراد</th>
        </tr>

        <tr>
            <td>{{ $reportData['custom_declaration_date'] }}</td>
            <th>تاريخ بيان الاستيراد</th>
        </tr>

        <tr>
            <td>{{ $reportData['request_no'] }}</td>
            <th>رقم الإحالة</th>
        </tr>

        <tr>
            <td>{{ $reportData['customer'] }}</td>
            <th>اسم المستورد</th>
        </tr>

    </table>



</section>
