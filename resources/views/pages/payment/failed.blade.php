@extends('layouts.app')

@section('title', 'پرداخت ناموفق | فرزین')

@section('content')

    <main class="payment-page">

        <section class="section section--lg">

            <div class="container">

                <div class="payment-status">

                    <div
                        class="payment-status__icon payment-status__icon--danger"
                        aria-hidden="true"
                    >
                        ×
                    </div>

                    <div class="stack stack--md">

                        <h1 class="payment-status__title">
                            پرداخت انجام نشد
                        </h1>

                        <p class="payment-status__description">
                            پرداخت سفارش شما موفق نبود.
                            می‌توانید دوباره برای پرداخت اقدام کنید.
                        </p>

                    </div>


                    @if(!empty($order['number']))

                        <div class="stack stack--sm">

                            <div class="inline justify-between">

                                <span class="text-muted">
                                    شماره سفارش
                                </span>

                                <strong>
                                    {{ $order['number'] }}
                                </strong>

                            </div>

                            @if(!empty($payment['message']))

                                <div class="inline justify-between">

                                    <span class="text-muted">
                                        پیام
                                    </span>

                                    <strong>
                                        {{ $payment['message'] }}
                                    </strong>

                                </div>

                            @endif

                        </div>

                    @endif


                    <div class="payment-status__actions">

                        <a
                            href="{{ route('checkout') }}"
                            class="btn btn--primary"
                        >
                            تلاش دوباره
                        </a>

                        <a
                            href="{{ route('cart') }}"
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
