@extends('layouts.app')

@section('title', 'پرداخت لغو شد | فرزین')

@section('content')

    <main class="payment-page">

        <section class="section section--lg">

            <div class="container">

                <div class="payment-status">

                    <div
                        class="payment-status__icon payment-status__icon--warning"
                        aria-hidden="true"
                    >
                        !
                    </div>

                    <div class="stack stack--md">

                        <h1 class="payment-status__title">
                            پرداخت لغو شد
                        </h1>

                        <p class="payment-status__description">
                            پرداخت توسط شما لغو شد و سفارشتان
                            در انتظار پرداخت باقی مانده است.
                        </p>

                    </div>


                    @if(!empty($order['number']))

                        <div class="inline justify-between">

                            <span class="text-muted">
                                شماره سفارش
                            </span>

                            <strong>
                                {{ $order['number'] }}
                            </strong>

                        </div>

                    @endif


                    <div class="payment-status__actions">

                        <a
                            href="{{ route('checkout') }}"
                            class="btn btn--primary"
                        >
                            بازگشت به پرداخت
                        </a>

                        <a
                            href="{{ route('cart') }}"
                            class="btn btn--outline"
                        >
                            سبد خرید
                        </a>

                    </div>

                </div>

            </div>

        </section>

    </main>

@endsection
