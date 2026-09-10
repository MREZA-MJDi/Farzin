@extends('layouts.app')

@section(
    'title',
    ($post['title'] ?? 'مقاله') . ' | مجله فرزین'
)

@section(
    'meta_description',
    $post['meta_description']
        ?? ($post['excerpt'] ?? 'مقاله‌ای از مجله فرزین.')
)

@section('content')

    <main class="article-page">

        <section class="section section--sm section--bottom-none">

            <div class="container">

                <x-layout.breadcrumb
                    :items="[
                        [
                            'label' => 'مجله',
                            'href' => route('blog.index')
                        ],
                        [
                            'label' => $post['title'] ?? 'مقاله'
                        ]
                    ]"
                />

            </div>

        </section>


        <article class="article">

            <header class="section section--sm">

                <div class="container container--narrow">

                    <div class="stack stack--md">

                        @if(!empty($post['category']))
                            <span class="text-accent text-sm font-semibold">
                                {{ $post['category'] }}
                            </span>
                        @endif

                        <h1>
                            {{ $post['title'] ?? '' }}
                        </h1>

                        @if(!empty($post['excerpt']))
                            <p>
                                {{ $post['excerpt'] }}
                            </p>
                        @endif

                        @if(
                            !empty($post['published_at'])
                            || !empty($post['reading_time'])
                        )

                            <div class="inline inline--sm text-muted text-xs">

                                @if(!empty($post['published_at']))
                                    <span>
                                        {{ $post['published_at'] }}
                                    </span>
                                @endif

                                @if(
                                    !empty($post['published_at'])
                                    && !empty($post['reading_time'])
                                )
                                    <span aria-hidden="true">
                                        ·
                                    </span>
                                @endif

                                @if(!empty($post['reading_time']))
                                    <span>
                                        {{ $post['reading_time'] }}
                                    </span>
                                @endif

                            </div>

                        @endif

                    </div>

                </div>

            </header>


            @if(!empty($post['image']))

                <section class="section section--sm">

                    <div class="container">

                        <figure class="card overflow-hidden">

                            <img
                                src="{{ $post['image'] }}"
                                alt="{{ $post['title'] ?? '' }}"
                                width="1400"
                                height="800"
                                fetchpriority="high"
                                class="w-full"
                            >

                        </figure>

                    </div>

                </section>

            @endif


            <section class="section section--sm">

                <div class="container">

                    <div class="grid grid-cols-2 gap-8">

                        <div class="content content--narrow">

                            {!! $post['content'] ?? '' !!}

                        </div>


                        @if(!empty($relatedPosts))

                            <aside>

                                <div class="stack stack--md">

                                    <h2 class="text-2xl">
                                        مطالب مرتبط
                                    </h2>

                                    <div class="stack stack--md">

                                        @foreach($relatedPosts as $related)

                                            <x-content.blog-card
                                                :title="$related['title']"
                                                :image="$related['image']"
                                                :href="$related['url']"
                                                :category="$related['category'] ?? null"
                                                :excerpt="$related['excerpt'] ?? null"
                                                :meta="$related['meta'] ?? null"
                                            />

                                        @endforeach

                                    </div>

                                </div>

                            </aside>

                        @endif

                    </div>

                </div>

            </section>

        </article>

    </main>

@endsection
