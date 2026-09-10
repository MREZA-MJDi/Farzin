@extends('layouts.app')

@section('title', 'پرداخت موفق | فرزین')

@section('content')

    <main class="payment-page">

        <section class="section section--lg">

            <div class="container">

                <div class="payment-status">

                    <div
                        class="payment-status__icon payment-status__icon--success"
                        aria-hidden="true"
                    >
                        ✓
                    </div>

                    <div class="stack stack--md">

                        <h1 class="payment-status__title">
                            پرداخت با موفقیت انجام شد
                        </h1>

                        <p class="payment-status__description">
                            سفارش شما ثبت شده و اطلاعات آن در سیستم ذخیره شده است.
                        </p>

                    </div>


                    <div class="stack stack--sm">

                        <div class="inline justify-between">

                            <span class="text-muted">
                                شماره سفارش
                            </span>

                            <strong>
                                {{ $order['number'] ?? '---' }}
                            </strong>

                        </div>

                        <div class="inline justify-between">

                            <span class="text-muted">
                                مبلغ پرداختی
                            </span>

                            <strong>
                                {{ number_format($order['total'] ?? 0) }}
                                تومان
                            </strong>

                        </div>

                        <div class="inline justify-between">

                            <span class="text-muted">
                                وضعیت
                            </span>

                            <strong class="text-success">
                                پرداخت موفق
                            </strong>

                        </div>

                    </div>


                    <div class="payment-status__actions">

                        <a
                            href="{{ route('home') }}"
                            class="btn btn--primary"
                        >
                            بازگشت به خانه
                        </a>

                        <a
                            href="{{ route('shop') }}"
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
