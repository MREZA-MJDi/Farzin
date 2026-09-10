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

        <x-layout.breadcrumb
            :items="[
                ['label' => 'مجله', 'url' => '/blog'],
                ['label' => $post['title'] ?? 'مقاله']
            ]"
        />


        <article class="article">

            <header class="article__header">

                <div class="container">

                    @if(!empty($post['category']))
                        <span class="article__category">
                            {{ $post['category'] }}
                        </span>
                    @endif

                    <h1 class="article__title">
                        {{ $post['title'] ?? '' }}
                    </h1>

                    @if(!empty($post['excerpt']))
                        <p class="article__excerpt">
                            {{ $post['excerpt'] }}
                        </p>
                    @endif

                    <div class="article__meta">

                        @if(!empty($post['published_at']))
                            <span>
                                {{ $post['published_at'] }}
                            </span>
                        @endif

                        @if(!empty($post['reading_time']))
                            <span>
                                {{ $post['reading_time'] }}
                            </span>
                        @endif

                    </div>

                </div>

            </header>


            @if(!empty($post['image']))

                <div class="article__cover">

                    <div class="container">

                        <img
                            src="{{ $post['image'] }}"
                            alt="{{ $post['title'] ?? '' }}"
                            fetchpriority="high"
                        >

                    </div>

                </div>

            @endif


            <div class="container">

                <div class="article__layout">

                    <div class="article__content">

                        {!! $post['content'] ?? '' !!}

                    </div>


                    @if(!empty($relatedPosts))

                        <aside class="article__related">

                            <h2>
                                مطالب مرتبط
                            </h2>

                            <div class="stack stack-5">

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

                        </aside>

                    @endif

                </div>

            </div>

        </article>

    </main>

@endsection
