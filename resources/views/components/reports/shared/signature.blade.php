@props([
    'inspection',

    'inspectorSignature' => asset('images/reports/signatures/inspector.png'),
    'managerSignature' => asset('images/reports/signatures/manager.png'),
    'stamp' => asset('images/reports/stamp.png'),
])

<table class="mt-8 w-full table-fixed border border-black border-collapse text-center">

    <tr class="font-bold">
        <td class="w-1/3 border border-black py-2">
            المفتش
            <br>
            <span class="font-normal">Inspector</span>
        </td>

        <td class="w-1/3 border border-black py-2">
            Stamp
        </td>

        <td class="w-1/3 border border-black py-2">
            المدير الفني
            <br>
            <span class="font-normal">Technical Manager</span>
        </td>
    </tr>

    <tr>
        <td class="border border-black py-2 text-lg">
            {{ $inspection->vehicleInformation->inspector->name }}
        </td>

        <td class="border border-black"></td>

        <td class="border border-black py-2 text-lg font-semibold">
            {{ $inspection->branch->manager->name }}
        </td>
    </tr>

    <tr>

        <td class="h-40 border border-black align-middle">

            @if ($inspectorSignature)
                <img src="{{ $inspectorSignature }}" class="mx-auto max-h-28 object-contain" alt="">
            @endif

        </td>

        <td class="h-40 border border-black  align-middle">

            @if ($stamp)
                <img src="{{ $stamp }}" class="mx-auto max-h-28 object-contain" alt="">
            @endif

        </td>

        <td class="h-40 border border-black align-middle">

            @if ($managerSignature)
                <img src="{{ $managerSignature }}" class="mx-auto max-h-28 object-contain" alt="">
            @endif

        </td>

    </tr>

</table>
