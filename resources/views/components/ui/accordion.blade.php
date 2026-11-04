    <details
        class="group border border-slate-200 bg-white rounded-lg shadow-sm [&_summary::-webkit-details-marker]:hidden"
        close>
        <summary
            class="flex uppercase bg-slate-50 items-center justify-between p-5 text-slate-800 font-medium cursor-pointer list-none hover:bg-slate-100 transition-colors duration-200">
            <span>{{ $title }}</span>
            <span class="transition duration-300 group-open:-rotate-180">
                <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="w-5 h-5 text-slate-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </span>
        </summary>
        <div class="p-5 pt-0 border-t border-slate-100 text-sm text-slate-600 leading-relaxed">
            {{ $slot }}
        </div>
    </details>
