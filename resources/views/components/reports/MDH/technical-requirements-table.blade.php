        @php

            $rows = [
                [
                    'no' => 2,
                    'text' => 'الطول الكلي (يتم اعتماد الأبعاد المحددة من الصانع بشرط ألا تتجاوز الحد الأقصى)',
                    'result' => '',
                ],

                [
                    'no' => 3,
                    'text' => 'العرض الكلي (يتم اعتماد الأبعاد المحددة من الصانع بشرط ألا تتجاوز الحد الأقصى)',
                ],

                [
                    'no' => 4,
                    'text' => 'الارتفاع الكلي (يتم اعتماد الأبعاد المحددة من الصانع بشرط ألا تتجاوز الحد الأقصى)',
                ],

                [
                    'no' => 5,
                    'text' => 'الوزن الإجمالي للمركبة (يكون التحقق من خلال لوحة تعريف بيانات المركبة)',
                ],

                [
                    'no' => 6,
                    'text' => 'الأوزان القصوى على المحاور',
                ],

                [
                    'no' => 7,
                    'text' => 'لون المركبة',
                ],

                [
                    'no' => 8,
                    'text' => 'الرقم المميز للمركبة',
                ],

                [
                    'no' => 9,
                    'text' => 'معلومات لوحة بيانات المركبة',
                ],

                [
                    'no' => 10,
                    'text' => 'سلامة الهيكل الخارجي وقاعدة العجلات (الشاسيه) والجسور والقواطع',
                ],

                [
                    'no' => 11,
                    'text' => 'مجموعة التوصيلات الكهربائية',
                ],

                [
                    'no' => 12,
                    'text' => 'نظام المكابح',
                ],
                [
                    'no' => 13,
                    'text' => 'الانوار ',
                ],
                [
                    'no' => 14,
                    'text' => ' انوار اشارات الدوران الامامية والجانبية والخلفية',
                ],
                [
                    'no' => 15,
                    'text' => ' انوار السير الي الخلف',
                ],
                [
                    'no' => 16,
                    'text' => 'نظام التعليق',
                ],
                [
                    'no' => 17,
                    'text' => 'النوابض الامامية والخلفية ',
                ],
                [
                    'no' => 18,
                    'text' => 'ممتص الصدمات ',
                ],
                [
                    'no' => 19,
                    'text' => 'نظام العادم',
                ],
                [
                    'no' => 20,
                    'text' => 'تم تغيير انبوب العادم بأنبوب جديد ',
                ],
                [
                    'no' => 21,
                    'text' => ' المرايا الجانبية الخارجية للرؤية الخلفية ',
                ],
                [
                    'no' => 22,
                    'text' => 'نظام الوقود',
                ],
                [
                    'no' => 23,
                    'text' => 'العجلة الخامسة ',
                ],
                [
                    'no' => 24,
                    'text' => 'الحواجز ',
                ],
                [
                    'no' => 25,
                    'text' => 'الشاحنات المجهزة بمنازل  ',
                ],
            ];

        @endphp



        <div class="section-title section-title-underline">
            المتطلبات الفنية للمركبات المعدلة
        </div>

        <table class="modified-checklist">

            <thead>

                <tr>
                    <th class="no-col">م</th>
                    <th class="item-col">البند</th>
                    <th class="status-col">Pass</th>
                    <th class="status-col">Fail</th>
                    <th class="status-col">N/A</th>
                </tr>

            </thead>

            <tbody>

                <tr class="section-row">
                    <td class="section-number">
                        1
                    </td>

                    <td class="section-name">
                        الفحص الخارجي
                    </td>

                    <td colspan="3"></td>

                </tr>

                @foreach ($rows as $row)
                    <tr>

                        <td class="item-number">
                            {{ $row['no'] }}
                        </td>
                        <td class="item-text">
                            {{ $row['text'] }}
                        </td>

                        <td class="checkbox-cell">☒</td>
                        <td class="checkbox-cell">□</td>
                        <td class="checkbox-cell">□</td>

                    </tr>

                    <tr class="notes-row">
                        <td class="notes-title">
                            ملاحظات
                        </td>

                        <td colspan="4"></td>


                    </tr>
                @endforeach

            </tbody>

        </table>
