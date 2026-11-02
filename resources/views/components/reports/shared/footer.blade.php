@props(['reportData', 'page'])

@php
    $version = '1.4.7 - 01/07/2023';
    $address = match ($reportData['branch_code']) {
        'DMM' => [
            'ar' => 'الخالدية الجنوبية، الدمام، المملكة العربية السعودية',
            'en' => 'Al Khalidiyah, Dammam, Saudi Arabia',
            'phone' => '0577929189',
            'email' => 'info@tahaqoq.com',
            'version' => '1.4.7 - 01/07/2023',
        ],

        'JED' => [
            'ar' => 'المنتزهات، جدة، المملكة العربية السعودية',
            'en' => 'Al Muntazahat, Jeddah, Saudi Arabia',
            'phone' => '000000000',
            'email' => 'info@tahaqoq.com',
            'version' => '1.4.7 - 01/07/2023',
        ],

        default => [
            'ar' => 'الخالدية الجنوبية، الدمام، المملكة العربية السعودية',
            'en' => 'Al Khalidiyah, Dammam, Saudi Arabia',
            'phone' => '0577929189',
            'email' => 'info@tahaqoq.com',
            'version' => '1.4.7 - 01/07/2023',
        ],
    };

@endphp

<footer class="report-footer">

    <table class="footer-table">

        <tr>

            <td class="footer-left">

                <div class="footer-title">
                    TAHAQOQ Vehicle Inspection Center
                </div>

                <div>
                    {{ $address['en'] }}
                </div>

                <div>
                    Phone : {{ $address['phone'] }}
                </div>

                <div>
                    {{ $address['email'] }}
                </div>

                <div class="footer-version">
                    Version {{ $version }}
                </div>

            </td>

            <td class="footer-center">

                <img src="{{ asset('tahaqoq-logo.png') }}" alt="TAHAQOQ">

                <div class="footer-page">

                    {{ $page }}

                </div>

            </td>

            <td class="footer-right">

                <div class="footer-title">

                    شركة التحقق الدولية لفحص المركبات

                </div>

                <div>

                    {{ $address['ar'] }}

                </div>

                <div>

                    {{ $address['phone'] }}
                    :
                    الهاتف

                </div>

                <div>

                    {{ $address['email'] }}
                    :
                    البريد الإلكتروني

                </div>

            </td>

        </tr>

    </table>

</footer>
