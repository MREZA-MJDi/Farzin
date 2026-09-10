@extends('layouts.app')

@section('title', 'تماس با فرزین')

@section(
    'meta_description',
    'راه‌های ارتباط با فرزین برای مشاوره، پشتیبانی و پیگیری سفارش.'
)

@section('content')

    <main class="contact-page">

        <section class="section section--sm">

            <div class="container">

                <div class="section__inner">

                    <x-layout.breadcrumb
                        :items="[
                            ['label' => 'تماس با ما']
                        ]"
                    />

                    <header class="page-header">

                        <span class="page-header__eyebrow">
                            تماس با ما
                        </span>

                        <h1 class="page-header__title">
                            در کنار شما هستیم.
                        </h1>

                        <p class="page-header__description">
                            برای مشاوره قبل از خرید یا پیگیری سفارش،
                            با ما در ارتباط باشید.
                        </p>

                    </header>


                    <div class="grid grid-cols-2 gap-8">

                        <div class="card card--padded">

                            <div class="stack stack--lg">

                                <div class="stack stack--xs">

                                    <span class="text-muted text-xs">
                                        تلفن
                                    </span>

                                    <a
                                        href="tel:+982112345678"
                                        class="font-semibold"
                                    >
                                        ۰۲۱-۱۲۳۴۵۶۷۸
                                    </a>

                                </div>


                                <div class="stack stack--xs">

                                    <span class="text-muted text-xs">
                                        ایمیل
                                    </span>

                                    <a
                                        href="mailto:info@example.com"
                                        class="font-semibold"
                                    >
                                        info@example.com
                                    </a>

                                </div>


                                <div class="stack stack--xs">

                                    <span class="text-muted text-xs">
                                        ساعات پاسخگویی
                                    </span>

                                    <span class="font-medium">
                                        شنبه تا پنجشنبه، ۹ تا ۱۸
                                    </span>

                                </div>

                            </div>

                        </div>


                        <div class="card card--padded">

                            <form
                                method="POST"
                                action="{{ route('contact.store') }}"
                            >

                                @csrf

                                <div class="stack stack--md">

                                    <x-ui.input
                                        name="name"
                                        label="نام"
                                        placeholder="نام شما"
                                        required
                                    />

                                    <x-ui.input
                                        name="phone"
                                        label="شماره تماس"
                                        type="tel"
                                        placeholder="۰۹۱۲..."
                                        autocomplete="tel"
                                        required
                                    />

                                    <x-ui.input
                                        name="email"
                                        label="ایمیل"
                                        type="email"
                                        placeholder="example@mail.com"
                                        autocomplete="email"
                                    />

                                    <div class="form-field">

                                        <label
                                            for="message"
                                            class="form-field__label"
                                        >
                                            پیام
                                        </label>

                                        <textarea
                                            id="message"
                                            name="message"
                                            class="form-textarea"
                                            placeholder="پیام خود را بنویسید..."
                                            required
                                        ></textarea>

                                    </div>

                                    <x-ui.button
                                        type="submit"
                                        variant="primary"
                                        size="lg"
                                        full
                                    >
                                        ارسال پیام
                                    </x-ui.button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>

@endsection
