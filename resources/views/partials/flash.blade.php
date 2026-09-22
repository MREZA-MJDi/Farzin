@php
    $flashMessages = [
        'success' => session('success'),
        'error'   => session('error'),
        'warning' => session('warning'),
        'info'    => session('info'),
    ];
@endphp

@if(collect($flashMessages)->filter()->isNotEmpty())

    <div
        class="pointer-events-none fixed inset-x-4 top-4 z-[100] mx-auto max-w-xl space-y-3"
        aria-live="polite"
        aria-atomic="true"
    >

        {{-- =========================================================
            Success
        ========================================================== --}}

        @if(session('success'))

            <div
                x-data="{ show: true }"
                x-show="show"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="translate-y-2 opacity-0 scale-[0.98]"
                x-transition:enter-end="translate-y-0 opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="translate-y-0 opacity-100 scale-100"
                x-transition:leave-end="translate-y-1 opacity-0 scale-[0.98]"
                class="pointer-events-auto flex items-start gap-3 rounded-2xl border border-emerald-200 bg-white p-4 shadow-[0_18px_45px_rgba(72,91,105,0.10)]"
                role="status"
            >

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600"
                >

                    <svg
                        class="h-5 w-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        aria-hidden="true"
                    >
                        <path d="m5 12 4 4L19 6"/>
                    </svg>

                </div>


                <div class="min-w-0 flex-1 pt-0.5">

                    <p class="text-sm font-black text-emerald-800">
                        موفق
                    </p>

                    <p class="mt-1 text-sm leading-6 text-emerald-700">
                        {{ session('success') }}
                    </p>

                </div>


                <button
                    type="button"
                    @click="show = false"
                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-emerald-500 transition hover:bg-emerald-50 hover:text-emerald-700"
                    aria-label="بستن پیام"
                >

                    <svg
                        class="h-4 w-4"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        aria-hidden="true"
                    >
                        <path d="m6 6 12 12"/>
                        <path d="M18 6 6 18"/>
                    </svg>

                </button>

            </div>

        @endif


        {{-- =========================================================
            Error
        ========================================================== --}}

        @if(session('error'))

            <div
                x-data="{ show: true }"
                x-show="show"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="translate-y-2 opacity-0 scale-[0.98]"
                x-transition:enter-end="translate-y-0 opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="translate-y-0 opacity-100 scale-100"
                x-transition:leave-end="translate-y-1 opacity-0 scale-[0.98]"
                class="pointer-events-auto flex items-start gap-3 rounded-2xl border border-red-200 bg-white p-4 shadow-[0_18px_45px_rgba(72,91,105,0.10)]"
                role="alert"
            >

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-50 text-red-600"
                >

                    <svg
                        class="h-5 w-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        aria-hidden="true"
                    >
                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        />

                        <path d="M12 8v5"/>
                        <path d="M12 16h.01"/>

                    </svg>

                </div>


                <div class="min-w-0 flex-1 pt-0.5">

                    <p class="text-sm font-black text-red-800">
                        خطا
                    </p>

                    <p class="mt-1 text-sm leading-6 text-red-700">
                        {{ session('error') }}
                    </p>

                </div>


                <button
                    type="button"
                    @click="show = false"
                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-red-500 transition hover:bg-red-50 hover:text-red-700"
                    aria-label="بستن پیام"
                >

                    <svg
                        class="h-4 w-4"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        aria-hidden="true"
                    >
                        <path d="m6 6 12 12"/>
                        <path d="M18 6 6 18"/>
                    </svg>

                </button>

            </div>

        @endif


        {{-- =========================================================
            Warning
        ========================================================== --}}

        @if(session('warning'))

            <div
                x-data="{ show: true }"
                x-show="show"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="translate-y-2 opacity-0 scale-[0.98]"
                x-transition:enter-end="translate-y-0 opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="translate-y-0 opacity-100 scale-100"
                x-transition:leave-end="translate-y-1 opacity-0 scale-[0.98]"
                class="pointer-events-auto flex items-start gap-3 rounded-2xl border border-[var(--accent)]/25 bg-white p-4 shadow-[0_18px_45px_rgba(72,91,105,0.10)]"
                role="status"
            >

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[var(--accent-soft)] text-[var(--accent)]"
                >

                    <svg
                        class="h-5 w-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        aria-hidden="true"
                    >
                        <path d="M12 3 2.8 20h18.4L12 3Z"/>
                        <path d="M12 9v4"/>
                        <path d="M12 16h.01"/>
                    </svg>

                </div>


                <div class="min-w-0 flex-1 pt-0.5">

                    <p class="text-sm font-black text-[var(--accent)]">
                        توجه
                    </p>

                    <p class="mt-1 text-sm leading-6 text-[var(--text-secondary)]">
                        {{ session('warning') }}
                    </p>

                </div>


                <button
                    type="button"
                    @click="show = false"
                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-[var(--accent)] transition hover:bg-[var(--accent-soft)]"
                    aria-label="بستن پیام"
                >

                    <svg
                        class="h-4 w-4"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        aria-hidden="true"
                    >
                        <path d="m6 6 12 12"/>
                        <path d="M18 6 6 18"/>
                    </svg>

                </button>

            </div>

        @endif


        {{-- =========================================================
            Info
        ========================================================== --}}

        @if(session('info'))

            <div
                x-data="{ show: true }"
                x-show="show"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="translate-y-2 opacity-0 scale-[0.98]"
                x-transition:enter-end="translate-y-0 opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="translate-y-0 opacity-100 scale-100"
                x-transition:leave-end="translate-y-1 opacity-0 scale-[0.98]"
                class="pointer-events-auto flex items-start gap-3 rounded-2xl border border-[var(--primary)]/20 bg-white p-4 shadow-[0_18px_45px_rgba(72,91,105,0.10)]"
                role="status"
            >

                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[var(--surface-soft)] text-[var(--primary)]"
                >

                    <svg
                        class="h-5 w-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        aria-hidden="true"
                    >
                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        />

                        <path d="M12 11v5"/>
                        <path d="M12 8h.01"/>

                    </svg>

                </div>


                <div class="min-w-0 flex-1 pt-0.5">

                    <p class="text-sm font-black text-[var(--primary)]">
                        اطلاع
                    </p>

                    <p class="mt-1 text-sm leading-6 text-[var(--text-secondary)]">
                        {{ session('info') }}
                    </p>

                </div>


                <button
                    type="button"
                    @click="show = false"
                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-[var(--primary)] transition hover:bg-[var(--surface-soft)]"
                    aria-label="بستن پیام"
                >

                    <svg
                        class="h-4 w-4"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        aria-hidden="true"
                    >
                        <path d="m6 6 12 12"/>
                        <path d="M18 6 6 18"/>
                    </svg>

                </button>

            </div>

        @endif

    </div>

@endif
