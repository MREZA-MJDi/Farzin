@extends('layouts.app')

@section('title', 'پرداخت لغو شد | فرزین')

@section('content')

    <main class="payment-page">

        <section class="section">

            <div class="container">

                <div class="payment-status">

                    <div
                        class="payment-status__icon payment-status__icon--warning"
                        aria-hidden="true"
                    >
                        !
                    </div>

                    <h1 class="payment-status__title">
                        پرداخت لغو شد
                    </h1>

                    <p class="payment-status__description">
                        پرداخت توسط شما لغو شد و سفارشتان در انتظار پرداخت باقی مانده است.
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

                        </div>

                    @endif


                    <div class="payment-status__actions">

                        <a
                            href="/checkout"
                            class="btn btn--primary"
                        >
                            بازگشت به پرداخت
                        </a>

                        <a
                            href="/cart"
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
