        @php

            $rows = [
                [
                    'no' => 1,
                    'text' => 'الطول الكلي (يتم اعتماد الأبعاد المحددة من الصانع بشرط ألا تتجاوز الحد الأقصى)',
                ],

                [
                    'no' => 2,
                    'text' => 'العرض الكلي (يتم اعتماد الأبعاد المحددة من الصانع بشرط ألا تتجاوز الحد الأقصى)',
                ],

                [
                    'no' => 3,
                    'text' => 'الارتفاع الكلي (يتم اعتماد الأبعاد المحددة من الصانع بشرط ألا تتجاوز الحد الأقصى)',
                ],

                [
                    'no' => 4,
                    'text' => 'الوزن الإجمالي للمركبة (يكون التحقق من خلال لوحة تعريف بيانات المركبة)',
                ],

                [
                    'no' => 5,
                    'text' => 'الأوزان القصوى على المحاور',
                ],

                [
                    'no' => 6,
                    'text' => 'لون المركبة',
                ],

                [
                    'no' => 7,
                    'text' => 'الرقم المميز للمركبة',
                ],

                [
                    'no' => 8,
                    'text' => 'معلومات لوحة بيانات المركبة',
                ],

                [
                    'no' => 9,
                    'text' => 'سلامة الهيكل الخارجي وقاعدة العجلات (الشاسيه) والجسور والقواطع',
                ],

                [
                    'no' => 10,
                    'text' => 'مجموعة التوصيلات الكهربائية',
                ],

                [
                    'no' => 11,
                    'text' => 'نظام المكابح',
                ],

                [
                    'no' => 12,
                    'text' => 'مجموعة التوصيلات الكهربائية',
                ],

                [
                    'no' => 13,
                    'text' => 'نظام المكابح',
                ],

                [
                    'no' => 14,
                    'text' => 'مجموعة التوصيلات الكهربائية',
                ],

                [
                    'no' => 15,
                    'text' => 'نظام المكابح',
                ],

                [
                    'no' => 16,
                    'text' => 'مجموعة التوصيلات الكهربائية',
                ],

                [
                    'no' => 17,
                    'text' => 'نظام المكابح',
                ],
            ];

        @endphp



        <div class="section-title section-title-underline">
            المتطلبات الفنية للدرجات
        </div>

        <table class="modified-checklist">

            <thead>



                <tr>
                    <th class="no-col" rowspan="2">م</th>
                    <th class="item-col" rowspan="2">البند</th>
                    <th colspan="3" style="width: 45mm">القبول والرفض </th>

                </tr>

                <tr>


                    <th class="status-col">Pass</th>
                    <th class="status-col">Fail</th>
                    <th class="status-col">N/A</th>
                </tr>

            </thead>

            <tbody>



                @foreach ($rows as $row)
                    <tr>

                        <td class="item-number" style="height: 7mm">
                            {{ $row['no'] }}
                        </td>
                        <td class="item-text">
                            {{ $row['text'] }}
                        </td>

                        <td class="checkbox-cell">☒</td>
                        <td class="checkbox-cell">□</td>
                        <td class="checkbox-cell">□</td>

                    </tr>
                @endforeach

            </tbody>

        </table>
