@extends('layouts.app')

@section('title', 'مجله فرزین | راهنمای هود و سینک')

@section(
    'meta_description',
    'مقالات و راهنماهای فرزین درباره انتخاب هود، سینک، طراحی آشپزخانه و تجهیزات آشپزخانه.'
)

@section('content')

    <main class="blog-page">

        <section class="section section--sm">

            <div class="container">

                <div class="section__inner">

                    <x-layout.breadcrumb
                        :items="[
                            ['label' => 'مجله']
                        ]"
                    />

                    <header class="page-header">

                        <span class="page-header__eyebrow">
                            مجله فرزین
                        </span>

                        <h1 class="page-header__title">
                            راهنمای انتخاب بهتر
                        </h1>

                        <p class="page-header__description">
                            مطالب کاربردی برای انتخاب هود،
                            سینک و طراحی آشپزخانه.
                        </p>

                    </header>


                    @if(!empty($posts))

                        <div class="blog-grid">

                            @foreach($posts as $post)

                                <x-content.blog-card
                                    :title="$post['title']"
                                    :image="$post['image']"
                                    :href="$post['url']"
                                    :category="$post['category'] ?? null"
                                    :excerpt="$post['excerpt'] ?? null"
                                    :meta="$post['meta'] ?? null"
                                />

                            @endforeach

                        </div>

                    @else

                        <x-ui.empty-state
                            title="هنوز مقاله‌ای منتشر نشده است"
                            description="به‌زودی مطالب کاربردی جدیدی در مجله فرزین منتشر می‌کنیم."
                        />

                    @endif

                </div>

            </div>

        </section>

    </main>

@endsection
