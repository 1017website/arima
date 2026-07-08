@extends('layouts.arima')

@section('lang', 'en')
@section('title', 'ARIMA Indonesia | Green Pest Control')
@section('content')
    <section class="page-hero" style="--hero-image: url('https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_49_nkonei.png')">
        <div class="container hero-inner">
            <span class="eyebrow">Since 1998</span>
            <h1>ARIMA Indonesia</h1>
            <p class="hero-copy">Green pest control, pest management, disinfection, fumigation, termite baiting, and cleaning service for residential, commercial, and industrial sites.</p>
            <div class="hero-actions">
                <a class="btn btn-red" href="{{ url('/contact_us_eng') }}">Request Consultation</a>
                <a class="btn" href="{{ url('/commercial_eng') }}">Service Solution</a>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-head">
                <h2>Service Solution</h2>
                <p>Choose the protection category that matches your site and operational needs.</p>
            </div>
            <div class="grid grid-3">
                @foreach ([
                    ['Commercial Protection', url('/commercial_eng'), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_52_czfaeb.png'],
                    ['Residential Protection', url('/residential_eng'), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_54_hhmqez.png'],
                    ['Industrial Protection', url('/industrial_eng'), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389692/Arima_foto_51_n2ypvi.png'],
                    ['Disinfection Protection', url('/disinfection_eng'), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389692/Arima_foto_55_tiujg5.png'],
                    ['Cleaning Service', url('/cleaning_eng'), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389689/Arima_foto_53_jros1p.png'],
                ] as [$title, $link, $media])
                    <a class="card" href="{{ $link }}">
                        <div class="card-media"><img src="{{ $media }}" alt="{{ $title }}"></div>
                        <div class="card-body">
                            <span class="badge">Service</span>
                            <h3>{{ $title }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section dark">
        <div class="container">
            <div class="section-head">
                <h2>Method</h2>
                <p>Measured treatment methods for practical field conditions.</p>
            </div>
            <div class="grid grid-3">
                @foreach ([
                    ['General Pest', url('/generalpest_eng'), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389680/Arima_foto_38_r1d4dr.png'],
                    ['Termite Baiting', url('/termitebaiting_eng'), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389664/Arima_foto_25_p67nun.png'],
                    ['Fumigation', url('/fumigation_eng'), 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389656/Arima_foto_10_unvkoc.png'],
                ] as [$title, $link, $media])
                    <a class="card" href="{{ $link }}">
                        <div class="card-media"><img src="{{ $media }}" alt="{{ $title }}"></div>
                        <div class="card-body">
                            <span class="badge">Method</span>
                            <h3>{{ $title }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
