<h3 class="mt-8 mb-3 text-right text-xl font-bold">
    المتطلبات الفنية للمركبات المعدلة
</h3>

<table class="w-full border-collapse border border-black text-center text-sm" dir="rtl">

    <thead>

        <tr class="bg-gray-200 font-bold">

            <th class="w-14 border border-black p-2">م</th>

            <th class="w-32 border border-black p-2">المرجع</th>

            <th class="border border-black p-2">البند</th>

            <th class="w-40 border border-black p-2">تم التعديل</th>

            <th class="w-40 border border-black p-2">النتيجة</th>

        </tr>

    </thead>

    <tbody>

        @foreach ([['4.3.1', 'المحرك'], ['4.3.2', 'نظام نقل الحركة'], ['4.3.3', 'أنظمة العادم'], ['4.3.4', 'نظام الوقود'], ['4.3.5', 'نظام الفرامل'], ['4.3.6', 'الحواف والنتوءات الخارجية'], ['4.3.7', 'عجلة القيادة'], ['4.3.8', 'الإطارات والعجلات'], ['4.3.9', 'أنظمة الترفيه'], ['4.3.10', 'الهيكل والشاسية']] as $index => $item)
            <tr>

                <td class="border border-black p-2">
                    {{ $index + 1 }}
                </td>

                <td class="border border-black p-2">
                    {{ $item[0] }}
                </td>

                <td class="border border-black text-right p-2">
                    {{ $item[1] }}
                </td>

                <td class="border border-black p-2 text-xl">
                    ✓
                </td>

                <td class="border border-black p-2 font-semibold">
                    Pass
                </td>

            </tr>
        @endforeach

    </tbody>

</table>
