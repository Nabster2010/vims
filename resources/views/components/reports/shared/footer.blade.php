<?php
$branch = $inspection->branch->code;
$address = [];
switch ($branch) {
    case 'DMM':
        $address = [
            'ar' => 'الخالدية الجنوبية، الدمام، السعودية',
            'en' => 'Al Khalidiyah, Dammam, KSA',
            'phone' => '0577929189',
            'email' => 'info@tahaqoq.com',
            'version' => '1.4.7 - 01/07/2023',
        ];
        break;
    case 'JED':
        $address = [
            'ar' => 'المنتزهات، جدة، السعودية',
            'en' => 'Al-Muntazahat, Jeddah, KSA',
            'phone' => '000000000',
            'email' => 'info@tahaqoq.com',
            'version' => '1.4.7 - 01/07/2023',
        ];

    default:
        $address = [
            'ar' => 'الخالدية الجنوبية، الدمام، السعودية',
            'en' => 'Al Khalidiyah, Dammam, KSA',
            'phone' => '0577929189',
            'email' => 'info@tahaqoq.com',
            'version' => '1.4.7 - 01/07/2023',
        ];
        break;
}

?>


@props(['inspection', 'page'])

<footer class="mt-10 border-t-1 border-black pt-4">
    <div class="grid grid-cols-[1fr_220px_1fr] items-end">

        {{-- English --}}
        <div class="text-left text-lg leading-8">

            <div class="font-semibold">
                TAHAQOQ Vehicle Inspection Center
            </div>

            <div>
                Address: {{ $address['en'] }}
            </div>

            <div>
                Phone: {{ $address['phone'] }}
            </div>

            <div>
                Email: {{ $address['email'] }}
            </div>

            <div class="mt-2 text-base">
                Version {{ $address['version'] }}
            </div>

        </div>

        {{-- Logo --}}
        <div class="flex flex-col items-center justify-end">

            <img src="{{ asset('tahaqoq-logo.png') }}" class="h-24 object-contain" alt="TAHAQOQ">

            <div class="mt-2 text-lg font-semibold">
                {{ $page }}
            </div>

        </div>

        {{-- Arabic --}}
        <div class="text-right text-lg leading-8">

            <div class="font-semibold">
                مركز التحقق الدولية لفحص السيارات الدمام
            </div>

            <div>
                <span>العنوان</span>
                <span>:</span>
                <span>{{ $address['ar'] }}</span>

            </div>

            <div>
                <span>الهاتف</span>
                <span>:</span>
                <span>{{ $address['phone'] }}</span>
            </div>

            <div>
                <span>{{ $address['email'] }}</span>
                <span>:</span>
                <span>الإيميل</span>
            </div>

        </div>

    </div>
</footer>
