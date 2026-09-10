@extends('layouts.app')

@section('title', 'مجله فرزین | راهنمای هود و سینک')

@section(
    'meta_description',
    'مقالات و راهنماهای فرزین درباره انتخاب هود، سینک، طراحی آشپزخانه و تجهیزات آشپزخانه.'
)

@section('content')

    <main class="blog-page">

        <x-layout.breadcrumb
            :items="[
                ['label' => 'مجله']
            ]"
        />


        <section class="section section--sm">

            <div class="container">

                <header class="page-header">

                    <span class="page-header__eyebrow">
                        مجله فرزین
                    </span>

                    <h1 class="page-header__title">
                        راهنمای انتخاب بهتر
                    </h1>

                    <p class="page-header__description">
                        مطالب کاربردی برای انتخاب هود، سینک و طراحی آشپزخانه.
                    </p>

                </header>


                <div class="blog-grid">

                    @forelse($posts ?? [] as $post)

                        <x-content.blog-card
                            :title="$post['title']"
                            :image="$post['image']"
                            :href="$post['url']"
                            :category="$post['category'] ?? null"
                            :excerpt="$post['excerpt'] ?? null"
                            :meta="$post['meta'] ?? null"
                        />

                    @empty

                        <div class="blog-empty">

                            <x-ui.empty-state>
                                هنوز مقاله‌ای منتشر نشده است.
                            </x-ui.empty-state>

                        </div>

                    @endforelse

                </div>

            </div>

        </section>

    </main>

@endsection
