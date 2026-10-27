<h3 class="mt-8 mb-3 text-center underline text-xl font-bold">
    المتطلبات الفنية للمركبات المعدلة
</h3>
<table class="w-full border border-black border-collapse text-[14px] mt-3">
    <thead>
        <tr class="bg-gray-200 font-bold text-center">
            <th class="border border-black w-16">N/A</th>
            <th class="border border-black w-16">Fail</th>
            <th class="border border-black w-16">Pass</th>
            <th class="border border-black">البند</th>
            <th class="border border-black w-24">م</th>
        </tr>
    </thead>

    <tbody>

        {{-- Section --}}
        <tr class="bg-gray-100 font-bold">
            <td colspan="3"></td>
            <td class="border border-black text-center">
                الفحص الخارجي
            </td>
            <td class="border border-black text-center">
                1
            </td>
        </tr>

        @php

            $rows = [
                [
                    'no' => 2,
                    'text' => 'الطول الكلي (يتم اعتماد الأبعاد المحددة من الصانع بشرط ألا تتجاوز الحد الأقصى)',
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
                    'text' => 'الأنوار',
                ],

                [
                    'no' => 14,
                    'text' => 'أنوار إشارات الدوران (الانعطاف) الأمامية والجانبية والخلفية',
                ],
            ];

        @endphp

        @foreach ($rows as $row)
            <tr>

                {{-- N/A --}}
                <td class="border border-black text-center text-[14px]">
                    □
                </td>

                {{-- Fail --}}
                <td class="border border-black text-center text-[14px]">
                    □
                </td>

                {{-- Pass --}}
                <td class="border border-black text-center text-[14px]">
                    ☒
                </td>

                {{-- Item --}}
                <td class="border border-black text-center font-semibold py-2 px-2">
                    {{ $row['text'] }}
                </td>

                {{-- Number --}}
                <td class="border border-black text-center">
                    {{ $row['no'] }}
                </td>

            </tr>

            {{-- Notes Row --}}
            <tr>

                <td colspan="4" class="border border-black h-7 px-2"></td>

                <td class="border border-black text-center">
                    ملاحظات
                </td>

            </tr>
        @endforeach

    </tbody>

</table>
