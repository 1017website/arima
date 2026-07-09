@php
    $lang = $lang ?? 'id';
    $title = $lang === 'en' ? ($item?->title_eng ?? $title ?? $item?->title ?? 'Service Solution') : ($title ?? $item?->title ?? 'Service Solution');
    $description = html_entity_decode($lang === 'en' ? ($item?->description_eng ?? $item?->description ?? '') : ($item?->description ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $listType = html_entity_decode($item?->list_type ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $hasListType = trim(strip_tags($listType)) !== '';
    $paragraphTexts = collect(preg_split('/<\/p>/i', $description))
        ->map(fn ($part) => trim($part))
        ->filter()
        ->map(fn ($part) => trim(strip_tags($part)))
        ->filter()
        ->values();
    if ($paragraphTexts->isEmpty() && trim(strip_tags($description)) !== '') {
        $paragraphTexts = collect([trim(strip_tags($description))]);
    }
    $leadText = $paragraphTexts->first() ?: ($lang === 'en' ? 'Professional pest management solution by ARIMA Indonesia.' : 'Solusi pest control profesional dari ARIMA Indonesia.');
    $pointTexts = $paragraphTexts->slice(1)->values();
    preg_match_all('/<li[^>]*>(.*?)<\/li>/is', $listType, $listMatches);
    $listItems = collect($listMatches[1] ?? [])->map(fn ($item) => trim(strip_tags($item)))->filter()->values();
    preg_match('/<strong[^>]*>(.*?)<\/strong>/is', $listType, $listTitleMatch);
    $listTitle = trim(strip_tags($listTitleMatch[1] ?? '')) ?: ($lang === 'en' ? 'Common Pest Coverage' : 'Cakupan Hama Umum');
    $image = $item?->background ?? null;
    $imageUrl = $image ? (\Illuminate\Support\Str::startsWith($image, ['http://', 'https://']) ? $image : asset($image)) : 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_52_czfaeb.png';
    $prefix = $lang === 'en' ? '_eng' : '';
    $serviceLinks = [
        ['Commercial', url('/commercial'.$prefix), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_52_czfaeb.png'],
        ['Residential', url('/residential'.$prefix), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_54_hhmqez.png'],
        ['Industrial', url('/industrial'.$prefix), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389692/Arima_foto_51_n2ypvi.png'],
        ['Disinfection', url('/disinfection'.$prefix), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389692/Arima_foto_55_tiujg5.png'],
        ['Cleaning', url('/cleaning'.$prefix), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389689/Arima_foto_53_jros1p.png'],
    ];
@endphp
@extends('layouts.arima')

@section('lang', $lang)
@section('body_class', 'internal-page')
@section('title', $title.' | ARIMA Indonesia')
@section('content')
    <section class="page-hero" style="--hero-image: url('{{ $imageUrl }}')">
        <div class="container hero-inner">
            <span class="eyebrow">Service Solution</span>
            <h1>{{ $title }}</h1>
            <p class="hero-copy">{{ \Illuminate\Support\Str::limit(strip_tags($description), 190) ?: 'Professional pest management solution by ARIMA Indonesia.' }}</p>
            <div class="hero-actions">
                <a class="btn btn-red" href="{{ url($lang === 'en' ? '/contact_us_eng' : '/contact_us') }}">{{ $lang === 'en' ? 'Request Consultation' : 'Konsultasi Layanan' }}</a>
                <a class="btn" href="#detail">{{ $lang === 'en' ? 'View Detail' : 'Lihat Detail' }}</a>
            </div>
        </div>
    </section>

    <div class="summary-strip">
        <div class="container summary-grid">
            <div class="summary-card"><small>Coverage</small><strong>{{ $lang === 'en' ? 'Survey to Monitoring' : 'Survey sampai Monitoring' }}</strong></div>
            <div class="summary-card"><small>Response</small><strong>{{ $lang === 'en' ? 'Fast Consultation' : 'Konsultasi Cepat' }}</strong></div>
            <div class="summary-card"><small>Standard</small><strong>{{ $lang === 'en' ? 'Green Pest Control' : 'Green Pest Control' }}</strong></div>
        </div>
    </div>

    <section class="section" id="detail">
        <div class="container">
            <div class="section-head">
                <h2>{{ $lang === 'en' ? 'Protection designed for daily operations.' : 'Perlindungan yang dirancang untuk operasional harian.' }}</h2>
                <p>{{ $lang === 'en' ? 'ARIMA combines survey, treatment, and monitoring to keep your environment protected.' : 'ARIMA menggabungkan survey, treatment, dan monitoring untuk menjaga lingkungan tetap terlindungi.' }}</p>
            </div>
            <div class="service-showcase">
                <div class="service-visual-panel">
                    <img src="{{ $imageUrl }}" alt="{{ $title }}">
                    <div class="service-visual-caption">
                        <span class="badge">ARIMA</span>
                        <strong>{{ $lang === 'en' ? 'Integrated field service' : 'Layanan lapangan terintegrasi' }}</strong>
                    </div>
                </div>
                <div class="service-story-panel">
                    <span class="badge">Service Solution</span>
                    <h3>{{ $title }}</h3>
                    <p>{{ $leadText }}</p>
                    <div class="service-aside-stats">
                        <div><small>{{ $lang === 'en' ? 'Scope' : 'Cakupan' }}</small><strong>{{ $lang === 'en' ? 'Survey, Treatment, Monitoring' : 'Survey, Treatment, Monitoring' }}</strong></div>
                        <div><small>{{ $lang === 'en' ? 'Output' : 'Output' }}</small><strong>{{ $lang === 'en' ? 'Report and Recommendation' : 'Laporan dan Rekomendasi' }}</strong></div>
                    </div>
                </div>
            </div>

            @if ($pointTexts->isNotEmpty() || $hasListType)
                <div class="service-insight-grid">
                    @foreach ($pointTexts as $point)
                        @php
                            $parts = explode(':', $point, 2);
                            $hasInlineTitle = count($parts) > 1 && strlen(trim($parts[0])) <= 70 && trim($parts[1]) !== '';
                            $pointTitle = $hasInlineTitle ? trim($parts[0]) : ($lang === 'en' ? 'Key Consideration' : 'Pertimbangan Utama');
                            $pointBody = $hasInlineTitle ? trim($parts[1]) : $point;
                        @endphp
                        <article class="service-insight-card">
                            <span>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <h3>{{ $pointTitle }}</h3>
                            <p>{{ $pointBody }}</p>
                        </article>
                    @endforeach

                    @if ($listItems->isNotEmpty())
                        <article class="service-pest-panel">
                            <span class="badge">Coverage</span>
                            <h3>{{ $listTitle }}</h3>
                            <div class="service-chip-list">
                                @foreach ($listItems as $listItem)
                                    <span>{{ $listItem }}</span>
                                @endforeach
                            </div>
                        </article>
                    @elseif ($hasListType)
                        <article class="service-pest-panel">
                            {!! $listType !!}
                        </article>
                    @endif
                </div>
            @endif
        </div>
    </section>

    <section class="section dark">
        <div class="container">
            <div class="section-head">
                <h2>{{ $lang === 'en' ? 'Other Service Solutions' : 'Service Solution Lainnya' }}</h2>
                <p>{{ $lang === 'en' ? 'Choose the protection category that matches your site.' : 'Pilih kategori perlindungan yang sesuai dengan kebutuhan lokasi.' }}</p>
            </div>
            <div class="grid grid-3">
                @foreach ($serviceLinks as [$name, $link, $media])
                    <a class="card" href="{{ $link }}">
                        <div class="card-media"><img src="{{ $media }}" alt="{{ $name }}"></div>
                        <div class="card-body">
                            <span class="badge">Service</span>
                            <h3>{{ $name }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
