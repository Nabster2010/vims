<div class="section-title">
    المتطلبات الفنية للمركبات المعدلة
</div>

<table class="modified-technical-table">

    <thead>

        <tr>


            <th class="mt-no">
                م
            </th>

            <th class="mt-reference">
                المرجع
            </th>
            <th class="mt-item">
                البند
            </th>
            <th class="mt-modified">
                تم التعديل
            </th>
            <th class="mt-result">
                النتيجة
            </th>

        </tr>

    </thead>

    <tbody>

        @foreach ([['4.3.1', 'المحرك'], ['4.3.2', 'نظام نقل الحركة'], ['4.3.3', 'أنظمة العادم'], ['4.3.4', 'نظام الوقود'], ['4.3.5', 'نظام الفرامل'], ['4.3.6', 'الحواف والنتوءات الخارجية'], ['4.3.7', 'عجلة القيادة'], ['4.3.8', 'الإطارات والعجلات'], ['4.3.9', 'أنظمة الترفيه'], ['4.3.10', 'الهيكل والشاسية']] as $index => $item)
            <tr>
                <td>
                    {{ $index + 1 }}
                </td>
                <td>
                    {{ $item[0] }}
                </td>

                <td class="item-cell">
                    {{ $item[1] }}
                </td>


                <td class="check-cell">
                    ✓
                </td>
                <td class="pass-cell">
                    Pass
                </td>

            </tr>
        @endforeach

    </tbody>

</table>
