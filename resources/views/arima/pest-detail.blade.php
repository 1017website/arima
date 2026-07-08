@php
    $lang = $lang ?? 'id';
    $title = $lang === 'en' ? ($bug->title_eng ?? $bug->title) : $bug->title;
    $image = $bug->header_image ?? $bug->icon ?? null;
    $imageUrl = $image ? (\Illuminate\Support\Str::startsWith($image, ['http://', 'https://']) ? $image : asset($image)) : 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389651/Arima_foto_2_rw8cre.png';
    $ecosystem = $lang === 'en' ? ($bug->ekosistem_eng ?? $bug->ekosistem) : $bug->ekosistem;
    $funfact = $lang === 'en' ? ($bug->funfact_eng ?? $bug->funfact) : $bug->funfact;
    $handling = $lang === 'en' ? ($bug->penanggulangan_eng ?? $bug->penanggulangan) : $bug->penanggulangan;
@endphp
@extends('layouts.arima')

@section('lang', $lang)
@section('title', $title.' | ARIMA Indonesia')
@section('content')
    <section class="page-hero" style="--hero-image: url('{{ $imageUrl }}')">
        <div class="container hero-inner">
            <span class="eyebrow">Pest Detail</span>
            <h1>{{ $title }}</h1>
            <p class="hero-copy">{{ \Illuminate\Support\Str::limit(strip_tags($funfact), 180) ?: 'Detail pest dan rekomendasi penanganan ARIMA.' }}</p>
            <div class="hero-actions">
                <a class="btn btn-red" href="{{ url($lang === 'en' ? '/contact_us_eng' : '/contact_us') }}">{{ $lang === 'en' ? 'Request Treatment' : 'Konsultasi Treatment' }}</a>
                <a class="btn" href="{{ url($lang === 'en' ? '/pest_eng' : '/pest') }}">{{ $lang === 'en' ? 'Back to Pest' : 'Kembali ke Pest' }}</a>
            </div>
        </div>
    </section>

    <div class="summary-strip">
        <div class="container summary-grid">
            <div class="summary-card"><small>Pest</small><strong>{{ $title }}</strong></div>
            <div class="summary-card"><small>Risk</small><strong>{{ $lang === 'en' ? 'Needs Treatment' : 'Butuh Treatment' }}</strong></div>
            <div class="summary-card"><small>Action</small><strong>{{ $lang === 'en' ? 'Consult Technician' : 'Konsultasi Teknisi' }}</strong></div>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="grid grid-2">
                <div class="prose prose-panel">
                    <h2>{{ $lang === 'en' ? 'Ecosystem' : 'Ekosistem' }}</h2>
                    {!! $ecosystem ?: '<p>Konten ekosistem belum tersedia.</p>' !!}
                    <h2 style="margin-top: 36px">{{ $lang === 'en' ? 'Handling' : 'Penanggulangan' }}</h2>
                    {!! $handling ?: '<p>Konten penanggulangan belum tersedia.</p>' !!}
                </div>
                <div class="card">
                    <div class="card-media"><img src="{{ $imageUrl }}" alt="{{ $title }}"></div>
                    <div class="card-body">
                        <span class="badge">Fun Fact</span>
                        <h3>{{ $funfact ?: ($lang === 'en' ? 'Pest information' : 'Informasi pest') }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($bug->detailBugs->isNotEmpty())
        <section class="section soft">
            <div class="container">
                <div class="section-head">
                    <h2>{{ $lang === 'en' ? 'Related Types' : 'Jenis Terkait' }}</h2>
                    <p>{{ $lang === 'en' ? 'Visual references to help identify pest variations.' : 'Referensi visual untuk membantu identifikasi variasi pest.' }}</p>
                </div>
                <div class="grid grid-3">
                    @foreach ($bug->detailBugs as $detail)
                        @php
                            $detailUrl = $detail->image ? (\Illuminate\Support\Str::startsWith($detail->image, ['http://', 'https://']) ? $detail->image : asset($detail->image)) : $imageUrl;
                        @endphp
                        <article class="card">
                            <div class="card-media"><img src="{{ $detailUrl }}" alt="{{ $detail->title_bugs }}"></div>
                            <div class="card-body">
                                <span class="badge">{{ $detail->latin_title }}</span>
                                <h3>{{ $detail->title_bugs }}</h3>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
