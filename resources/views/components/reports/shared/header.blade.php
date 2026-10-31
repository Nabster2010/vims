@props(['inspection'])

@php
    $branch = $inspection->branch->name;
@endphp

<header class="report-header">

    <table class="header-table">

        <tr>

            {{-- Logo --}}
            <td class="header-logo">

                <img src="{{ asset('tahaqoq-logo.png') }}" alt="TAHAQOQ">

            </td>

            {{-- Title --}}
            <td class="header-title">

                <div class="title-en">
                    INSPECTION REPORT
                </div>

                <div class="title-ar">
                    تقرير الفحص
                </div>

                <div class="report-number">
                    <span>
                        {{ $inspection->report_no }}
                    </span>
                    <span>:</span>

                    <strong>رقم التقرير </strong>


                </div>

                <div class="report-date">

                    <strong>التاريخ :</strong>

                    {{ app(\App\Services\DateService::class)->gregorian($inspection->created_at) }}

                    <span class="date-space"></span>

                    <strong>الموافق:</strong>

                    {{ app(\App\Services\DateService::class)->hijri($inspection->created_at) }}

                </div>

            </td>

            {{-- Company --}}
            <td class="header-company">

                <div class="company-ar">
                    شركة التحقق الدولية لفحص المركبات
                </div>

                <div class="company-en">
                    TAHAQOQ International Vehicle
                </div>

                <div class="company-en">
                    Inspection Center - {{ $branch }}
                </div>

            </td>

        </tr>

    </table>

</header>
