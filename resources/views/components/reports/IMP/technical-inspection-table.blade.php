@props(['reportData'])

<div class="technical-section">

    <h2 class="section-title">
        تقرير الفحوصات الفنية
    </h2>

    <table class="technical-table">

        <thead>

            <tr>

                <th class="tech-status">
                    المطابقة
                </th>

                <th class="tech-result">
                    النتائج
                </th>

                <th class="tech-name">
                    اسم الفحص
                </th>

                <th class="tech-item">
                    البند
                </th>

                <th class="tech-spec">
                    المواصفة
                </th>

                <th class="tech-no">
                    م
                </th>

            </tr>

        </thead>

        <tbody>

            {{-- Exhaust ---------------------------------------------------- --}}

            <tr>

                <td
                    class="tech-status {{ $reportData['emission_final_result'] === \App\Enums\InspectionResult::Fail ? 'fail-result ' : '' }}">
                    {{ $reportData['emission_final_result'] === \App\Enums\InspectionResult::Pass ? 'اجتياز' : 'فشل' }}
                </td>

                <td class="tech-result">

                    <table class="inner-table">

                        <tr class="inner-head">

                            <td>CO</td>

                            <td>HC</td>

                            <td>Diesel</td>

                        </tr>

                        <tr>

                            <td>{{ $reportData['emission_co'] }} %</td>

                            <td>{{ $reportData['emission_hc'] }} ppm</td>

                            <td>{{ $reportData['emission_opacity'] }} %</td>

                        </tr>

                    </table>

                </td>

                <td class="tech-name">
                    فحص غازات العادم
                </td>

                <td>1/4/6</td>

                <td>SASO 2864</td>

                <td>1</td>

            </tr>

            {{-- Headlight -------------------------------------------------- --}}

            <tr>
                <td
                    class="tech-status {{ $reportData['emission_final_result'] === \App\Enums\InspectionResult::Fail ? 'fail-result ' : '' }}">
                    {{ $reportData['headlight_final_result'] === \App\Enums\InspectionResult::Pass ? 'اجتياز' : 'فشل' }}
                </td>

                <td class="tech-result">

                    <table class="inner-table">

                        <tr class="inner-head">

                            <td>Left</td>

                            <td>Right</td>

                        </tr>

                        <tr>

                            <td>{{ $reportData['headlight_left'] }} cd</td>

                            <td>{{ $reportData['headlight_right'] }} cd</td>

                        </tr>

                    </table>

                </td>

                <td class="tech-name">
                    فحص الأنوار
                </td>

                <td>5/6</td>

                <td>SASO 2864</td>

                <td>2</td>

            </tr>

            {{-- Side Slip -------------------------------------------------- --}}

            <tr>

                <td
                    class="tech-status {{ $reportData['emission_final_result'] === \App\Enums\InspectionResult::Fail ? 'fail-result ' : '' }}">

                    {{ $reportData['side_slip_final_result'] === \App\Enums\InspectionResult::Pass ? 'اجتياز' : 'فشل' }}
                </td>

                <td class="tech-result">

                    <table class="inner-table">

                        <tr class="inner-head">
                            <td>Reading</td>

                        </tr>

                        <tr>

                            <td>{{ $reportData['side_slip_value'] }} m/km</td>

                        </tr>

                    </table>

                </td>

                <td class="tech-name">
                    Side Slip
                </td>

                <td>2/6</td>

                <td>SASO 2864</td>

                <td>3</td>

            </tr>

            {{-- Suspension ------------------------------------------------- --}}

            <tr>

                <td
                    class="tech-status {{ $reportData['emission_final_result'] === \App\Enums\InspectionResult::Fail ? 'fail-result ' : '' }}">

                    {{ $reportData['suspension_final_result'] === \App\Enums\InspectionResult::Pass ? 'اجتياز' : 'فشل' }}
                </td>

                <td class="tech-result">

                    <table class="inner-table">

                        <tr class="inner-head">

                            <td>FR</td>

                            <td>FL</td>

                            <td>RR</td>

                            <td>RL</td>

                        </tr>

                        <tr>

                            <td>{{ $reportData['suspension_fr'] }} %</td>

                            <td>{{ $reportData['suspension_fl'] }} %</td>

                            <td>{{ $reportData['suspension_rr'] }} %</td>

                            <td>{{ $reportData['suspension_rl'] }}%</td>

                        </tr>

                    </table>

                </td>

                <td class="tech-name">
                    فحص نظام التعليق
                </td>

                <td>7/6</td>

                <td>SASO 2864</td>

                <td>4</td>

            </tr>

            {{-- Brake ------------------------------------------------------ --}}

            <tr>

                <td
                    class="tech-status {{ $reportData['emission_final_result'] === \App\Enums\InspectionResult::Fail ? 'fail-result ' : '' }}">

                    {{ $reportData['brake_final_result'] === \App\Enums\InspectionResult::Pass ? 'اجتياز' : 'فشل' }}
                </td>

                <td class="tech-result">

                    <table class="inner-table">

                        <tr class="inner-head">

                            <td>Parking</td>

                            <td>Front</td>

                            <td>Rear</td>

                        </tr>

                        <tr>

                            <td>{{ $reportData['parking_brake'] }} %</td>

                            <td>{{ $reportData['front_brake'] }} %</td>

                            <td>{{ $reportData['rear_brake'] }} %</td>

                        </tr>

                    </table>

                </td>

                <td class="tech-name">
                    فحص المكابح
                </td>

                <td>3/6</td>

                <td>SASO 2864</td>

                <td>5</td>

            </tr>

        </tbody>

    </table>

</div>
