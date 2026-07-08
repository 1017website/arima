@php
    $lang = $lang ?? 'id';
    $title = $title ?? ($item?->title ?? 'Service Solution');
    $description = $lang === 'en' ? ($item?->description_eng ?? $item?->description ?? '') : ($item?->description ?? '');
    $image = $item?->background ?? null;
    $imageUrl = $image ? (\Illuminate\Support\Str::startsWith($image, ['http://', 'https://']) ? $image : asset($image)) : 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_52_czfaeb.png';
    $features = collect(explode(',', $item?->list_type ?? 'Assessment, Treatment, Monitoring'))->map(fn ($feature) => trim($feature))->filter();
    $serviceLinks = [
        ['Commercial', url('/commercial'), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_52_czfaeb.png'],
        ['Residential', url('/residential'), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_54_hhmqez.png'],
        ['Industrial', url('/industrial'), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389692/Arima_foto_51_n2ypvi.png'],
        ['Disinfection', url('/disinfection'), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389692/Arima_foto_55_tiujg5.png'],
        ['Cleaning', url('/cleaning'), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389689/Arima_foto_53_jros1p.png'],
    ];
@endphp
@extends('layouts.arima')

@section('lang', $lang)
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
            <div class="grid grid-2">
                <div class="prose prose-panel">
                    {!! $description ?: '<p>Konten layanan dapat dikelola melalui CMS ARIMA.</p>' !!}
                    @if ($features->isNotEmpty())
                        <ul class="feature-list">
                            @foreach ($features as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <div class="card">
                    <div class="card-media"><img src="{{ $imageUrl }}" alt="{{ $title }}"></div>
                    <div class="card-body">
                        <span class="badge">ARIMA</span>
                        <h3>{{ $lang === 'en' ? 'Integrated Service' : 'Layanan Terintegrasi' }}</h3>
                        <p>{{ $lang === 'en' ? 'Managed by trained technicians with practical field reporting.' : 'Dikerjakan teknisi terlatih dengan pelaporan lapangan yang mudah dipantau.' }}</p>
                    </div>
                </div>
            </div>
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
