@extends('layouts.checkout')

@section('title', 'تکمیل سفارش | فرزین')

@section(
    'meta_description',
    'تکمیل اطلاعات سفارش و پرداخت در فرزین.'
)

@section('content')

    <main class="checkout">

        <section class="section section--sm">

            <div class="container">

                <form
                    id="checkout-form"
                    method="POST"
                    action="{{ route('checkout.store') }}"
                >

                    @csrf

                    <div class="checkout__layout">

                        <div class="checkout__main">

                            <x-checkout.checkout-step
                                number="۱"
                                title="اطلاعات تماس"
                            >

                                <div class="stack stack--md">

                                    <x-ui.input
                                        name="first_name"
                                        label="نام"
                                        placeholder="نام"
                                        autocomplete="given-name"
                                        required
                                    />

                                    <x-ui.input
                                        name="last_name"
                                        label="نام خانوادگی"
                                        placeholder="نام خانوادگی"
                                        autocomplete="family-name"
                                        required
                                    />

                                    <x-ui.input
                                        name="phone"
                                        label="شماره موبایل"
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

                                </div>

                            </x-checkout.checkout-step>


                            <x-checkout.checkout-step
                                number="۲"
                                title="آدرس ارسال"
                            >

                                <div class="stack stack--md">

                                    <x-ui.input
                                        name="province"
                                        label="استان"
                                        placeholder="استان"
                                        autocomplete="address-level1"
                                        required
                                    />

                                    <x-ui.input
                                        name="city"
                                        label="شهر"
                                        placeholder="شهر"
                                        autocomplete="address-level2"
                                        required
                                    />

                                    <x-ui.input
                                        name="postal_code"
                                        label="کد پستی"
                                        placeholder="کد پستی"
                                        inputmode="numeric"
                                        autocomplete="postal-code"
                                        required
                                    />

                                    <div class="form-field">

                                        <label
                                            for="address"
                                            class="form-field__label"
                                        >
                                            آدرس کامل
                                            <span
                                                class="form-field__required"
                                                aria-hidden="true"
                                            >
                                                *
                                            </span>
                                        </label>

                                        <textarea
                                            id="address"
                                            name="address"
                                            class="form-textarea"
                                            placeholder="آدرس کامل خود را وارد کنید..."
                                            autocomplete="street-address"
                                            required
                                        ></textarea>

                                    </div>

                                </div>

                            </x-checkout.checkout-step>


                            <x-checkout.checkout-step
                                number="۳"
                                title="روش پرداخت"
                            >

                                <div class="payment-methods">

                                    <x-checkout.payment-method
                                        value="online"
                                        title="پرداخت آنلاین"
                                        description="پرداخت امن از طریق درگاه بانکی"
                                        :checked="true"
                                    />

                                </div>

                            </x-checkout.checkout-step>


                            <button
                                type="submit"
                                class="btn btn--primary btn--lg btn--full"
                            >
                                ثبت سفارش و پرداخت
                            </button>

                        </div>


                        <aside class="checkout__sidebar">

                            <x-checkout.order-summary
                                :items="$items ?? []"
                                :subtotal="$subtotal ?? 0"
                                :shipping="$shipping ?? 0"
                                :discount="$discount ?? 0"
                                :total="$total ?? 0"
                            />

                        </aside>

                    </div>

                </form>

            </div>

        </section>

    </main>

@endsection
