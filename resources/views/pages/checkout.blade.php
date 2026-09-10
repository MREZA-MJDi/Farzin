@extends('layouts.checkout')

@section('title', 'تکمیل سفارش | فرزین')

@section(
    'meta_description',
    'تکمیل اطلاعات سفارش و پرداخت در فرزین.'
)

@section('content')

    <main class="checkout">

        <div class="container">

            <div class="checkout__layout">


                <div class="checkout__main">

                    <form
                        id="checkout-form"
                        method="POST"
                        action="/checkout"
                    >

                        @csrf


                        <x-checkout.checkout-step
                            number="۱"
                            title="اطلاعات تماس"
                        >

                            <div class="checkout-form">

                                <div>
                                    <x-ui.input
                                        name="first_name"
                                        label="نام"
                                        placeholder="نام"
                                        required
                                    />
                                </div>

                                <div>
                                    <x-ui.input
                                        name="last_name"
                                        label="نام خانوادگی"
                                        placeholder="نام خانوادگی"
                                        required
                                    />
                                </div>

                                <div>
                                    <x-ui.input
                                        name="phone"
                                        label="شماره موبایل"
                                        type="tel"
                                        placeholder="۰۹۱۲..."
                                        autocomplete="tel"
                                        required
                                    />
                                </div>

                                <div>
                                    <x-ui.input
                                        name="email"
                                        label="ایمیل"
                                        type="email"
                                        placeholder="example@mail.com"
                                        autocomplete="email"
                                    />
                                </div>

                            </div>

                        </x-checkout.checkout-step>


                        <x-checkout.checkout-step
                            number="۲"
                            title="آدرس ارسال"
                        >

                            <div class="checkout-form">

                                <div class="checkout-form__full">

                                    <x-ui.input
                                        name="province"
                                        label="استان"
                                        placeholder="استان"
                                        required
                                    />

                                </div>


                                <div>

                                    <x-ui.input
                                        name="city"
                                        label="شهر"
                                        placeholder="شهر"
                                        required
                                    />

                                </div>


                                <div>

                                    <x-ui.input
                                        name="postal_code"
                                        label="کد پستی"
                                        placeholder="کد پستی"
                                        inputmode="numeric"
                                        required
                                    />

                                </div>


                                <div class="checkout-form__full">

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
                                        class="form-input form-textarea"
                                        placeholder="آدرس کامل خود را وارد کنید..."
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
                            style="margin-top: var(--space-5);"
                        >
                            ثبت سفارش و پرداخت
                        </button>

                    </form>

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

        </div>

    </main>

@endsection
