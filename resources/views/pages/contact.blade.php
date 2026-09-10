@extends('layouts.app')

@section('title', 'تماس با فرزین')

@section(
    'meta_description',
    'راه‌های ارتباط با فرزین برای مشاوره، پشتیبانی و پیگیری سفارش.'
)

@section('content')

    <main class="contact-page">

        <x-layout.breadcrumb
            :items="[
                ['label' => 'تماس با ما']
            ]"
        />


        <section class="section section--sm">

            <div class="container">

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


                <div class="contact-layout">

                    <div class="contact-layout__info">

                        <div class="contact-item">

                            <span class="contact-item__label">
                                تلفن
                            </span>

                            <a
                                href="tel:+982112345678"
                                class="contact-item__value"
                            >
                                ۰۲۱-۱۲۳۴۵۶۷۸
                            </a>

                        </div>


                        <div class="contact-item">

                            <span class="contact-item__label">
                                ایمیل
                            </span>

                            <a
                                href="mailto:info@example.com"
                                class="contact-item__value"
                            >
                                info@example.com
                            </a>

                        </div>


                        <div class="contact-item">

                            <span class="contact-item__label">
                                ساعات پاسخگویی
                            </span>

                            <span class="contact-item__value">
                                شنبه تا پنجشنبه، ۹ تا ۱۸
                            </span>

                        </div>

                    </div>


                    <div class="contact-layout__form">

                        <form
                            method="POST"
                            action="/contact"
                            class="card card__body"
                        >

                            @csrf

                            <div class="stack stack-5">

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
                                    required
                                />

                                <x-ui.input
                                    name="email"
                                    label="ایمیل"
                                    type="email"
                                    placeholder="example@mail.com"
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
                                        class="form-input form-textarea"
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

        </section>

    </main>

@endsection
