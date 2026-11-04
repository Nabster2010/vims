{{-- resources/views/components/reports/IMP/vehicle-information.blade.php --}}
@props(['reportData'])

<section class="vehicle-information">

    <table class="info-table info-left">


        <tr>
            <td>{{ $reportData['manufacturer'] }}</td>
            <th>اسم الصانع </th>
        </tr>

        <tr>
            <td>{{ $reportData['modelType'] }}</td>
            <th>الطراز</th>
        </tr>
        <tr>
            <td>{{ $reportData['model_division'] }}</td>
            <th>الطراز الفرعي </th>
        </tr>
        <tr>
            <td>{{ $reportData['fuel_type'] }}</td>
            <th> نوع الوقود </th>
        </tr>


        <tr>
            <td>{{ $reportData['number_of_seats'] }}</td>
            <th>عدد الركاب</th>
        </tr>
        <tr>
            <td>{{ $reportData['mileage'] }}</td>
            <th> عداد المسافات</th>
        </tr>

        <tr>
            <td>{{ $reportData['color'] }}</td>
            <th>اللون</th>
        </tr>
        <tr>
            <td>{{ $reportData['length'] }}</td>
            <th> الطول</th>
        </tr>
        <tr>
            <td>{{ $reportData['gross_weight'] }}</td>
            <th> الوزن</th>
        </tr>


    </table>

    <table class="info-table info-right">

        <tr>
            <td>{{ $reportData['customer'] }}</td>
            <th>اسم المستورد</th>
        </tr>

        <tr>
            <td>{{ $reportData['request_no'] }}</td>
            <th>رقم الطلب</th>
        </tr>

        <tr>
            <td>{{ $reportData['request_date'] }}</td>
            <th>تاريخ الطلب</th>
        </tr>

        <tr>
            <td>{{ $reportData['created_at'] }}</td>
            <th>تاريخ التفتيش</th>
        </tr>
        <tr>
            <td>{{ $reportData['model_year'] }}</td>
            <th>سنة الموديل</th>
        </tr>
        <tr>
            <td>{{ $reportData['manufacturing_year'] }}</td>
            <th>سنة التصنيع</th>
        </tr>

        <tr>
            <td>{{ $reportData['originCountry'] }}</td>
            <th>بلد المنشأ</th>
        </tr>
        <tr>
            <td>{{ $reportData['motorcycle_category'] }}</td>
            <th> تصنيف الدراجة</th>
        </tr>
        <tr>
            <td>{{ $reportData['engine_displacement'] }}</td>
            <th> سعة المحرك</th>
        </tr>





    </table>


</section>
