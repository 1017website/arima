@php
    $lang = $lang ?? 'id';
    $title = $lang === 'en' ? ($news->title_eng ?? $news->title) : $news->title;
    $description = $lang === 'en' ? ($news->description_eng ?? $news->description) : $news->description;
    $media = $news->image ? (\Illuminate\Support\Str::startsWith($news->image, ['http://', 'https://']) ? $news->image : asset($news->image)) : 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389680/Arima_foto_38_r1d4dr.png';
@endphp
@extends('layouts.arima')

@section('lang', $lang)
@section('title', $title.' | ARIMA Indonesia')
@section('content')
    <section class="page-hero" style="--hero-image: url('{{ $media }}')">
        <div class="container hero-inner">
            <span class="eyebrow">News</span>
            <h1>{{ $title }}</h1>
            <p class="hero-copy">{{ \Illuminate\Support\Str::limit(strip_tags($description), 170) }}</p>
        </div>
    </section>

    <div class="summary-strip">
        <div class="container summary-grid">
            <div class="summary-card"><small>Article</small><strong>{{ $lang === 'en' ? 'ARIMA Insight' : 'Insight ARIMA' }}</strong></div>
            <div class="summary-card"><small>Topic</small><strong>{{ $lang === 'en' ? 'Pest and Hygiene' : 'Pest dan Hygiene' }}</strong></div>
            <div class="summary-card"><small>Action</small><strong>{{ $lang === 'en' ? 'Consult ARIMA' : 'Konsultasi ARIMA' }}</strong></div>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="grid grid-2">
                <article class="prose prose-panel">
                    {!! $description ?: '<p>Konten berita belum tersedia.</p>' !!}
                    <div class="actions">
                        <a class="btn btn-dark" href="{{ url($lang === 'en' ? '/news_eng' : '/news') }}">{{ $lang === 'en' ? 'Back to News' : 'Kembali ke News' }}</a>
                    </div>
                </article>
                <aside>
                    <div class="card">
                        <div class="card-media"><img src="{{ $media }}" alt="{{ $title }}"></div>
                        <div class="card-body">
                            <span class="badge">ARIMA Insight</span>
                            <h3>{{ $lang === 'en' ? 'Related Updates' : 'Update Lainnya' }}</h3>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    @if (!empty($latest_news) && $latest_news->count() > 1)
        <section class="section soft">
            <div class="container">
                <div class="section-head">
                    <h2>{{ $lang === 'en' ? 'More Articles' : 'Artikel Lainnya' }}</h2>
                    <p>{{ $lang === 'en' ? 'Continue reading from ARIMA Indonesia.' : 'Lanjutkan membaca dari ARIMA Indonesia.' }}</p>
                </div>
                <div class="grid grid-3">
                    @foreach ($latest_news->where('id', '!=', $news->id)->take(3) as $item)
                        @php
                            $itemTitle = $lang === 'en' ? ($item->title_eng ?? $item->title) : $item->title;
                            $itemMedia = $item->image ? (\Illuminate\Support\Str::startsWith($item->image, ['http://', 'https://']) ? $item->image : asset($item->image)) : $media;
                            $link = $lang === 'en' ? route('news.show_eng', $item->id) : route('news.show', $item->id);
                        @endphp
                        <a class="card" href="{{ $link }}">
                            <div class="card-media"><img src="{{ $itemMedia }}" alt="{{ $itemTitle }}"></div>
                            <div class="card-body">
                                <span class="badge">News</span>
                                <h3>{{ $itemTitle }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
