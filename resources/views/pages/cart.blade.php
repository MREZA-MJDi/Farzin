@extends('layouts.app')

@section('title', 'سبد خرید | فرزین')

@section(
    'meta_description',
    'مشاهده و مدیریت سبد خرید محصولات فرزین.'
)

@section('content')

    <main class="cart-page">

        <section class="section section--sm">

            <div class="container">

                <div class="section__inner">

                    <x-layout.breadcrumb
                        :items="[
                            ['label' => 'سبد خرید']
                        ]"
                    />

                    <header class="page-header">

                        <span class="page-header__eyebrow">
                            سبد خرید
                        </span>

                        <h1 class="page-header__title">
                            سفارش شما
                        </h1>

                    </header>


                    @if(!empty($items))

                        <div class="grid grid-cols-2 gap-8">

                            <div class="stack stack--sm">

                                @foreach($items as $item)

                                    <x-cart.cart-item
                                        :item="$item"
                                    />

                                @endforeach

                            </div>


                            <aside class="stack stack--md">

                                <x-cart.cart-summary
                                    :subtotal="$subtotal ?? 0"
                                    :shipping="$shipping ?? 0"
                                    :discount="$discount ?? 0"
                                    :total="$total ?? 0"
                                />

                                <a
                                    href="{{ route('checkout') }}"
                                    class="btn btn--primary btn--lg btn--full"
                                >
                                    ادامه و پرداخت
                                </a>

                            </aside>

                        </div>

                    @else

                        <x-ui.empty-state
                            title="سبد خرید شما خالی است"
                            description="هنوز محصولی به سبد خریدتان اضافه نکرده‌اید."
                        >

                            <x-slot:icon>
                                🛒
                            </x-slot:icon>

                            <x-slot:action>
                                <a
                                    href="{{ route('shop') }}"
                                    class="btn btn--primary"
                                >
                                    مشاهده محصولات
                                </a>
                            </x-slot:action>

                        </x-ui.empty-state>

                    @endif

                </div>

            </div>

        </section>

    </main>

@endsection
