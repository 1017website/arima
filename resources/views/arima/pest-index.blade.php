@php
    $lang = $lang ?? 'id';
    $title = $title ?? ($lang === 'en' ? 'Pest Library' : 'Daftar Pest');
    $image = $pest->header_image ?? null;
    $imageUrl = $image ? (\Illuminate\Support\Str::startsWith($image, ['http://', 'https://']) ? $image : asset($image)) : 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389651/Arima_foto_2_rw8cre.png';
@endphp
@extends('layouts.arima')

@section('lang', $lang)
@section('body_class', 'internal-page')
@section('title', $title.' | ARIMA Indonesia')
@section('content')
    <section class="page-hero" style="--hero-image: url('{{ $imageUrl }}')">
        <div class="container hero-inner">
            <span class="eyebrow">Pest</span>
            <h1>{{ $title }}</h1>
            <p class="hero-copy">{{ $lang === 'en' ? 'Identify pest risks and choose the right ARIMA treatment method.' : 'Kenali risiko pest dan pilih metode treatment ARIMA yang tepat.' }}</p>
            <div class="hero-actions">
                <a class="btn btn-red" href="{{ url($lang === 'en' ? '/contact_us_eng' : '/contact_us') }}">{{ $lang === 'en' ? 'Ask Technician' : 'Tanya Teknisi' }}</a>
                <a class="btn" href="{{ url($lang === 'en' ? '/otherpest_eng' : '/otherpest') }}">{{ $lang === 'en' ? 'Other Pest' : 'Pest Lainnya' }}</a>
            </div>
        </div>
    </section>

    <div class="summary-strip">
        <div class="container summary-grid">
            <div class="summary-card"><small>Identify</small><strong>{{ $lang === 'en' ? 'Know the Pest' : 'Kenali Pest' }}</strong></div>
            <div class="summary-card"><small>Treatment</small><strong>{{ $lang === 'en' ? 'Choose Method' : 'Pilih Metode' }}</strong></div>
            <div class="summary-card"><small>Consult</small><strong>{{ $lang === 'en' ? 'Ask ARIMA Team' : 'Tanya Tim ARIMA' }}</strong></div>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="section-head">
                <h2>{{ $lang === 'en' ? 'Pest reference for faster decisions.' : 'Referensi pest untuk keputusan lebih cepat.' }}</h2>
                <p>{{ $lang === 'en' ? 'Browse common pest categories handled by ARIMA.' : 'Lihat kategori pest umum yang ditangani ARIMA.' }}</p>
            </div>
            <div class="pest-library-grid">
                @forelse ($bugs as $bug)
                    @php
                        $media = $bug->icon ?: $bug->header_image;
                        $mediaUrl = $media ? (\Illuminate\Support\Str::startsWith($media, ['http://', 'https://']) ? $media : asset($media)) : 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389651/Arima_foto_2_rw8cre.png';
                        $bugTitle = $lang === 'en' ? ($bug->title_eng ?? $bug->title) : $bug->title;
                        $bugFact = html_entity_decode($lang === 'en' ? ($bug->funfact_eng ?? $bug->funfact) : $bug->funfact, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                        $bugFactText = trim(strip_tags($bugFact));
                        $showUrl = $lang === 'en'
                            ? ($bug->types == 1 ? route('otherpest.show_eng', $bug->id) : route('bug.show_eng', $bug->id))
                            : ($bug->types == 1 ? route('otherpest.show', $bug->id) : route('bug.show', $bug->id));
                    @endphp
                    <a class="pest-library-card" href="{{ $showUrl }}">
                        <div class="pest-library-media">
                            <img src="{{ $mediaUrl }}" alt="{{ $bugTitle }}">
                        </div>
                        <div class="pest-library-body">
                            <span class="badge">Pest</span>
                            <h3>{{ $bugTitle }}</h3>
                            <p>{{ \Illuminate\Support\Str::limit($bugFactText ?: ($lang === 'en' ? 'Pest information is available in the ARIMA library.' : 'Informasi pest tersedia di library ARIMA.'), 120) }}</p>
                            <span class="pest-library-link">{{ $lang === 'en' ? 'View detail' : 'Lihat detail' }}</span>
                        </div>
                    </a>
                @empty
                    <div class="pest-library-card">
                        <div class="pest-library-body">
                            <span class="badge">Pest</span>
                            <h3>{{ $lang === 'en' ? 'No pest data yet' : 'Data pest belum tersedia' }}</h3>
                            <p>{{ $lang === 'en' ? 'Add pest content from the CMS.' : 'Tambahkan konten pest melalui CMS.' }}</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
