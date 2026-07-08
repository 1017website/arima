@php
    $lang = $lang ?? 'id';
    $title = $title ?? ($item?->title ?? 'Method');
    $description = $lang === 'en' ? ($item?->description_eng ?? $item?->description ?? '') : ($item?->description ?? '');
    $image = $item?->header_image ?? null;
    $imageUrl = $image ? (\Illuminate\Support\Str::startsWith($image, ['http://', 'https://']) ? $image : asset($image)) : 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389680/Arima_foto_38_r1d4dr.png';
    $methods = [
        ['General Pest', url('/generalpest'), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389680/Arima_foto_38_r1d4dr.png'],
        ['Termite Baiting', url('/termitebaiting'), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389664/Arima_foto_25_p67nun.png'],
        ['Fumigation', url('/fumigation'), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389656/Arima_foto_10_unvkoc.png'],
    ];
@endphp
@extends('layouts.arima')

@section('lang', $lang)
@section('title', $title.' | ARIMA Indonesia')
@section('content')
    <section class="page-hero" style="--hero-image: url('{{ $imageUrl }}')">
        <div class="container hero-inner">
            <span class="eyebrow">Method</span>
            <h1>{{ $title }}</h1>
            <p class="hero-copy">{{ \Illuminate\Support\Str::limit(strip_tags($description), 190) ?: 'Metode kerja ARIMA disusun untuk treatment yang terukur dan dapat dimonitor.' }}</p>
            <div class="hero-actions">
                <a class="btn btn-red" href="{{ url($lang === 'en' ? '/contact_us_eng' : '/contact_us') }}">{{ $lang === 'en' ? 'Discuss Method' : 'Diskusi Metode' }}</a>
                <a class="btn" href="#detail">{{ $lang === 'en' ? 'Read Detail' : 'Baca Detail' }}</a>
            </div>
        </div>
    </section>

    <div class="summary-strip">
        <div class="container summary-grid">
            <div class="summary-card"><small>Step 01</small><strong>{{ $lang === 'en' ? 'Site Assessment' : 'Assessment Lokasi' }}</strong></div>
            <div class="summary-card"><small>Step 02</small><strong>{{ $lang === 'en' ? 'Targeted Treatment' : 'Treatment Terarah' }}</strong></div>
            <div class="summary-card"><small>Step 03</small><strong>{{ $lang === 'en' ? 'Report and Monitor' : 'Report dan Monitoring' }}</strong></div>
        </div>
    </div>

    <section class="section" id="detail">
        <div class="container">
            <div class="section-head">
                <h2>{{ $lang === 'en' ? 'Measured treatment, clear reporting.' : 'Treatment terukur, pelaporan jelas.' }}</h2>
                <p>{{ $lang === 'en' ? 'Each method is selected from site condition, risk level, and target pest.' : 'Setiap metode dipilih dari kondisi lokasi, tingkat risiko, dan target pengendalian.' }}</p>
            </div>
            <div class="grid grid-2">
                <div class="card">
                    <div class="card-media"><img src="{{ $imageUrl }}" alt="{{ $title }}"></div>
                </div>
                <div class="prose prose-panel">
                    {!! $description ?: '<p>Konten metode dapat dikelola melalui CMS ARIMA.</p>' !!}
                    <div class="actions">
                        <a class="btn btn-dark" href="{{ url('/generalpest') }}">General Pest</a>
                        <a class="btn btn-dark" href="{{ url('/termitebaiting') }}">Termite Baiting</a>
                        <a class="btn btn-dark" href="{{ url('/fumigation') }}">Fumigation</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section soft">
        <div class="container">
            <div class="section-head">
                <h2>{{ $lang === 'en' ? 'Explore ARIMA Methods' : 'Jelajahi Metode ARIMA' }}</h2>
                <p>{{ $lang === 'en' ? 'Pick the approach that fits your location and objective.' : 'Pilih pendekatan yang sesuai dengan lokasi dan tujuan treatment.' }}</p>
            </div>
            <div class="grid grid-3">
                @foreach ($methods as [$name, $link, $media])
                    <a class="card" href="{{ $link }}">
                        <div class="card-media"><img src="{{ $media }}" alt="{{ $name }}"></div>
                        <div class="card-body">
                            <span class="badge">Method</span>
                            <h3>{{ $name }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
