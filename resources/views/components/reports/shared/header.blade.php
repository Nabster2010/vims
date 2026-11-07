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
                    {{ $reportData['report_title'] }}
                </div>

                <div class="report-number">
                    <span>
                        {{ $reportData['report_no'] }}
                    </span>
                    <span>:</span>

                    <strong>رقم التقرير </strong>


                </div>

                <div class="report-date">

                    <strong>التاريخ :</strong>

                    {{ $reportData['report_date_gregorian'] }}

                    <span class="date-space"></span>

                    <strong>الموافق:</strong>

                    {{ $reportData['report_date_hijri'] }}

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
                    Inspection Center - {{ $reportData['branch_name'] }}
                </div>

            </td>

        </tr>

    </table>

</header>
