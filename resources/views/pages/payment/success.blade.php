@extends('layouts.app')

@section('title', 'پرداخت موفق | فرزین')

@section('content')

    <main class="payment-page">

        <section class="section">

            <div class="container">

                <div class="payment-status">

                    <div
                        class="payment-status__icon payment-status__icon--success"
                        aria-hidden="true"
                    >
                        ✓
                    </div>

                    <h1 class="payment-status__title">
                        پرداخت با موفقیت انجام شد
                    </h1>

                    <p class="payment-status__description">
                        سفارش شما ثبت شده و اطلاعات آن در سیستم ذخیره شده است.
                    </p>


                    <div class="payment-status__details">

                        <div class="payment-status__row">

                            <span class="payment-status__label">
                                شماره سفارش
                            </span>

                            <strong class="payment-status__value">
                                {{ $order['number'] ?? '---' }}
                            </strong>

                        </div>


                        <div class="payment-status__row">

                            <span class="payment-status__label">
                                مبلغ پرداختی
                            </span>

                            <strong class="payment-status__value">
                                {{ number_format($order['total'] ?? 0) }}
                                تومان
                            </strong>

                        </div>


                        <div class="payment-status__row">

                            <span class="payment-status__label">
                                وضعیت
                            </span>

                            <strong class="payment-status__value text-success">
                                پرداخت موفق
                            </strong>

                        </div>

                    </div>


                    <div class="payment-status__actions">

                        <a
                            href="/"
                            class="btn btn--primary"
                        >
                            بازگشت به خانه
                        </a>

                        <a
                            href="/shop"
                            class="btn btn--outline"
                        >
                            ادامه خرید
                        </a>

                    </div>

                </div>

            </div>

        </section>

    </main>

@endsection
