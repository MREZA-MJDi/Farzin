@extends('layouts.app')

@section('title', 'سبد خرید | فرزین')

@section(
    'meta_description',
    'مشاهده و مدیریت سبد خرید محصولات فرزین.'
)

@section('content')

    <main class="cart-page">

        <x-layout.breadcrumb
            :items="[
                ['label' => 'سبد خرید']
            ]"
        />


        <section class="section section--sm">

            <div class="container">

                <header class="page-header">

                    <span class="page-header__eyebrow">
                        سبد خرید
                    </span>

                    <h1 class="page-header__title">
                        سفارش شما
                    </h1>

                </header>


                @if(!empty($items))

                    <div class="cart-layout">

                        <div class="cart-layout__items">

                            @foreach($items as $item)

                                <x-cart.cart-item
                                    :item="$item"
                                />

                            @endforeach

                        </div>


                        <aside class="cart-layout__sidebar">

                            <x-cart.cart-summary
                                :subtotal="$subtotal ?? 0"
                                :shipping="$shipping ?? 0"
                                :discount="$discount ?? 0"
                                :total="$total ?? 0"
                            />


                            <a
                                href="/checkout"
                                class="btn btn--primary btn--lg btn--full"
                                style="margin-top: var(--space-5);"
                            >
                                ادامه و پرداخت
                            </a>

                        </aside>

                    </div>

                @else

                    <x-ui.empty-state>
                        <x-slot:icon>
                            🛒
                        </x-slot:icon>

                        سبد خرید شما خالی است.

                        <x-slot:action>
                            <a
                                href="/shop"
                                class="btn btn--primary"
                            >
                                مشاهده محصولات
                            </a>
                        </x-slot:action>
                    </x-ui.empty-state>

                @endif

            </div>

        </section>

    </main>

@endsection
