@extends('layouts.app')

@section('title', 'افزودن آدرس | فرزین')

@section('meta_description', 'ثبت آدرس جدید و موقعیت دقیق تحویل در فرزین')

@push('styles')

    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    >

    <style>
        #addressMap {
            height: 360px;
            width: 100%;
            z-index: 1;
        }

        .leaflet-container {
            font-family: inherit;
        }
    </style>

@endpush


@section('content')

    <div class="min-h-screen bg-[var(--color-neutral-50)]">

        <section class="mx-auto max-w-4xl px-4 py-7 sm:px-6 sm:py-9 lg:px-8 lg:py-11">

            {{-- =========================================================
                HEADER
            ========================================================== --}}

            <header class="mb-7">

                <a
                    href="{{ route('customer.addresses.index') }}"
                    class="mb-4 inline-flex items-center gap-2 text-[10px] font-black text-[var(--color-text-muted)] transition hover:text-[var(--color-brand-700)]"
                >

                    <svg
                        class="h-3.5 w-3.5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path d="m15 18-6-6 6-6"/>
                    </svg>

                    بازگشت به آدرس‌ها

                </a>


                <div class="inline-flex items-center gap-2 text-[9px] font-black uppercase tracking-[0.2em] text-[var(--color-accent-600)] sm:text-[10px]">

                    <span class="h-1.5 w-1.5 rounded-full bg-[var(--color-accent-600)]"></span>

                    New Address

                </div>


                <h1 class="mt-2 text-2xl font-black tracking-tight text-[var(--color-text-primary)] sm:text-3xl">
                    افزودن آدرس جدید
                </h1>


                <p class="mt-1.5 text-xs leading-6 text-[var(--color-text-secondary)] sm:text-sm">
                    اطلاعات گیرنده را وارد کنید و محل دقیق تحویل را روی نقشه مشخص کنید.
                </p>

            </header>


            {{-- =========================================================
                ERRORS
            ========================================================== --}}

            @if($errors->any())

                <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-4">

                    <div class="text-xs font-black text-red-700">
                        لطفاً اطلاعات فرم را بررسی کنید.
                    </div>

                    <ul class="mt-2 space-y-1 text-[11px] leading-5 text-red-600">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- =========================================================
                FORM
            ========================================================== --}}

            <form
                id="addressForm"
                action="{{ route('customer.addresses.store') }}"
                method="POST"
                class="space-y-5"
            >

                @csrf


                {{-- =====================================================
                    MAP
                ====================================================== --}}

                <section class="overflow-hidden rounded-2xl border border-[var(--color-border)] bg-white shadow-[var(--shadow-xs)]">

                    <div class="border-b border-[var(--color-border)] px-5 py-5 sm:px-6">

                        <div class="flex items-start justify-between gap-4">

                            <div>

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[var(--color-brand-50)] text-[var(--color-brand-700)]">

                                        <svg
                                            class="h-5 w-5"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.7"
                                        >
                                            <path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/>
                                            <circle cx="12" cy="10" r="2.5"/>
                                        </svg>

                                    </div>


                                    <div>

                                        <h2 class="text-base font-black text-[var(--color-text-primary)]">
                                            موقعیت تحویل
                                        </h2>

                                        <p class="mt-0.5 text-[10px] leading-5 text-[var(--color-text-muted)]">
                                            محل دقیق تحویل را روی نقشه مشخص کنید.
                                        </p>

                                    </div>

                                </div>

                            </div>


                            <button
                                type="button"
                                id="locateMeButton"
                                class="inline-flex shrink-0 items-center gap-1.5 rounded-xl border border-[var(--color-border)] bg-white px-3 py-2 text-[9px] font-black text-[var(--color-text-secondary)] transition hover:border-[var(--color-brand-300)] hover:bg-[var(--color-brand-50)] hover:text-[var(--color-brand-700)] disabled:cursor-wait disabled:opacity-60"
                            >

                                <svg
                                    class="h-3.5 w-3.5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <circle cx="12" cy="12" r="7"/>
                                    <circle cx="12" cy="12" r="2"/>
                                    <path d="M12 2v3M12 19v3M2 12h3M19 12h3"/>
                                </svg>

                                موقعیت من

                            </button>

                        </div>

                    </div>


                    <div class="p-5 sm:p-6">

                        <div
                            id="addressMap"
                            class="overflow-hidden rounded-2xl border border-[var(--color-border)] bg-[var(--color-neutral-100)]"
                        ></div>


                        <div class="mt-3 flex flex-wrap items-center justify-between gap-2">

                            <p class="text-[10px] leading-5 text-[var(--color-text-muted)]">
                                روی نقشه کلیک کنید یا نشانگر را جابه‌جا کنید.
                            </p>


                            <p
                                id="mapStatus"
                                class="text-[10px] font-bold text-[var(--color-text-muted)]"
                            >
                                موقعیت اولیه انتخاب شده است
                            </p>

                        </div>


                        <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">

                            <div>

                                <label
                                    for="latitude"
                                    class="mb-2 block text-[10px] font-black text-[var(--color-text-primary)]"
                                >
                                    Latitude
                                </label>

                                <input
                                    id="latitude"
                                    name="latitude"
                                    type="text"
                                    value="{{ old('latitude') }}"
                                    readonly
                                    required
                                    dir="ltr"
                                    class="w-full rounded-xl border border-[var(--color-border)] bg-[var(--color-neutral-50)] px-4 py-3 text-xs text-[var(--color-text-secondary)] outline-none"
                                >

                                @error('latitude')

                                <p class="mt-1.5 text-[10px] text-red-600">
                                    {{ $message }}
                                </p>

                                @enderror

                            </div>


                            <div>

                                <label
                                    for="longitude"
                                    class="mb-2 block text-[10px] font-black text-[var(--color-text-primary)]"
                                >
                                    Longitude
                                </label>

                                <input
                                    id="longitude"
                                    name="longitude"
                                    type="text"
                                    value="{{ old('longitude') }}"
                                    readonly
                                    required
                                    dir="ltr"
                                    class="w-full rounded-xl border border-[var(--color-border)] bg-[var(--color-neutral-50)] px-4 py-3 text-xs text-[var(--color-text-secondary)] outline-none"
                                >

                                @error('longitude')

                                <p class="mt-1.5 text-[10px] text-red-600">
                                    {{ $message }}
                                </p>

                                @enderror

                            </div>

                        </div>

                    </div>

                </section>


                {{-- =====================================================
                    ADDRESS DATA
                ====================================================== --}}

                <section class="rounded-2xl border border-[var(--color-border)] bg-white p-5 shadow-[var(--shadow-xs)] sm:p-6">

                    <div class="mb-5">

                        <h2 class="text-base font-black text-[var(--color-text-primary)]">
                            اطلاعات آدرس
                        </h2>

                        <p class="mt-1 text-[10px] leading-5 text-[var(--color-text-muted)]">
                            اطلاعات آدرس و گیرنده را وارد کنید.
                        </p>

                    </div>


                    {{-- Title / Country --}}
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">

                        <div>

                            <label
                                for="title"
                                class="mb-2 block text-[10px] font-black text-[var(--color-text-primary)]"
                            >
                                عنوان آدرس
                            </label>

                            <input
                                id="title"
                                name="title"
                                type="text"
                                value="{{ old('title') }}"
                                placeholder="خانه، محل کار..."
                                class="w-full rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 text-xs text-[var(--color-text-primary)] outline-none transition placeholder:text-[var(--color-text-muted)] focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)]"
                            >

                            @error('title')

                            <p class="mt-1.5 text-[10px] text-red-600">
                                {{ $message }}
                            </p>

                            @enderror

                        </div>


                        <div>

                            <label
                                for="country"
                                class="mb-2 block text-[10px] font-black text-[var(--color-text-primary)]"
                            >
                                کشور
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="country"
                                name="country"
                                type="text"
                                value="{{ old('country', 'ایران') }}"
                                required
                                class="w-full rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 text-xs text-[var(--color-text-primary)] outline-none transition focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)]"
                            >

                            @error('country')

                            <p class="mt-1.5 text-[10px] text-red-600">
                                {{ $message }}
                            </p>

                            @enderror

                        </div>

                    </div>


                    {{-- Full name / Phone --}}
                    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">

                        <div>

                            <label
                                for="full_name"
                                class="mb-2 block text-[10px] font-black text-[var(--color-text-primary)]"
                            >
                                نام گیرنده
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="full_name"
                                name="full_name"
                                type="text"
                                value="{{ old('full_name', auth()->user()->name) }}"
                                required
                                class="w-full rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 text-xs text-[var(--color-text-primary)] outline-none transition focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)]"
                            >

                            @error('full_name')

                            <p class="mt-1.5 text-[10px] text-red-600">
                                {{ $message }}
                            </p>

                            @enderror

                        </div>


                        <div>

                            <label
                                for="phone"
                                class="mb-2 block text-[10px] font-black text-[var(--color-text-primary)]"
                            >
                                شماره تماس
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="phone"
                                name="phone"
                                type="text"
                                value="{{ old('phone', auth()->user()->phone) }}"
                                required
                                dir="ltr"
                                placeholder="09120000000"
                                class="w-full rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 text-xs text-[var(--color-text-primary)] outline-none transition placeholder:text-[var(--color-text-muted)] focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)]"
                            >

                            @error('phone')

                            <p class="mt-1.5 text-[10px] text-red-600">
                                {{ $message }}
                            </p>

                            @enderror

                        </div>

                    </div>


                    {{-- Province / City --}}
                    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">

                        <div>

                            <label
                                for="province"
                                class="mb-2 block text-[10px] font-black text-[var(--color-text-primary)]"
                            >
                                استان
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="province"
                                name="province"
                                type="text"
                                value="{{ old('province') }}"
                                required
                                placeholder="مثلاً تهران"
                                class="w-full rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 text-xs text-[var(--color-text-primary)] outline-none transition placeholder:text-[var(--color-text-muted)] focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)]"
                            >

                            @error('province')

                            <p class="mt-1.5 text-[10px] text-red-600">
                                {{ $message }}
                            </p>

                            @enderror

                        </div>


                        <div>

                            <label
                                for="city"
                                class="mb-2 block text-[10px] font-black text-[var(--color-text-primary)]"
                            >
                                شهر
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="city"
                                name="city"
                                type="text"
                                value="{{ old('city') }}"
                                required
                                placeholder="مثلاً تهران"
                                class="w-full rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 text-xs text-[var(--color-text-primary)] outline-none transition placeholder:text-[var(--color-text-muted)] focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)]"
                            >

                            @error('city')

                            <p class="mt-1.5 text-[10px] text-red-600">
                                {{ $message }}
                            </p>

                            @enderror

                        </div>

                    </div>


                    {{-- Postal code --}}
                    <div class="mt-4">

                        <label
                            for="postal_code"
                            class="mb-2 block text-[10px] font-black text-[var(--color-text-primary)]"
                        >
                            کد پستی
                        </label>

                        <input
                            id="postal_code"
                            name="postal_code"
                            type="text"
                            value="{{ old('postal_code') }}"
                            dir="ltr"
                            placeholder="1234567890"
                            class="w-full rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 text-xs text-[var(--color-text-primary)] outline-none transition placeholder:text-[var(--color-text-muted)] focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)]"
                        >

                        @error('postal_code')

                        <p class="mt-1.5 text-[10px] text-red-600">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>


                    {{-- Full address --}}
                    <div class="mt-4">

                        <label
                            for="address"
                            class="mb-2 block text-[10px] font-black text-[var(--color-text-primary)]"
                        >
                            آدرس کامل
                            <span class="text-red-500">*</span>
                        </label>

                        <textarea
                            id="address"
                            name="address"
                            rows="4"
                            required
                            placeholder="خیابان، کوچه، پلاک، واحد و سایر جزئیات..."
                            class="w-full resize-y rounded-xl border border-[var(--color-border)] bg-white px-4 py-3 text-xs leading-7 text-[var(--color-text-primary)] outline-none transition placeholder:text-[var(--color-text-muted)] focus:border-[var(--color-brand-600)] focus:ring-4 focus:ring-[var(--color-brand-100)]"
                        >{{ old('address') }}</textarea>

                        @error('address')

                        <p class="mt-1.5 text-[10px] text-red-600">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>


                    {{-- Default --}}
                    <label class="mt-4 flex cursor-pointer items-center gap-3 rounded-xl border border-[var(--color-border)] bg-[var(--color-neutral-50)] p-4">

                        <input
                            type="checkbox"
                            name="is_default"
                            value="1"
                            @checked(old('is_default'))
                        class="h-4 w-4 rounded border-[var(--color-border)] text-[var(--color-brand-600)] focus:ring-[var(--color-brand-600)]"
                        >


                        <span>

                            <span class="block text-xs font-black text-[var(--color-text-primary)]">
                                ذخیره به‌عنوان آدرس پیش‌فرض
                            </span>

                            <span class="mt-0.5 block text-[10px] leading-5 text-[var(--color-text-muted)]">
                                برای سفارش‌های بعدی این آدرس به‌صورت پیش‌فرض انتخاب می‌شود.
                            </span>

                        </span>

                    </label>


                    {{-- Actions --}}
                    <div class="mt-5 flex flex-col-reverse gap-3 sm:flex-row">

                        <a
                            href="{{ route('customer.addresses.index') }}"
                            class="inline-flex flex-1 items-center justify-center rounded-xl border border-[var(--color-border)] bg-white px-5 py-3.5 text-xs font-black text-[var(--color-text-secondary)] transition hover:bg-[var(--color-neutral-50)]"
                        >
                            انصراف
                        </a>


                        <button
                            type="submit"
                            class="group inline-flex flex-1 items-center justify-center gap-2 rounded-xl bg-[var(--color-brand-600)] px-5 py-3.5 text-xs font-black text-white transition hover:bg-[var(--color-brand-700)] focus:outline-none focus:ring-4 focus:ring-[var(--color-brand-100)]"
                        >

                            ذخیره آدرس

                            <svg
                                class="h-4 w-4 transition duration-300 group-hover:-translate-x-1"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path d="m9 18 6-6-6-6"/>
                            </svg>

                        </button>

                    </div>

                </section>

            </form>

        </section>

    </div>

@endsection


@push('scripts')

    <script
        src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    ></script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const mapElement =
                document.getElementById('addressMap');

            const latitudeInput =
                document.getElementById('latitude');

            const longitudeInput =
                document.getElementById('longitude');

            const locateMeButton =
                document.getElementById('locateMeButton');

            const mapStatus =
                document.getElementById('mapStatus');


            if (
                !mapElement ||
                !latitudeInput ||
                !longitudeInput ||
                typeof L === 'undefined'
            ) {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Default location
            |--------------------------------------------------------------------------
            */

            const fallbackLatitude = 35.6892;
            const fallbackLongitude = 51.3890;


            /*
            |--------------------------------------------------------------------------
            | Initial coordinates
            |--------------------------------------------------------------------------
            */

            const oldLatitude =
                parseFloat(latitudeInput.value);

            const oldLongitude =
                parseFloat(longitudeInput.value);


            const hasOldCoordinates =
                Number.isFinite(oldLatitude) &&
                Number.isFinite(oldLongitude);


            const initialLatitude =
                hasOldCoordinates
                    ? oldLatitude
                    : fallbackLatitude;


            const initialLongitude =
                hasOldCoordinates
                    ? oldLongitude
                    : fallbackLongitude;


            /*
            |--------------------------------------------------------------------------
            | Map
            |--------------------------------------------------------------------------
            */

            const map =
                L.map(mapElement, {
                    zoomControl: true,
                    attributionControl: true,
                }).setView(
                    [
                        initialLatitude,
                        initialLongitude,
                    ],
                    hasOldCoordinates ? 16 : 12
                );


            L.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                {
                    maxZoom: 19,
                    attribution:
                        '&copy; OpenStreetMap contributors',
                }
            ).addTo(map);


            /*
            |--------------------------------------------------------------------------
            | Marker
            |--------------------------------------------------------------------------
            */

            const marker =
                L.marker(
                    [
                        initialLatitude,
                        initialLongitude,
                    ],
                    {
                        draggable: true,
                    }
                ).addTo(map);


            /*
            |--------------------------------------------------------------------------
            | Set coordinates
            |--------------------------------------------------------------------------
            */

            function setCoordinates(
                latitude,
                longitude,
                center = true
            ) {

                const lat = Number(latitude);
                const lng = Number(longitude);


                if (
                    !Number.isFinite(lat) ||
                    !Number.isFinite(lng)
                ) {
                    return false;
                }


                latitudeInput.value =
                    lat.toFixed(7);

                longitudeInput.value =
                    lng.toFixed(7);


                marker.setLatLng([
                    lat,
                    lng,
                ]);


                if (center) {

                    map.setView(
                        [
                            lat,
                            lng,
                        ],
                        Math.max(
                            map.getZoom(),
                            15
                        )
                    );

                }


                if (mapStatus) {

                    mapStatus.textContent =
                        'موقعیت انتخاب شد';

                    mapStatus.className =
                        'text-[10px] font-bold text-emerald-600';

                }


                return true;
            }


            /*
            |--------------------------------------------------------------------------
            | Initial coordinates
            |--------------------------------------------------------------------------
            */

            setCoordinates(
                initialLatitude,
                initialLongitude,
                false
            );


            /*
            |--------------------------------------------------------------------------
            | Click on map
            |--------------------------------------------------------------------------
            */

            map.on(
                'click',
                function (event) {

                    setCoordinates(
                        event.latlng.lat,
                        event.latlng.lng
                    );

                }
            );


            /*
            |--------------------------------------------------------------------------
            | Drag marker
            |--------------------------------------------------------------------------
            */

            marker.on(
                'dragend',
                function () {

                    const position =
                        marker.getLatLng();

                    setCoordinates(
                        position.lat,
                        position.lng,
                        false
                    );

                }
            );


            /*
            |--------------------------------------------------------------------------
            | Browser geolocation
            |--------------------------------------------------------------------------
            */

            if (locateMeButton) {

                locateMeButton.addEventListener(
                    'click',
                    function () {

                        if (
                            !navigator.geolocation
                        ) {

                            if (mapStatus) {

                                mapStatus.textContent =
                                    'مرورگر شما از موقعیت مکانی پشتیبانی نمی‌کند.';

                                mapStatus.className =
                                    'text-[10px] font-bold text-red-600';

                            }

                            return;
                        }


                        locateMeButton.disabled = true;


                        if (mapStatus) {

                            mapStatus.textContent =
                                'در حال دریافت موقعیت...';

                            mapStatus.className =
                                'text-[10px] font-bold text-[var(--color-text-muted)]';

                        }


                        navigator.geolocation.getCurrentPosition(

                            function (position) {

                                setCoordinates(
                                    position.coords.latitude,
                                    position.coords.longitude
                                );


                                locateMeButton.disabled =
                                    false;

                            },

                            function (error) {

                                let message =
                                    'دریافت موقعیت انجام نشد.';


                                if (
                                    error.code ===
                                    error.PERMISSION_DENIED
                                ) {

                                    message =
                                        'اجازه دسترسی به موقعیت مکانی داده نشد.';

                                } else if (
                                    error.code ===
                                    error.POSITION_UNAVAILABLE
                                ) {

                                    message =
                                        'موقعیت مکانی در دسترس نیست.';

                                } else if (
                                    error.code ===
                                    error.TIMEOUT
                                ) {

                                    message =
                                        'دریافت موقعیت بیش از حد طول کشید.';

                                }


                                if (mapStatus) {

                                    mapStatus.textContent =
                                        message;

                                    mapStatus.className =
                                        'text-[10px] font-bold text-red-600';

                                }


                                locateMeButton.disabled =
                                    false;

                            },

                            {
                                enableHighAccuracy: true,
                                timeout: 10000,
                                maximumAge: 0,
                            }
                        );

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Map resize
            |--------------------------------------------------------------------------
            */

            function refreshMap() {

                setTimeout(
                    function () {

                        map.invalidateSize({
                            pan: false,
                        });

                    },
                    150
                );

            }


            refreshMap();


            setTimeout(
                refreshMap,
                500
            );


            window.addEventListener(
                'resize',
                refreshMap
            );


            /*
            |--------------------------------------------------------------------------
            | Form validation
            |--------------------------------------------------------------------------
            */

            const form =
                document.getElementById(
                    'addressForm'
                );


            if (form) {

                form.addEventListener(
                    'submit',
                    function (event) {

                        const latitude =
                            parseFloat(
                                latitudeInput.value
                            );

                        const longitude =
                            parseFloat(
                                longitudeInput.value
                            );


                        if (
                            !Number.isFinite(latitude) ||
                            !Number.isFinite(longitude)
                        ) {

                            event.preventDefault();


                            if (mapStatus) {

                                mapStatus.textContent =
                                    'ابتدا موقعیت آدرس را روی نقشه انتخاب کنید.';

                                mapStatus.className =
                                    'text-[10px] font-bold text-red-600';

                            }


                            mapElement.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center',
                            });

                        }

                    }
                );

            }

        });
    </script>

@endpush
