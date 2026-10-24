@if (session()->has('toast'))
    @php
        $toast = session('toast');

        $styles = [
            'success' => [
                'bg' => 'bg-green-600/90',
                'icon' => '✓',
            ],
            'error' => [
                'bg' => 'bg-red-600/90',
                'icon' => '✕',
            ],
            'warning' => [
                'bg' => 'bg-amber-500/90',
                'icon' => '⚠',
            ],
            'info' => [
                'bg' => 'bg-blue-600/90',
                'icon' => 'ℹ',
            ],
        ];

        $style = $styles[$toast['type']] ?? $styles['info'];
    @endphp

    <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-10 opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" x-init="setTimeout(() => show = false, 2200)" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50">
        <div
            class="{{ $style['bg'] }} flex items-center gap-3 rounded-xl px-4 py-3 text-white shadow-2xl backdrop-blur-sm min-w-72">

            <div class="text-xl font-bold">
                {{ $style['icon'] }}
            </div>

            <div class="flex-1">
                {{ $toast['message'] }}
            </div>

            <button @click="show = false" class="text-white/80 hover:text-white">
                ✕
            </button>

        </div>
    </div>
@endif
