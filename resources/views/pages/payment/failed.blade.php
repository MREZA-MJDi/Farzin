@extends('layouts.app')

@section('title', 'پرداخت ناموفق | فرزین')

@section('content')

    <main class="payment-page">

        <section class="section">

            <div class="container">

                <div class="payment-status">

                    <div
                        class="payment-status__icon payment-status__icon--danger"
                        aria-hidden="true"
                    >
                        ×
                    </div>

                    <h1 class="payment-status__title">
                        پرداخت انجام نشد
                    </h1>

                    <p class="payment-status__description">
                        پرداخت سفارش شما موفق نبود. می‌توانید دوباره برای پرداخت اقدام کنید.
                    </p>


                    @if(!empty($order['number']))

                        <div class="payment-status__details">

                            <div class="payment-status__row">

                                <span class="payment-status__label">
                                    شماره سفارش
                                </span>

                                <strong class="payment-status__value">
                                    {{ $order['number'] }}
                                </strong>

                            </div>

                            @if(!empty($payment['message']))

                                <div class="payment-status__row">

                                    <span class="payment-status__label">
                                        پیام
                                    </span>

                                    <strong class="payment-status__value">
                                        {{ $payment['message'] }}
                                    </strong>

                                </div>

                            @endif

                        </div>

                    @endif


                    <div class="payment-status__actions">

                        <a
                            href="/checkout"
                            class="btn btn--primary"
                        >
                            تلاش دوباره
                        </a>

                        <a
                            href="/cart"
                            class="btn btn--outline"
                        >
                            بازگشت به سبد خرید
                        </a>

                    </div>

                </div>

            </div>

        </section>

    </main>

@endsection
