@props(['inspection'])

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

                <td class="tech-status">
                    {{ $inspection->emissionInspection->result }}
                </td>

                <td class="tech-result">

                    <table class="inner-table">

                        <tr class="inner-head">

                            <td>CO</td>

                            <td>HC</td>

                            <td>Opacity</td>

                        </tr>

                        <tr>

                            <td>{{ $inspection->emissionInspection->co }}</td>

                            <td>{{ $inspection->emissionInspection->hc }}</td>

                            <td>{{ $inspection->emissionInspection->opacity }}%</td>

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

                <td class="tech-status">
                    {{ $inspection->headLightInspection->result }}
                </td>

                <td class="tech-result">

                    <table class="inner-table">

                        <tr class="inner-head">

                            <td>Left</td>

                            <td>Right</td>

                        </tr>

                        <tr>

                            <td>{{ $inspection->headLightInspection->left }}</td>

                            <td>{{ $inspection->headLightInspection->right }}</td>

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

                <td class="tech-status">
                    {{ $inspection->sideSlipInspection->result }}
                </td>

                <td class="tech-result">

                    <table class="inner-table">

                        <tr class="inner-head">
                            <td>Reading</td>

                        </tr>

                        <tr>

                            <td>{{ $inspection->sideSlipInspection->value }}</td>

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

                <td class="tech-status">
                    {{ $inspection->suspensionInspection->result }}
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

                            <td>{{ $inspection->suspensionInspection->front_right }}%</td>

                            <td>{{ $inspection->suspensionInspection->front_left }}%</td>

                            <td>{{ $inspection->suspensionInspection->rear_right }}%</td>

                            <td>{{ $inspection->suspensionInspection->rear_left }}%</td>

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

                <td class="tech-status">
                    {{ $inspection->brakeInspection->result }}
                </td>

                <td class="tech-result">

                    <table class="inner-table">

                        <tr class="inner-head">

                            <td>Parking</td>

                            <td>Front</td>

                            <td>Rear</td>

                        </tr>

                        <tr>

                            <td>{{ $inspection->brakeInspection->parking }}</td>

                            <td>{{ $inspection->brakeInspection->front }}</td>

                            <td>{{ $inspection->brakeInspection->rear }}</td>

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
