@php
    $lang = $lang ?? 'id';
    $title = $lang === 'en' ? ($bug->title_eng ?? $bug->title) : $bug->title;
    $image = $bug->header_image ?? $bug->icon ?? null;
    $imageUrl = $image ? (\Illuminate\Support\Str::startsWith($image, ['http://', 'https://']) ? $image : asset($image)) : 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389651/Arima_foto_2_rw8cre.png';
    $ecosystem = html_entity_decode($lang === 'en' ? ($bug->ekosistem_eng ?? $bug->ekosistem) : $bug->ekosistem, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $funfact = html_entity_decode($lang === 'en' ? ($bug->funfact_eng ?? $bug->funfact) : $bug->funfact, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $handling = html_entity_decode($lang === 'en' ? ($bug->penanggulangan_eng ?? $bug->penanggulangan) : $bug->penanggulangan, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $funfactText = trim(strip_tags($funfact)) ?: ($lang === 'en' ? 'Pest information and field recommendations from ARIMA.' : 'Informasi pest dan rekomendasi lapangan dari ARIMA.');
    $ecosystemTexts = collect(preg_split('/<\/p>/i', $ecosystem))
        ->map(fn ($part) => trim(strip_tags($part)))
        ->filter()
        ->values();
    if ($ecosystemTexts->isEmpty() && trim(strip_tags($ecosystem)) !== '') {
        $ecosystemTexts = collect([trim(strip_tags($ecosystem))]);
    }
    $handlingTexts = collect(preg_split('/<\/p>/i', $handling))
        ->map(fn ($part) => trim(strip_tags($part)))
        ->filter()
        ->values();
    if ($handlingTexts->isEmpty() && trim(strip_tags($handling)) !== '') {
        $handlingTexts = collect([trim(strip_tags($handling))]);
    }
    if ($ecosystemTexts->isEmpty()) {
        $ecosystemTexts = collect([$lang === 'en' ? 'This pest can adapt to spaces with food, shelter, humidity, or low activity.' : 'Pest ini dapat beradaptasi pada area dengan makanan, tempat berlindung, kelembapan, atau aktivitas rendah.']);
    }
    if ($handlingTexts->isEmpty()) {
        $handlingTexts = collect([$lang === 'en' ? 'Treatment starts with inspection, sanitation control, targeted handling, and periodic monitoring.' : 'Penanggulangan dimulai dari inspeksi, kontrol sanitasi, treatment terarah, dan monitoring berkala.']);
    }
@endphp
@extends('layouts.arima')

@section('lang', $lang)
@section('body_class', 'internal-page')
@section('title', $title.' | ARIMA Indonesia')
@section('content')
    <section class="page-hero" style="--hero-image: url('{{ $imageUrl }}')">
        <div class="container hero-inner">
            <span class="eyebrow">Pest Detail</span>
            <h1>{{ $title }}</h1>
            <p class="hero-copy">{{ \Illuminate\Support\Str::limit($funfactText, 180) }}</p>
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
            <div class="service-showcase">
                <div class="service-visual-panel">
                    <img src="{{ $imageUrl }}" alt="{{ $title }}">
                    <div class="service-visual-caption">
                        <span class="badge">Pest Library</span>
                        <strong>{{ $title }}</strong>
                    </div>
                </div>
                <div class="service-story-panel">
                    <span class="badge">Fun Fact</span>
                    <h3>{{ $title }}</h3>
                    <p>{{ $funfactText }}</p>
                    <div class="service-aside-stats">
                        <div><small>{{ $lang === 'en' ? 'Focus' : 'Fokus' }}</small><strong>{{ $lang === 'en' ? 'Habitat and risk' : 'Habitat dan risiko' }}</strong></div>
                        <div><small>{{ $lang === 'en' ? 'Action' : 'Aksi' }}</small><strong>{{ $lang === 'en' ? 'Inspection to control' : 'Inspeksi sampai kontrol' }}</strong></div>
                    </div>
                </div>
            </div>

            <div class="pest-description-layout">
                <article class="prose prose-panel method-description">
                    <span class="badge">{{ $lang === 'en' ? 'Ecosystem' : 'Ekosistem' }}</span>
                    <h2>{{ $lang === 'en' ? 'Habitat and Behavior' : 'Habitat dan Perilaku' }}</h2>
                    {!! $ecosystem ?: '<p>Konten ekosistem belum tersedia.</p>' !!}
                </article>

                <article class="prose prose-panel method-description">
                    <span class="badge">{{ $lang === 'en' ? 'Handling' : 'Penanggulangan' }}</span>
                    <h2>{{ $lang === 'en' ? 'Control Recommendation' : 'Rekomendasi Kontrol' }}</h2>
                    {!! $handling ?: '<p>Konten penanggulangan belum tersedia.</p>' !!}
                </article>
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
                <div class="related-pest-grid">
                    @foreach ($bug->detailBugs as $detail)
                        @php
                            $detailUrl = $detail->image ? (\Illuminate\Support\Str::startsWith($detail->image, ['http://', 'https://']) ? $detail->image : asset($detail->image)) : $imageUrl;
                        @endphp
                        <button
                            class="related-pest-card"
                            type="button"
                            data-lightbox-trigger
                            data-image="{{ $detailUrl }}"
                            data-title="{{ $detail->title_bugs }}"
                            data-latin="{{ $detail->latin_title }}"
                            aria-label="{{ $lang === 'en' ? 'Open image preview for' : 'Buka preview gambar' }} {{ $detail->title_bugs }}"
                        >
                            <span class="related-pest-media">
                                <img src="{{ $detailUrl }}" alt="{{ $detail->title_bugs }}">
                            </span>
                            <span class="related-pest-body">
                                <span class="badge">{{ $detail->latin_title }}</span>
                                <span class="related-pest-title">{{ $detail->title_bugs }}</span>
                                <span class="related-pest-action">{{ $lang === 'en' ? 'Preview image' : 'Lihat gambar' }}</span>
                            </span>
                        </button>
                    @endforeach
                </div>

                <div class="image-lightbox" data-lightbox aria-hidden="true">
                    <button class="image-lightbox-backdrop" type="button" data-lightbox-close aria-label="{{ $lang === 'en' ? 'Close preview' : 'Tutup preview' }}"></button>
                    <div class="image-lightbox-dialog" role="dialog" aria-modal="true" aria-label="{{ $lang === 'en' ? 'Related pest image preview' : 'Preview gambar jenis terkait' }}">
                        <button class="image-lightbox-close" type="button" data-lightbox-close aria-label="{{ $lang === 'en' ? 'Close preview' : 'Tutup preview' }}">x</button>
                        <div class="image-lightbox-media">
                            <img src="" alt="" data-lightbox-image>
                        </div>
                        <div class="image-lightbox-caption">
                            <span class="badge" data-lightbox-latin></span>
                            <h3 data-lightbox-title></h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@push('scripts')
    <script>
        (() => {
            const lightbox = document.querySelector('[data-lightbox]');
            if (!lightbox) return;

            const image = lightbox.querySelector('[data-lightbox-image]');
            const title = lightbox.querySelector('[data-lightbox-title]');
            const latin = lightbox.querySelector('[data-lightbox-latin]');
            const closeButtons = lightbox.querySelectorAll('[data-lightbox-close]');
            const triggers = document.querySelectorAll('[data-lightbox-trigger]');

            const closeLightbox = () => {
                lightbox.classList.remove('open');
                lightbox.setAttribute('aria-hidden', 'true');
                document.body.classList.remove('lightbox-open');
                image.removeAttribute('src');
                image.removeAttribute('alt');
            };

            triggers.forEach((trigger) => {
                trigger.addEventListener('click', () => {
                    const imageUrl = trigger.dataset.image || '';
                    const imageTitle = trigger.dataset.title || '';
                    const latinTitle = trigger.dataset.latin || '';

                    image.src = imageUrl;
                    image.alt = imageTitle;
                    title.textContent = imageTitle;
                    latin.textContent = latinTitle;
                    lightbox.classList.add('open');
                    lightbox.setAttribute('aria-hidden', 'false');
                    document.body.classList.add('lightbox-open');
                });
            });

            closeButtons.forEach((button) => button.addEventListener('click', closeLightbox));
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && lightbox.classList.contains('open')) {
                    closeLightbox();
                }
            });
        })();
    </script>
@endpush
