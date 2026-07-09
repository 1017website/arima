@php
    $lang = $lang ?? 'id';
    $title = $lang === 'en' ? ($item?->title_eng ?? $title ?? $item?->title ?? 'Method') : ($title ?? $item?->title ?? 'Method');
    $description = html_entity_decode($lang === 'en' ? ($item?->description_eng ?? $item?->description ?? '') : ($item?->description ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $paragraphTexts = collect(preg_split('/<\/p>/i', $description))
        ->map(fn ($part) => trim(strip_tags($part)))
        ->filter()
        ->values();
    if ($paragraphTexts->isEmpty() && trim(strip_tags($description)) !== '') {
        $paragraphTexts = collect([trim(strip_tags($description))]);
    }
    $leadText = $paragraphTexts->first() ?: ($lang === 'en' ? 'ARIMA applies measured pest control methods based on site risks and operational needs.' : 'ARIMA menerapkan metode pest control terukur berdasarkan risiko lokasi dan kebutuhan operasional.');
    $pointTexts = $paragraphTexts->slice(1)->values();
    if ($pointTexts->isEmpty()) {
        $pointTexts = collect([
            $lang === 'en' ? 'Assessment starts from site conditions, pest pressure, activity area, and safety requirements.' : 'Assessment dimulai dari kondisi lokasi, tekanan hama, area aktivitas, dan kebutuhan keamanan.',
            $lang === 'en' ? 'Treatment is selected to match target pest behavior and the risk level of each area.' : 'Treatment dipilih sesuai perilaku target hama dan tingkat risiko setiap area.',
            $lang === 'en' ? 'Monitoring and reporting keep the result measurable for the next maintenance cycle.' : 'Monitoring dan report menjaga hasil treatment tetap terukur untuk siklus pemeliharaan berikutnya.',
        ]);
    }
    $image = $item?->header_image ?? null;
    $imageUrl = $image ? (\Illuminate\Support\Str::startsWith($image, ['http://', 'https://']) ? $image : asset($image)) : 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389680/Arima_foto_38_r1d4dr.png';
    $prefix = $lang === 'en' ? '_eng' : '';
    $methods = [
        ['General Pest', url('/generalpest'.$prefix), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389680/Arima_foto_38_r1d4dr.png'],
        ['Termite Baiting', url('/termitebaiting'.$prefix), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389664/Arima_foto_25_p67nun.png'],
        ['Fumigation', url('/fumigation'.$prefix), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389656/Arima_foto_10_unvkoc.png'],
    ];
@endphp
@extends('layouts.arima')

@section('lang', $lang)
@section('body_class', 'internal-page')
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
            <div class="service-showcase">
                <div class="service-visual-panel">
                    <img src="{{ $imageUrl }}" alt="{{ $title }}">
                    <div class="service-visual-caption">
                        <span class="badge">ARIMA Method</span>
                        <strong>{{ $lang === 'en' ? 'Controlled process for safer spaces' : 'Proses terkendali untuk ruang lebih aman' }}</strong>
                    </div>
                </div>
                <div class="service-story-panel">
                    <span class="badge">Method</span>
                    <h3>{{ $title }}</h3>
                    <p>{{ $leadText }}</p>
                    <div class="service-aside-stats">
                        <div><small>{{ $lang === 'en' ? 'Planning' : 'Perencanaan' }}</small><strong>{{ $lang === 'en' ? 'Risk based' : 'Berbasis risiko' }}</strong></div>
                        <div><small>{{ $lang === 'en' ? 'Result' : 'Hasil' }}</small><strong>{{ $lang === 'en' ? 'Documented work' : 'Kerja terdokumentasi' }}</strong></div>
                    </div>
                </div>
            </div>

            <div class="method-content-layout">
                <article class="prose prose-panel method-description">
                    {!! $description ?: '<p>Konten metode dapat dikelola melalui CMS ARIMA.</p>' !!}
                </article>

                <article class="service-pest-panel method-menu-panel">
                    <span class="badge">Method Menu</span>
                    <h3>{{ $lang === 'en' ? 'Choose another method' : 'Pilih metode lain' }}</h3>
                    <div class="service-chip-list">
                        @foreach ($methods as [$name, $link])
                            <span><a href="{{ $link }}">{{ $name }}</a></span>
                        @endforeach
                    </div>
                </article>
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
