<?php
$branch = $inspection->branch->name;

?>
@props(['inspection'])


<header class="border-b-1 border-black pb-4">
    <div class="grid grid-cols-[250px_1fr_350px] items-center">

        {{-- Logo --}}
        <div class="flex justify-start">
            <img src="{{ asset('tahaqoq-logo.png') }}" alt="TAHAQOQ" class="h-34 object-contain">
        </div>

        {{-- Report Title --}}
        <div class="text-center font-bold">

            <h1 class="text-2xl uppercase tracking-wide">
                INSPECTION REPORT
            </h1>

            <h2 class="mt-1 text-2xl">
                تقرير الفحص
            </h2>

            <div class="mt-2 space-y-2 text-xl">

                <div>
                    <span>{{ $inspection->report_no }}</span>
                    <span>:</span>
                    <span>رقم التقرير</span>
                </div>

                <div>
                    التاريخ:
                    <span>{{ app(\App\Services\DateService::class)->gregorian($inspection->created_at) }}</span>

                    <span class="mx-4">الموافق:</span>

                    <span> {{ app(\App\Services\DateService::class)->hijri($inspection->created_at) }} </span>
                </div>

            </div>

        </div>

        {{-- Inspection Center --}}
        <div class="text-right leading-tight">

            <div class="text-2xl font-semibold">
                مركز التحقق الدولية لفحص المركبات
            </div>

            <div class="mt-3 text-xl">
                TAHAQOQ International Vehicle
            </div>

            <div class="text-xl">
                Inspection Center - {{ $branch }}
            </div>

        </div>

    </div>
</header>
