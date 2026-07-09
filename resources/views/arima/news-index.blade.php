@php
    $lang = $lang ?? 'id';
@endphp
@extends('layouts.arima')

@section('lang', $lang)
@section('body_class', 'internal-page')
@section('title', ($lang === 'en' ? 'News' : 'Berita').' | ARIMA Indonesia')
@section('content')
    <section class="page-hero" style="--hero-image: url('https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389680/Arima_foto_38_r1d4dr.png')">
        <div class="container hero-inner">
            <span class="eyebrow">News</span>
            <h1>{{ $lang === 'en' ? 'Latest ARIMA Updates' : 'Update Terbaru ARIMA' }}</h1>
            <p class="hero-copy">{{ $lang === 'en' ? 'Insights, practical tips, and updates from ARIMA Indonesia.' : 'Insight, tips praktis, dan kabar terbaru dari ARIMA Indonesia.' }}</p>
        </div>
    </section>

    <div class="summary-strip">
        <div class="container summary-grid">
            <div class="summary-card"><small>Insight</small><strong>{{ $lang === 'en' ? 'Pest Control Tips' : 'Tips Pest Control' }}</strong></div>
            <div class="summary-card"><small>Update</small><strong>{{ $lang === 'en' ? 'ARIMA Activity' : 'Aktivitas ARIMA' }}</strong></div>
            <div class="summary-card"><small>Guide</small><strong>{{ $lang === 'en' ? 'Healthy Facility' : 'Fasilitas Sehat' }}</strong></div>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="section-head">
                <h2>{{ $lang === 'en' ? 'Knowledge for healthier spaces.' : 'Pengetahuan untuk ruang yang lebih sehat.' }}</h2>
                <p>{{ $lang === 'en' ? 'Read selected articles about pest control and facility hygiene.' : 'Baca artikel pilihan tentang pest control dan kebersihan fasilitas.' }}</p>
            </div>
            <div class="grid grid-3">
                @forelse ($news as $item)
                    @php
                        $media = $item->image ? (\Illuminate\Support\Str::startsWith($item->image, ['http://', 'https://']) ? $item->image : asset($item->image)) : 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389680/Arima_foto_38_r1d4dr.png';
                        $title = $lang === 'en' ? ($item->title_eng ?? $item->title) : $item->title;
                        $description = $lang === 'en' ? ($item->description_eng ?? $item->description) : $item->description;
                        $link = $lang === 'en' ? route('news.show_eng', $item->id) : route('news.show', $item->id);
                    @endphp
                    <a class="card" href="{{ $link }}">
                        <div class="card-media"><img src="{{ $media }}" alt="{{ $title }}"></div>
                        <div class="card-body">
                            <span class="badge">Latest Post</span>
                            <h3>{{ $title }}</h3>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($description), 120) }}</p>
                        </div>
                    </a>
                @empty
                    <div class="card">
                        <div class="card-body">
                            <span class="badge">News</span>
                            <h3>{{ $lang === 'en' ? 'No news yet' : 'Berita belum tersedia' }}</h3>
                            <p>{{ $lang === 'en' ? 'Add articles from the CMS.' : 'Tambahkan artikel melalui CMS.' }}</p>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="pagination">{{ $news->links() }}</div>
        </div>
    </section>
@endsection
