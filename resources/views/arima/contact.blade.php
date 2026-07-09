@php
    $lang = $lang ?? 'id';
    $action = $lang === 'en' ? route('store-contact_eng') : route('store-contact');
    $map = $information->google_map ?? 'https://www.google.com/maps?q=ARIMA%20Indonesia&output=embed';
@endphp
@extends('layouts.arima')

@section('lang', $lang)
@section('body_class', 'internal-page')
@section('title', ($lang === 'en' ? 'Contact Us' : 'Hubungi Kami').' | ARIMA Indonesia')
@section('content')
    <section class="page-hero" style="--hero-image: url('https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389686/Arima_foto_50_gopelo.png')">
        <div class="container hero-inner">
            <span class="eyebrow">Contact</span>
            <h1>{{ $lang === 'en' ? 'Talk with ARIMA' : 'Konsultasi dengan ARIMA' }}</h1>
            <p class="hero-copy">{{ $lang === 'en' ? 'Send your site condition and our team will help recommend the right service.' : 'Kirim kondisi lokasi Anda dan tim kami akan membantu merekomendasikan layanan yang tepat.' }}</p>
        </div>
    </section>

    <div class="summary-strip">
        <div class="container summary-grid">
            <div class="summary-card"><small>Office</small><strong>Surabaya</strong></div>
            <div class="summary-card"><small>Phone</small><strong>{{ $information->phone_1 ?? '+62 31 766 1422' }}</strong></div>
            <div class="summary-card"><small>Email</small><strong>{{ $information->email ?? 'info@arimaindonesia.com' }}</strong></div>
        </div>
    </div>

    <section class="section">
        <div class="container contact-panel">
            <div class="prose-panel">
                <div class="section-head" style="margin-bottom: 22px">
                    <h2>{{ $lang === 'en' ? 'Send a Message' : 'Kirim Pesan' }}</h2>
                    <p>{{ $lang === 'en' ? 'We will follow up through your email or phone number.' : 'Kami akan menindaklanjuti melalui email atau nomor telepon Anda.' }}</p>
                </div>
                @if(session('success'))
                    <div class="notice success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="notice error">{{ session('error') }}</div>
                @endif
                <form method="POST" action="{{ $action }}" class="form-grid">
                    @csrf
                    <input class="input" type="text" name="name" placeholder="{{ $lang === 'en' ? 'Your name' : 'Nama Anda' }}" required>
                    <input class="input" type="email" name="email" placeholder="Email" required>
                    <input class="input" type="text" name="phone_number" placeholder="{{ $lang === 'en' ? 'Phone number' : 'Nomor telepon' }}">
                    <input class="input" type="text" name="company" placeholder="{{ $lang === 'en' ? 'Company' : 'Perusahaan' }}">
                    <textarea class="input" name="message" placeholder="{{ $lang === 'en' ? 'Tell us your site condition' : 'Ceritakan kondisi lokasi Anda' }}" required></textarea>
                    <button class="btn btn-red" type="submit">{{ $lang === 'en' ? 'Submit Message' : 'Kirim Pesan' }}</button>
                </form>
            </div>
            <div class="card">
                <iframe src="{{ $map }}" width="100%" height="420" style="border:0; display:block" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="card-body">
                    <span class="badge">ARIMA Indonesia</span>
                    <h3>{{ $information->address ?? 'Jl. Raya Wiyung Indah No.7 Surabaya 60228' }}</h3>
                    <p>{{ $information->email ?? 'info@arimaindonesia.com' }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
