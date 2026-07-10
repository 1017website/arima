@php
  $info = $information ?? $siteInformation ?? null;
  $isEnglishHome = ($locale ?? 'id') === 'en';
  $siteName = $info->name ?? 'ARIMA Indonesia';
  $phonePrimary = $info?->phone_1 ?: '+62 31 766 1422';
  $phoneSecondary = $info?->phone_2 ?: '+62 31 766 4086';
  $phoneSms = $info?->phone_sms ?: '+62 811-3000-655';
  $emailAddress = $info?->email ?: 'info@arimaindonesia.com';
  $websiteLink = $info?->website_link ?: 'arimaindonesia.com';
  $officeAddress = $info?->address ?: 'Jl. Raya Wiyung Indah No.7 Surabaya 60228';
  $logoPath = $info?->frontend_logo ?: $info?->logo_company ?: $info?->logo_header;
  $faviconPath = $info?->frontend_favicon ?: $info?->logo_favicon;
  $metaImagePath = $info?->meta_image ?: ($seo['og_image'] ?? null) ?: $logoPath;
  $frontendLogo = $logoPath ? asset($logoPath) : asset('assets/arima/logo-new.PNG');
  $frontendFavicon = $faviconPath ? asset($faviconPath) : asset('favicon.png');
  $servicePrefix = $isEnglishHome ? '_eng' : '';
  $homeContactUrl = $isEnglishHome ? url('/contact_us_eng') : url('/contact_us');
  $homeNewsUrl = $isEnglishHome ? url('/news_eng') : url('/news');
@endphp
<!DOCTYPE html>
<html lang="{{ $locale ?? 'id' }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="{{ $seo['description'] ?? 'ARIMA Indonesia - green pest control, pest management, disinfection, fumigation, termite baiting, dan cleaning service sejak 1998.' }}" />
  @if(!empty($seo['keywords']))
  <meta name="keywords" content="{{ $seo['keywords'] }}" />
  @endif
  <meta name="robots" content="index, follow" />
  <link rel="canonical" href="{{ $seo['canonical'] ?? url()->current() }}" />
  <link rel="alternate" hreflang="id" href="{{ url('/') }}" />
  <link rel="alternate" hreflang="en" href="{{ url('/eng') }}" />
  <link rel="alternate" hreflang="x-default" href="{{ url('/') }}" />
  <meta property="og:type" content="website" />
  <meta property="og:site_name" content="ARIMA Indonesia" />
  <meta property="og:title" content="{{ $seo['title'] ?? 'ARIMA Indonesia' }}" />
  <meta property="og:description" content="{{ $seo['description'] ?? '' }}" />
  <meta property="og:url" content="{{ $seo['canonical'] ?? url()->current() }}" />
  @if($metaImagePath)
  <meta property="og:image" content="{{ asset($metaImagePath) }}" />
  @endif
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="{{ $seo['title'] ?? 'ARIMA Indonesia' }}" />
  <meta name="twitter:description" content="{{ $seo['description'] ?? '' }}" />
  <title>{{ $seo['title'] ?? 'ARIMA Indonesia' }}</title>
  <link rel="icon" type="image/png" href="{{ $frontendFavicon }}" />
  @if($info?->google_adsense_client_id)
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ $info->google_adsense_client_id }}" crossorigin="anonymous"></script>
  @endif
  @if($info?->google_ads_head_script)
  {!! $info->google_ads_head_script !!}
  @endif
  @if(!empty($homeContent?->analytics_head))
  {!! $homeContent->analytics_head !!}
  @endif
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700;800;900&family=Manrope:wght@400;500;600;700;800&family=Barlow+Condensed:wght@600;700;800;900&display=swap" rel="stylesheet" />
  <style>
    :root {
      --red: #e50914;
      --red-2: #b4040d;
      --red-3: #7a0208;
      --dark: #08080a;
      --dark-2: #111114;
      --ink: #16161a;
      --muted: #686871;
      --muted-2: #92929b;
      --paper: #ffffff;
      --soft: #fff4f5;
      --line: rgba(255,255,255,.13);
      --line-dark: rgba(8,8,10,.10);
      --shadow: 0 24px 80px rgba(8,8,10,.14);
      --shadow-red: 0 22px 70px rgba(229, 9, 20, .32);
      --radius-xl: 34px;
      --radius-lg: 26px;
      --radius-md: 18px;
      --container: 1200px;
    }

    * { box-sizing: border-box; }
    html { scroll-behavior: smooth; scroll-padding-top: 96px; }
    body {
      margin: 0;
      font-family: "Manrope", "Geist", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      color: var(--ink);
      background: #f7f7f8;
      line-height: 1.65;
      overflow-x: hidden;
      text-rendering: optimizeLegibility;
      -webkit-font-smoothing: antialiased;
    }
    body.modal-open { overflow: hidden; }
    a { color: inherit; text-decoration: none; }
    img { max-width: 100%; display: block; }
    h1, h2, h3, .brand, .nav-link, .drop-trigger, .btn { font-family: "Geist", "Manrope", sans-serif; }
    button, input, textarea { font: inherit; }
    button { color: inherit; }

    .container { width: min(var(--container), calc(100% - 40px)); margin-inline: auto; }
    .section { padding: 112px 0; position: relative; }
    .section.dark { color: #fff; background: var(--dark); }
    .section.soft { background: linear-gradient(180deg, #fff, #fff4f5); }

    .site-header {
      position: fixed;
      inset: 0 0 auto;
      z-index: 1000;
      border-bottom: 1px solid rgba(255,255,255,.14);
      background: rgba(8,8,10,.68);
      backdrop-filter: blur(22px);
      color: #fff;
    }
    .topbar {
      border-bottom: 1px solid rgba(255,255,255,.10);
      background: linear-gradient(90deg, rgba(229,9,20,.92), rgba(122,2,8,.70));
      font-size: 12px;
      font-weight: 800;
      letter-spacing: .01em;
    }
    .topbar .container {
      min-height: 34px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 16px;
    }
    .topbar a { opacity: .92; transition: .2s ease; }
    .topbar a:hover { opacity: 1; transform: translateY(-1px); }

    .navrow {
      min-height: 74px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 18px;
    }
    .brand {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      padding: 8px 0;
    }
    .brand img {
      width: 140px;
      height: auto;
      padding: 0;
      border-radius: 0;
      background: transparent;
      filter: none;
    }
    .main-nav {
      display: flex;
      align-items: center;
      gap: 2px;
    }
    .nav-link, .drop-trigger, .lang-link {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      min-height: 42px;
      padding: 0 13px;
      border: 1px solid transparent;
      border-radius: 999px;
      background: transparent;
      color: rgba(255,255,255,.82);
      font-size: 13px;
      font-weight: 850;
      letter-spacing: -.01em;
      white-space: nowrap;
      cursor: pointer;
      transition: .2s ease;
    }
    .nav-link:hover, .nav-link.active, .drop-trigger:hover {
      color: #fff;
      background: rgba(255,255,255,.11);
      border-color: rgba(255,255,255,.13);
    }
    .nav-item { position: relative; }
    .dropdown {
      position: absolute;
      top: calc(100% + 12px);
      left: 0;
      width: 284px;
      padding: 10px;
      border: 1px solid rgba(255,255,255,.12);
      border-radius: 22px;
      background: rgba(17,17,20,.94);
      box-shadow: 0 28px 86px rgba(0,0,0,.38);
      backdrop-filter: blur(22px);
      opacity: 0;
      visibility: hidden;
      transform: translateY(8px) scale(.98);
      transition: .2s ease;
    }
    .nav-item:hover .dropdown, .nav-item:focus-within .dropdown {
      opacity: 1;
      visibility: visible;
      transform: translateY(0) scale(1);
    }
    .dropdown a {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 12px;
      padding: 12px 13px;
      border-radius: 15px;
      color: rgba(255,255,255,.78);
      font-size: 13px;
      font-weight: 800;
      transition: .2s ease;
    }
    .dropdown a:hover { background: rgba(229,9,20,.18); color: #fff; transform: translateX(3px); }
    .dropdown a::after { content: "↗"; color: #fff; opacity: .7; }
    .lang-switch { display: inline-flex; gap: 5px; padding: 4px; border: 1px solid rgba(255,255,255,.13); border-radius: 999px; }
    .lang-link { min-height: 32px; padding: 0 10px; font-size: 12px; }
    .lang-link.active, .lang-link:hover { color: #fff; background: var(--red); }
    .menu-toggle {
      display: none;
      width: 46px;
      height: 46px;
      border: 0;
      border-radius: 16px;
      background: var(--red);
      color: #fff;
      font-size: 22px;
      font-weight: 900;
      cursor: pointer;
    }

    .hero {
      min-height: 100vh;
      position: relative;
      display: grid;
      align-items: end;
      overflow: hidden;
      color: #fff;
      background: #050505;
      isolation: isolate;
    }
    .hero-video {
      position: absolute;
      inset: 0;
      z-index: -4;
      overflow: hidden;
      background: #000;
    }
    .hero-video video {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
      display: block;
      filter: saturate(1.08) contrast(1.02);
    }
    .hero::before {
      content: "";
      position: absolute;
      inset: 0;
      z-index: -3;
      background:
        radial-gradient(circle at 76% 18%, rgba(229,9,20,.28), transparent 30%),
        linear-gradient(90deg, rgba(0,0,0,.88) 0%, rgba(0,0,0,.56) 44%, rgba(0,0,0,.18) 100%),
        linear-gradient(180deg, rgba(0,0,0,.12) 0%, rgba(0,0,0,.82) 100%);
    }
    .hero::after {
      content: "";
      position: absolute;
      inset: 0;
      z-index: -2;
      background-image: linear-gradient(rgba(255,255,255,.055) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.055) 1px, transparent 1px);
      background-size: 72px 72px;
      mask-image: linear-gradient(to bottom, rgba(0,0,0,.6), rgba(0,0,0,.06));
    }
    .hero-content {
      width: min(var(--container), calc(100% - 40px));
      margin-inline: auto;
      padding: 170px 0 58px;
    }
    .hero-copy { max-width: 860px; }
    .eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 10px 14px;
      border: 1px solid rgba(255,255,255,.18);
      border-radius: 999px;
      background: rgba(255,255,255,.09);
      backdrop-filter: blur(14px);
      color: rgba(255,255,255,.88);
      font-size: 12px;
      font-weight: 900;
      letter-spacing: .12em;
      text-transform: uppercase;
    }
    .eyebrow::before { content: ""; width: 9px; height: 9px; border-radius: 50%; background: var(--red); box-shadow: 0 0 0 7px rgba(229,9,20,.20); }
    h1, h2, h3 { font-family: "Geist", "Manrope", sans-serif; }
    .hero h1 {
      margin: 24px 0 18px;
      max-width: 900px;
      font-size: clamp(54px, 8vw, 116px);
      line-height: .88;
      letter-spacing: -.08em;
      font-weight: 800;
    }
    .hero p {
      max-width: 790px;
      margin: 0;
      color: rgba(255,255,255,.82);
      font-size: clamp(15px, 1.5vw, 18px);
      font-weight: 500;
    }
    .hero-actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 30px; }
    .btn {
      display: inline-flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
      min-height: 50px;
      padding: 0 19px;
      border: 1px solid transparent;
      border-radius: 999px;
      background: #fff;
      color: var(--dark);
      font-size: 14px;
      font-weight: 900;
      cursor: pointer;
      transition: .23s ease;
    }
    .btn:hover { transform: translateY(-3px); box-shadow: var(--shadow); }
    .btn-red { background: var(--red); color: #fff; box-shadow: var(--shadow-red); }
    .btn-ghost { background: rgba(255,255,255,.08); color: #fff; border-color: rgba(255,255,255,.18); backdrop-filter: blur(14px); }
    .hero-bottom {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 12px;
      margin-top: 46px;
    }
    .hero-tile {
      min-height: 118px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 17px;
      border: 1px solid rgba(255,255,255,.14);
      border-radius: 22px;
      background: rgba(255,255,255,.09);
      backdrop-filter: blur(14px);
      transition: .22s ease;
    }
    .hero-tile:hover { background: rgba(229,9,20,.20); transform: translateY(-4px); }
    .hero-tile small { color: rgba(255,255,255,.62); font-weight: 850; text-transform: uppercase; letter-spacing: .08em; font-size: 10px; }
    .hero-tile strong { font-family: "Sora", sans-serif; font-size: 21px; line-height: 1; letter-spacing: -.04em; }

    .section-head {
      display: flex;
      justify-content: space-between;
      align-items: end;
      gap: 30px;
      margin-bottom: 36px;
    }
    .kicker { display: inline-flex; margin-bottom: 12px; color: var(--red); font-size: 12px; font-weight: 950; letter-spacing: .16em; text-transform: uppercase; }
    .section-head h2, .split-copy h2, .coverage-copy h2, .contact-copy h2 {
      margin: 0;
      max-width: 820px;
      font-size: clamp(36px, 5vw, 68px);
      line-height: .95;
      letter-spacing: -.065em;
      font-weight: 800;
    }
    .section-head p { max-width: 440px; margin: 0; color: var(--muted); font-weight: 600; }
    .dark .section-head p { color: rgba(255,255,255,.66); }

    .service-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 18px; }
    .service-card, .method-card, .news-card, .pest-card, .quality-card {
      position: relative;
      overflow: hidden;
      border-radius: var(--radius-lg);
      background: #fff;
      box-shadow: var(--shadow);
      isolation: isolate;
    }
    .service-card { min-height: 412px; display: grid; grid-template-rows: 230px 1fr; }
    .image-open {
      width: 100%;
      height: 100%;
      padding: 0;
      border: 0;
      display: block;
      overflow: hidden;
      background: #ddd;
      cursor: zoom-in;
      position: relative;
    }
    .image-open::after {
      content: "Lihat gambar";
      position: absolute;
      left: 14px;
      bottom: 14px;
      padding: 9px 12px;
      border-radius: 999px;
      background: rgba(8,8,10,.72);
      color: #fff;
      font-size: 11px;
      font-weight: 900;
      opacity: 0;
      transform: translateY(6px);
      transition: .2s ease;
    }
    .image-open:hover::after { opacity: 1; transform: translateY(0); }
    .image-open img { width: 100%; height: 100%; object-fit: cover; transition: transform .42s ease; }
    .image-open:hover img { transform: scale(1.08); }
    .card-body { display: flex; flex-direction: column; gap: 12px; padding: 22px; }
    .badge {
      display: inline-flex;
      align-items: center;
      width: max-content;
      min-height: 27px;
      padding: 0 10px;
      border-radius: 999px;
      background: var(--soft);
      color: var(--red-2);
      font-size: 11px;
      font-weight: 950;
      text-transform: uppercase;
      letter-spacing: .09em;
    }
    .card-body h3 { margin: 0; font-size: 25px; line-height: 1.03; letter-spacing: -.05em; }
    .card-body p { margin: 0; color: var(--muted); font-size: 14px; font-weight: 600; }
    .card-link { margin-top: auto; color: var(--red); font-size: 13px; font-weight: 950; }
    .card-link:hover { color: var(--red-3); }

    .split { display: grid; grid-template-columns: .92fr 1.08fr; align-items: center; gap: 54px; }
    .media-stack { position: relative; min-height: 660px; }
    .stack-main, .stack-float {
      position: absolute;
      overflow: hidden;
      box-shadow: var(--shadow);
      background: #ddd;
    }
    .stack-main { inset: 0 86px 86px 0; border-radius: 42px; }
    .stack-float { right: 0; bottom: 0; width: 48%; height: 52%; border: 10px solid #f7f7f8; border-radius: 34px; }
    .stat-card {
      position: absolute;
      left: 26px;
      bottom: 44px;
      max-width: 270px;
      padding: 22px;
      border: 1px solid rgba(255,255,255,.14);
      border-radius: 26px;
      background: linear-gradient(135deg, rgba(229,9,20,.94), rgba(122,2,8,.96));
      color: #fff;
      box-shadow: var(--shadow-red);
    }
    .stat-card strong { display: block; font-family: "Sora", sans-serif; font-size: 48px; line-height: .9; letter-spacing: -.07em; }
    .stat-card span { display: block; margin-top: 8px; color: rgba(255,255,255,.78); font-size: 13px; font-weight: 750; }
    .split-copy p { margin: 18px 0 0; color: var(--muted); font-weight: 600; }
    .quote {
      margin-top: 24px;
      padding: 24px;
      border-left: 5px solid var(--red);
      border-radius: 0 24px 24px 0;
      background: #fff;
      box-shadow: var(--shadow);
      color: var(--muted);
      font-weight: 700;
    }

    .quality-wrap {
      position: relative;
      overflow: hidden;
      background: var(--dark);
      color: #fff;
    }
    .quality-wrap::before {
      content: "";
      position: absolute;
      inset: 0;
      background:
        radial-gradient(circle at 80% 16%, rgba(229,9,20,.35), transparent 26%),
        linear-gradient(180deg, rgba(8,8,10,.72), rgba(8,8,10,.96)),
        url('https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389697/Arima_foto_56_zajuwd.png') center/cover no-repeat;
      opacity: 1;
    }
    .quality-wrap .container { position: relative; }
    .quality-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
    .quality-card {
      min-height: 330px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 28px;
      border: 1px solid rgba(255,255,255,.14);
      background: rgba(255,255,255,.08);
      backdrop-filter: blur(18px);
      color: #fff;
      transition: .24s ease;
    }
    .quality-card:hover { transform: translateY(-8px); background: rgba(229,9,20,.18); }
    .quality-icon { width: 60px; height: 60px; display: grid; place-items: center; border-radius: 20px; background: #fff; color: var(--red); font-size: 23px; font-weight: 950; }
    .quality-card h3 { margin: 24px 0 12px; font-size: 28px; line-height: 1; letter-spacing: -.05em; }
    .quality-card p { margin: 0; color: rgba(255,255,255,.72); font-weight: 600; }

    .method-grid { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 18px; }
    .method-card { min-height: 430px; display: grid; grid-template-rows: 235px 1fr; }
    .method-number { position: absolute; top: 18px; left: 18px; z-index: 2; display: grid; place-items: center; width: 52px; height: 52px; border-radius: 18px; background: var(--red); color: #fff; font-weight: 950; box-shadow: var(--shadow-red); }

    .pest-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px; }
    .pest-card { min-height: 470px; display: grid; grid-template-rows: 290px 1fr; }

    .mosaic { display: grid; grid-template-columns: repeat(12, 1fr); gap: 14px; }
    .mosaic .image-open { min-height: 250px; border-radius: 26px; box-shadow: var(--shadow); }
    .span-6 { grid-column: span 6; }
    .span-4 { grid-column: span 4; }
    .span-3 { grid-column: span 3; }
    .tall { min-height: 380px !important; }

    .coverage-card {
      width: min(1480px, calc(100vw - 40px));
      overflow: hidden;
      border-radius: 40px;
      background: rgba(255,255,255,.94);
      box-shadow: var(--shadow);
      border: 1px solid rgba(8,8,10,.08);
      backdrop-filter: blur(18px);
    }
    .coverage-grid { display: grid; grid-template-columns: 430px minmax(0, 1fr); min-height: 740px; }
    .coverage-copy { padding: 48px; background: linear-gradient(180deg, #fff, #fff6f7); display: flex; flex-direction: column; }
    .coverage-copy h2 { font-size: clamp(36px, 4.8vw, 66px); letter-spacing: -.07em; line-height: .95; }
    .coverage-copy p { color: var(--muted); font-weight: 720; }
    .search-box { position: relative; margin-top: 24px; }
    .search-box input {
      width: 100%;
      height: 58px;
      border: 1px solid rgba(8,8,10,.12);
      border-radius: 20px;
      padding: 0 48px 0 18px;
      outline: none;
      background: #fff;
      color: var(--ink);
      font-weight: 800;
      box-shadow: 0 18px 48px rgba(8,8,10,.06);
      transition: .22s ease;
    }
    .search-box input:focus { border-color: rgba(229,9,20,.62); box-shadow: 0 0 0 6px rgba(229,9,20,.10), 0 18px 48px rgba(8,8,10,.08); }
    .search-box span { position: absolute; right: 18px; top: 50%; transform: translateY(-50%); color: var(--red); font-weight: 950; }
    .region-list { display: grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 10px; margin-top: 18px; max-height: 410px; overflow: auto; padding-right: 6px; }
    .region-chip {
      border: 1px solid rgba(229,9,20,.10);
      border-radius: 18px;
      padding: 12px 13px;
      background: #fff;
      color: var(--ink);
      font-size: 12px;
      font-weight: 900;
      cursor: pointer;
      text-align: left;
      box-shadow: 0 10px 28px rgba(8,8,10,.045);
      transition: .2s ease;
    }
    .region-chip small { display: block; margin-top: 2px; color: var(--muted); font-size: 10px; font-weight: 850; }
    .region-chip:hover, .region-chip.active { background: var(--red); color: #fff; transform: translateY(-2px); box-shadow: var(--shadow-red); }
    .region-chip:hover small, .region-chip.active small { color: rgba(255,255,255,.78); }
    .coverage-actions { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 22px; }
    .map-panel { position: relative; min-height: 740px; padding: 20px; background: linear-gradient(145deg, #08080a 0%, #141418 58%, #260206 100%); overflow: hidden; display: flex; flex-direction: column; }
    .map-panel::before { content: ""; position: absolute; inset: 0; background: radial-gradient(circle at 76% 18%, rgba(229,9,20,.25), transparent 32%); z-index: 0; pointer-events: none; }
    .map-stage { position: relative; z-index: 2; height: 640px; min-height: 640px; border: 1px solid rgba(255,255,255,.16); border-radius: 30px; background: #e8edf1; box-shadow: inset 0 1px 0 rgba(255,255,255,.12), 0 30px 90px rgba(0,0,0,.26); overflow: hidden; isolation: isolate; }
    #coverageMap { position: relative !important; display: block !important; z-index: 1; width: 100% !important; height: 100% !important; min-height: 640px !important; background: #e8edf1 !important; }
    .map-title { position: absolute; top: 18px; left: 18px; z-index: 700; display: grid; gap: 2px; color: #fff; padding: 12px 14px; border: 1px solid rgba(255,255,255,.14); border-radius: 18px; background: rgba(5,5,7,.72); backdrop-filter: blur(14px); box-shadow: 0 16px 44px rgba(0,0,0,.22); pointer-events: none; }
    .map-title strong { font-size: 14px; letter-spacing: -.02em; }
    .map-title span { color: rgba(255,255,255,.72); font-size: 11px; font-weight: 800; }
    .map-reset { position: absolute; right: 18px; top: 18px; z-index: 700; min-height: 40px; padding: 0 14px; border: 1px solid rgba(255,255,255,.18); background: rgba(5,5,7,.74); color: #fff; border-radius: 999px; font-size: 11px; font-weight: 950; cursor: pointer; backdrop-filter: blur(12px); transition: .2s ease; }
    .map-reset:hover { background: var(--red); border-color: var(--red); transform: translateY(-1px); }
    .map-legend { position: absolute; left: 18px; bottom: 18px; z-index: 700; display: inline-flex; align-items: center; gap: 8px; max-width: calc(100% - 36px); padding: 10px 12px; border: 1px solid rgba(255,255,255,.14); border-radius: 999px; background: rgba(5,5,7,.74); color: rgba(255,255,255,.82); font-size: 11px; font-weight: 850; backdrop-filter: blur(12px); box-shadow: 0 16px 44px rgba(0,0,0,.20); }
    .map-legend i { width: 12px; height: 12px; border-radius: 999px; background: var(--red); box-shadow: 0 0 0 5px rgba(229,9,20,.20); }
    #coverageMap.leaflet-container { font-family: "Manrope", "Geist", system-ui, sans-serif; color: var(--ink); overflow: hidden !important; }
    #coverageMap .leaflet-pane,
    #coverageMap .leaflet-tile,
    #coverageMap .leaflet-marker-icon,
    #coverageMap .leaflet-marker-shadow,
    #coverageMap .leaflet-tile-container,
    #coverageMap .leaflet-pane > svg,
    #coverageMap .leaflet-pane > canvas,
    #coverageMap .leaflet-zoom-box,
    #coverageMap .leaflet-image-layer,
    #coverageMap .leaflet-layer { position: absolute !important; left: 0; top: 0; }
    #coverageMap .leaflet-tile { max-width: none !important; max-height: none !important; width: 256px !important; height: 256px !important; padding: 0 !important; border: 0 !important; }
    #coverageMap .leaflet-control-container .leaflet-top,
    #coverageMap .leaflet-control-container .leaflet-bottom { position: absolute; z-index: 800; pointer-events: none; }
    #coverageMap .leaflet-top { top: 0; }
    #coverageMap .leaflet-right { right: 0; }
    #coverageMap .leaflet-bottom { bottom: 0; }
    #coverageMap .leaflet-left { left: 0; }
    #coverageMap .leaflet-control { position: relative; z-index: 800; pointer-events: auto; float: left; clear: both; }
    #coverageMap .leaflet-right .leaflet-control { float: right; }
    #coverageMap .leaflet-control-zoom { border: 0 !important; box-shadow: 0 16px 44px rgba(0,0,0,.22) !important; margin: 86px 0 0 14px !important; }
    #coverageMap .leaflet-control-zoom a { border: 0 !important; color: var(--red) !important; font-weight: 950; }
    #coverageMap .leaflet-control-attribution { background: rgba(255,255,255,.88) !important; border-radius: 999px 0 0 0; font-size: 10px; }
    .arima-marker { width: 20px !important; height: 20px !important; margin-left: -10px !important; margin-top: -10px !important; display: grid; place-items: center; border: 2px solid #fff; border-radius: 999px; background: var(--red); box-shadow: 0 0 0 7px rgba(229,9,20,.18), 0 14px 34px rgba(0,0,0,.38); transition: transform .2s ease, box-shadow .2s ease, opacity .2s ease; }
    .arima-marker span { width: 7px; height: 7px; border-radius: inherit; background: #fff; font-size: 0; }
    .arima-marker:hover, .arima-marker.active { transform: scale(1.28); box-shadow: 0 0 0 11px rgba(229,9,20,.26), 0 20px 48px rgba(0,0,0,.45); z-index: 999 !important; }
    .arima-marker.is-muted { opacity: .25; }
    .leaflet-popup-content-wrapper { border-radius: 20px; box-shadow: 0 24px 70px rgba(0,0,0,.26); }
    .leaflet-popup-content { margin: 14px 16px 16px; min-width: 210px; }
    .map-popup { display: grid; gap: 6px; }
    .map-popup strong { font-family: "Geist", "Manrope", sans-serif; font-size: 18px; line-height: 1; letter-spacing: -.04em; color: var(--ink); }
    .map-popup span { color: var(--muted); font-size: 12px; font-weight: 800; }
    .map-popup a { display: inline-flex; align-items: center; justify-content: center; min-height: 36px; margin-top: 6px; padding: 0 12px; border-radius: 999px; background: var(--red); color: #fff; font-size: 11px; font-weight: 950; }
    .map-popup a:hover { background: var(--red-2); }
    .map-fallback { height: 100%; display: grid; place-items: center; padding: 32px; color: rgba(255,255,255,.78); text-align: center; font-weight: 850; }
    .map-note {
      position: relative;
      z-index: 3;
      display: flex;
      justify-content: space-between;
      gap: 12px;
      align-items: center;
      margin-top: 16px;
      padding: 16px 18px;
      border: 1px solid rgba(255,255,255,.16);
      border-radius: 22px;
      background: rgba(8,8,10,.62);
      color: rgba(255,255,255,.86);
      backdrop-filter: blur(16px);
      font-size: 12px;
      font-weight: 800;
      text-decoration: none;
    }
    .map-note:hover {
      border-color: rgba(229,9,20,.62);
      background: rgba(229,9,20,.16);
      color: #fff;
    }

    .news-grid { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 18px; }
    .news-card { min-height: 430px; display: grid; grid-template-rows: 235px 1fr; }

    .contact-wrap { padding-bottom: 0; background: #fff; }
    .contact-card {
      display: grid;
      grid-template-columns: .95fr 1.05fr;
      overflow: hidden;
      border-radius: 38px;
      background: var(--dark);
      color: #fff;
      box-shadow: var(--shadow);
    }
    .contact-copy { padding: 46px; }
    .contact-copy p { color: rgba(255,255,255,.70); font-weight: 650; }
    .contact-list { display: grid; gap: 12px; margin-top: 24px; }
    .contact-list a {
      display: grid;
      grid-template-columns: 52px minmax(0, 1fr) auto;
      gap: 14px;
      align-items: center;
      padding: 16px;
      border: 1px solid rgba(255,255,255,.12);
      border-radius: 20px;
      background: rgba(255,255,255,.07);
      transition: .2s ease;
    }
    .contact-list a:hover { background: rgba(229,9,20,.18); transform: translateX(4px); }
    .contact-list i { display: grid; place-items: center; width: 52px; height: 52px; border-radius: 16px; background: var(--red); color: #fff; font-style: normal; font-weight: 950; }
    .contact-list i svg { width: 24px; height: 24px; stroke: currentColor; stroke-width: 2.2; fill: none; stroke-linecap: round; stroke-linejoin: round; }
    .contact-list b { display: block; }
    .contact-list span span { display: block; color: rgba(255,255,255,.68); font-size: 13px; font-weight: 650; }
    .contact-action {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 32px;
      padding: 0 10px;
      border: 1px solid rgba(255,255,255,.12);
      color: rgba(255,255,255,.76);
      font-size: 10px;
      font-weight: 950;
      font-style: normal;
      text-transform: uppercase;
      white-space: nowrap;
    }
    .contact-side {
      position: relative;
      min-height: 680px;
      padding: 30px;
      background: url('https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389650/Arima_foto_3_npsvfn.png') center/cover no-repeat;
    }
    .contact-side::before { content: ""; position: absolute; inset: 0; background: linear-gradient(180deg, rgba(8,8,10,.10), rgba(8,8,10,.84)); }
    .contact-form {
      position: relative;
      margin: auto 0 0 auto;
      width: min(430px, 100%);
      padding: 23px;
      border: 1px solid rgba(255,255,255,.18);
      border-radius: 28px;
      background: rgba(255,255,255,.95);
      color: var(--ink);
      box-shadow: 0 34px 90px rgba(0,0,0,.34);
    }
    .contact-form h3 { margin: 0 0 14px; font-size: 26px; line-height: 1; letter-spacing: -.05em; }
    .field { display: grid; gap: 7px; margin-top: 12px; }
    .field label { color: var(--muted); font-size: 12px; font-weight: 900; }
    .field input, .field textarea {
      width: 100%;
      border: 1px solid rgba(8,8,10,.12);
      border-radius: 16px;
      padding: 13px 14px;
      outline: none;
      background: #fff;
      transition: .2s ease;
    }
    .field input:focus, .field textarea:focus { border-color: rgba(229,9,20,.54); box-shadow: 0 0 0 5px rgba(229,9,20,.10); }
    .contact-form .btn { width: 100%; margin-top: 15px; border: 0; }

    footer { margin-top: 88px; background: var(--dark); color: rgba(255,255,255,.72); }
    .footer-row { min-height: 126px; display: flex; align-items: center; justify-content: space-between; gap: 22px; }
    footer img { width: 142px; padding: 0; border-radius: 0; background: transparent; filter: none; }
    .footer-links { display: flex; flex-wrap: wrap; gap: 12px; justify-content: flex-end; font-size: 13px; font-weight: 850; }
    .footer-links a:hover { color: #fff; }

    .lightbox {
      position: fixed;
      inset: 0;
      z-index: 3000;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 24px;
      background: rgba(0,0,0,.88);
    }
    .lightbox.open { display: flex; }
    .lightbox-inner { width: min(1100px, 96vw); max-height: 92vh; position: relative; }
    .lightbox img, .lightbox video { width: 100%; max-height: 82vh; object-fit: contain; border-radius: 26px; background: #000; box-shadow: 0 28px 110px rgba(0,0,0,.55); }
    .lightbox video { display: none; }
    .lightbox-caption { margin-top: 12px; color: rgba(255,255,255,.82); font-size: 14px; font-weight: 750; text-align: center; }
    .lightbox-close {
      position: absolute;
      right: -10px;
      top: -48px;
      width: 42px;
      height: 42px;
      border: 1px solid rgba(255,255,255,.16);
      border-radius: 999px;
      background: rgba(255,255,255,.10);
      color: #fff;
      font-size: 24px;
      cursor: pointer;
    }

    .reveal { opacity: 0; transform: translateY(24px); transition: opacity .65s ease, transform .65s ease; }
    .reveal.visible { opacity: 1; transform: translateY(0); }

    @media (max-width: 640px) {
      .client-logo-card { width: 178px; min-height: 98px; padding: 18px 16px; }
      .client-logo-card strong { font-size: 27px; }
      .client-logo-card small { font-size: 9px; }
    }

    @media (max-width: 1120px) {
      .main-nav {
        display: none;
        position: fixed;
        left: 18px;
        right: 18px;
        top: 128px;
        flex-direction: column;
        align-items: stretch;
        padding: 14px;
        border: 1px solid rgba(255,255,255,.14);
        border-radius: 24px;
        background: rgba(17,17,20,.96);
        box-shadow: 0 28px 86px rgba(0,0,0,.42);
      }
      .main-nav.open { display: flex; }
      .menu-toggle { display: grid; place-items: center; }
      .nav-link, .drop-trigger { justify-content: space-between; width: 100%; }
      .nav-item { width: 100%; }
      .dropdown { position: static; display: none; width: 100%; visibility: visible; opacity: 1; transform: none; margin: 4px 0 10px; box-shadow: none; background: rgba(255,255,255,.06); }
      .nav-item.open .dropdown { display: block; }
      .nav-item:hover .dropdown { display: none; }
      .nav-item.open:hover .dropdown { display: block; }
      .lang-switch { width: max-content; margin-top: 4px; }
      .service-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
      .hero-bottom { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    @media (max-width: 940px) {
      .section { padding: 86px 0; }
      .section-head, .split, .coverage-grid, .contact-card { grid-template-columns: 1fr; }
      .section-head { flex-direction: column; align-items: start; }
      .quality-grid, .method-grid, .news-grid, .pest-grid { grid-template-columns: 1fr; }
      .media-stack { min-height: 540px; }
      .map-panel { min-height: 640px; }
      .map-stage { height: 520px; min-height: 520px; }
      #coverageMap { min-height: 520px !important; }
      .contact-side { min-height: 560px; }
    }
    @media (max-width: 640px) {
      .container, .hero-content { width: min(100% - 28px, var(--container)); }
      .topbar .container { justify-content: center; text-align: center; }
      .topbar a:nth-child(2), .topbar a:nth-child(3) { display: none; }
      .brand img { width: 124px; }
      .hero-content { padding-top: 148px; }
      .hero h1 { font-size: 54px; }
      .hero-bottom, .service-grid { grid-template-columns: 1fr; }
      .span-6, .span-4, .span-3 { grid-column: span 12; }
      .mosaic .image-open { min-height: 280px; }
      .stack-main { inset: 0 40px 74px 0; }
      .stack-float { width: 58%; height: 46%; border-width: 7px; }
      .stat-card { left: 14px; bottom: 28px; }
      .coverage-copy, .contact-copy { padding: 28px; }
      .contact-list a { grid-template-columns: 52px minmax(0, 1fr); }
      .contact-action { grid-column: 2; justify-self: start; }
      .region-list { grid-template-columns: 1fr; }
      .map-note { flex-direction: column; align-items: start; }
      .coverage-card { width: min(100% - 28px, var(--container)); }
      .region-list { grid-template-columns: 1fr; max-height: 310px; }
      .map-stage { height: 460px; min-height: 460px; border-radius: 24px; }
      #coverageMap { min-height: 460px !important; }
      .map-title { max-width: calc(100% - 116px); }
      .map-title span { display: none; }
      .floating-wa { right: 14px; bottom: 14px; width: 56px; height: 56px; }
      .floating-wa svg { width: 27px; height: 27px; }
      .footer-row { flex-direction: column; justify-content: center; text-align: center; padding: 30px 0; }
      .footer-links { justify-content: center; }
    }
  </style>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIINfQkf5I/qqi1N3fQxgkC7bS5p+0l4wB0=" crossorigin="" />
  <style id="arima-leaflet-stability-fix">
    #coverageMap.leaflet-container, #coverageMap .leaflet-map-pane, #coverageMap .leaflet-tile-pane, #coverageMap .leaflet-overlay-pane, #coverageMap .leaflet-marker-pane, #coverageMap .leaflet-popup-pane { position: absolute; }
    #coverageMap.leaflet-container { position: relative !important; width: 100% !important; height: 100% !important; overflow: hidden !important; }
    #coverageMap .leaflet-tile { max-width: none !important; max-height: none !important; width: 256px !important; height: 256px !important; }
  </style>

  <style id="black-red-square-theme">
    /* ==========================================================
       ARIMA BLACK x RED / FULL HERO / SQUARE MODERN THEME
       Tema ini sengaja dibuat tegas: radius 0, panel kotak,
       navbar full-width modern, hero video full screen.
       Bagian Leaflet/OpenStreetMap tetap memakai struktur asli.
       ========================================================== */
    :root {
      --red: #ef111d;
      --red-2: #b5000b;
      --red-3: #7c0007;
      --dark: #030305;
      --dark-2: #0a0a0e;
      --ink: #f5f5f5;
      --muted: #b8b8bf;
      --muted-2: #777781;
      --paper: #0c0c10;
      --soft: #111115;
      --line: rgba(255,255,255,.16);
      --line-dark: rgba(255,255,255,.12);
      --shadow: 12px 12px 0 rgba(0,0,0,.55);
      --shadow-red: 12px 12px 0 rgba(239,17,29,.28);
      --radius-xl: 0px;
      --radius-lg: 0px;
      --radius-md: 0px;
      --container: 1280px;
    }

    html { scroll-padding-top: 112px; }
    body {
      color: #f5f5f5;
      background:
        linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px),
        #050506;
      background-size: 44px 44px;
    }
    * { border-radius: 0 !important; }
    ::selection { background: var(--red); color: #fff; }

    .container { width: min(var(--container), calc(100% - 48px)); }
    .section {
      padding: 118px 0;
      background: #070709;
      border-top: 1px solid rgba(255,255,255,.10);
      border-bottom: 1px solid rgba(0,0,0,.9);
    }
    .section.soft {
      background:
        linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px),
        linear-gradient(180deg, #111114 0%, #08080a 100%);
      background-size: 36px 36px, 36px 36px, auto;
      color: #fff;
    }
    .section.dark { background: #030305; color: #fff; }

    /* FULL MODERN NAVBAR */
    .site-header {
      position: fixed;
      inset: 0 0 auto 0;
      z-index: 1200;
      color: #fff;
      background: rgba(3,3,5,.92);
      border: 0;
      border-bottom: 1px solid rgba(255,255,255,.16);
      backdrop-filter: blur(18px);
      box-shadow: 0 16px 50px rgba(0,0,0,.42);
    }
    .site-header::before {
      content: "";
      position: absolute;
      left: 0;
      right: 0;
      bottom: -1px;
      height: 2px;
      background: linear-gradient(90deg, var(--red), transparent 34%, rgba(255,255,255,.2), transparent 68%, var(--red));
      pointer-events: none;
    }
    .topbar {
      background: #000;
      border: 0;
      border-bottom: 1px solid rgba(255,255,255,.12);
      color: rgba(255,255,255,.76);
      text-transform: uppercase;
      font-size: 11px;
      letter-spacing: .08em;
    }
    .topbar .container { min-height: 36px; }
    .topbar a { color: rgba(255,255,255,.76); opacity: 1; }
    .topbar a:hover { color: #fff; transform: none; }
    .navrow {
      min-height: 82px;
      display: grid;
      grid-template-columns: 188px minmax(0,1fr) 54px;
      gap: 22px;
    }
    .brand { padding: 0; height: 82px; align-items: center; }
    .brand img {
      width: 156px;
      background: transparent;
      padding: 0;
      border: 0;
      filter: none;
    }
    .main-nav {
      height: 82px;
      justify-content: flex-end;
      gap: 0;
    }
    .nav-link, .drop-trigger, .lang-link {
      min-height: 82px;
      padding: 0 18px;
      border: 0;
      border-left: 1px solid rgba(255,255,255,.10);
      color: rgba(255,255,255,.76);
      background: transparent;
      font-size: 12px;
      font-weight: 900;
      letter-spacing: .08em;
      text-transform: uppercase;
    }
    .nav-link:hover, .nav-link.active, .drop-trigger:hover {
      color: #fff;
      background: linear-gradient(180deg, rgba(239,17,29,.24), rgba(239,17,29,.08));
      border-color: rgba(255,255,255,.10);
      box-shadow: inset 0 -3px 0 var(--red);
    }
    .dropdown {
      top: 100%;
      left: 0;
      width: 326px;
      padding: 0;
      border: 1px solid rgba(255,255,255,.16);
      background: rgba(4,4,6,.96);
      box-shadow: 14px 14px 0 rgba(0,0,0,.50);
      backdrop-filter: blur(18px);
    }
    .dropdown a {
      min-height: 52px;
      padding: 0 16px;
      border-bottom: 1px solid rgba(255,255,255,.09);
      color: rgba(255,255,255,.78);
      text-transform: uppercase;
      letter-spacing: .05em;
      font-size: 12px;
    }
    .dropdown a:hover { background: var(--red); color: #fff; transform: none; }
    .lang-switch {
      padding: 0;
      gap: 0;
      border: 0;
      border-left: 1px solid rgba(255,255,255,.10);
    }
    .lang-link { min-height: 82px; padding: 0 12px; border-left: 0; }
    .lang-link.active, .lang-link:hover { background: var(--red); color: #fff; }
    .menu-toggle {
      width: 54px;
      height: 54px;
      border: 1px solid rgba(255,255,255,.16);
      background: var(--red);
      color: #fff;
    }

    /* HERO FULL VIDEO */
    /* HERO BRIGHTNESS UPDATE: video dibuat lebih terang dan overlay dikurangi agar footage lebih jelas. */
    .hero {
      min-height: 100svh;
      display: grid;
      align-items: stretch;
      background: #000;
      border-bottom: 1px solid rgba(255,255,255,.14);
    }
    .hero-video { inset: 0; z-index: -5; }
    .hero-video video {
      width: 100vw;
      height: 100svh;
      object-fit: cover;
      object-position: center;
      filter: saturate(1.12) contrast(1.06) brightness(1.08);
    }
    .hero::before {
      z-index: -4;
      background:
        linear-gradient(90deg, rgba(0,0,0,.82) 0%, rgba(0,0,0,.58) 34%, rgba(0,0,0,.10) 68%, rgba(0,0,0,.42) 100%),
        radial-gradient(circle at 78% 20%, rgba(239,17,29,.24), transparent 30%),
        linear-gradient(180deg, rgba(0,0,0,.06) 0%, rgba(0,0,0,.55) 100%);
    }
    .hero::after {
      z-index: -3;
      background-image:
        linear-gradient(rgba(255,255,255,.045) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.045) 1px, transparent 1px),
        linear-gradient(120deg, transparent 0 48%, rgba(239,17,29,.16) 48% 49%, transparent 49% 100%);
      background-size: 64px 64px, 64px 64px, 100% 100%;
      mask-image: linear-gradient(to right, rgba(0,0,0,.82), rgba(0,0,0,.18));
    }
    .hero-content {
      min-height: 100svh;
      display: grid;
      grid-template-rows: 1fr auto;
      align-content: end;
      padding: 178px 0 42px;
    }
    .hero-copy {
      max-width: 1080px;
      align-self: end;
      padding: 34px 36px 38px;
      border-left: 8px solid var(--red);
      background: linear-gradient(90deg, rgba(0,0,0,.54), rgba(0,0,0,.06));
      box-shadow: 24px 24px 0 rgba(239,17,29,.10);
    }
    .eyebrow {
      border: 1px solid var(--red);
      background: var(--red);
      color: #fff;
      padding: 16px 24px;
      font-size: clamp(18px, 2vw, 30px);
      letter-spacing: .12em;
      box-shadow: 0 16px 42px rgba(229, 9, 20, .32);
    }
    .eyebrow::before { content: none; display: none; }
    .hero h1 {
      max-width: 1060px;
      margin: 22px 0 18px;
      font-family: "Barlow Condensed", "Geist", sans-serif;
      font-size: clamp(72px, 11vw, 168px);
      line-height: .72;
      letter-spacing: -.055em;
      text-transform: uppercase;
      text-shadow: 0 18px 52px rgba(0,0,0,.60);
    }
    .hero p {
      max-width: 820px;
      color: rgba(255,255,255,.82);
      font-size: clamp(15px, 1.35vw, 19px);
      line-height: 1.75;
    }
    .hero-actions { gap: 0; margin-top: 28px; }
    .hero-actions .btn { margin-right: -1px; }
    .btn {
      min-height: 54px;
      padding: 0 22px;
      border: 1px solid rgba(255,255,255,.18);
      background: #fff;
      color: #060608;
      text-transform: uppercase;
      font-size: 12px;
      letter-spacing: .08em;
      box-shadow: none;
    }
    .btn:hover { transform: translateY(-2px); box-shadow: 8px 8px 0 rgba(0,0,0,.38); }
    .btn-red { background: var(--red); color: #fff; border-color: var(--red); box-shadow: none; }
    .btn-ghost { background: rgba(0,0,0,.34); color: #fff; border-color: rgba(255,255,255,.22); backdrop-filter: blur(12px); }
    .hero-bottom {
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 0;
      margin-top: 34px;
      border: 1px solid rgba(255,255,255,.15);
      border-bottom: 4px solid var(--red);
      background: rgba(0,0,0,.34);
      backdrop-filter: blur(12px);
    }
    .hero-tile {
      min-height: 118px;
      padding: 20px;
      border: 0;
      border-right: 1px solid rgba(255,255,255,.13);
      background: transparent;
      backdrop-filter: none;
    }
    .hero-tile:last-child { border-right: 0; }
    .hero-tile:hover { background: var(--red); transform: none; }
    .hero-tile small { color: rgba(255,255,255,.62); }
    .hero-tile strong {
      font-family: "Barlow Condensed", "Geist", sans-serif;
      text-transform: uppercase;
      font-size: 35px;
      letter-spacing: -.04em;
    }


    /* RUNNING TEXT FROM INDEX-2 */
    .marquee {
      overflow: hidden;
      background: var(--red);
      color: #fff;
      border-top: 1px solid rgba(255,255,255,.18);
      border-bottom: 1px solid rgba(255,255,255,.18);
    }
    .marquee-track {
      display: flex;
      width: max-content;
      animation: slideText 24s linear infinite;
    }
    .marquee span {
      padding: 16px 24px;
      font-family: "Barlow Condensed", "Geist", "Manrope", sans-serif;
      font-size: clamp(18px, 2vw, 32px);
      font-weight: 900;
      letter-spacing: -.03em;
      text-transform: uppercase;
      white-space: nowrap;
    }
    @keyframes slideText { to { transform: translateX(-50%); } }

    /* ISO SECTION */
    .iso-section {
      position: relative;
      overflow: hidden;
      padding: clamp(48px, 5vw, 74px) 0;
      background:
        radial-gradient(circle at 8% 8%, rgba(229,9,20,.18), transparent 30%),
        radial-gradient(circle at 96% 8%, rgba(229,9,20,.10), transparent 26%),
        linear-gradient(180deg, #050507 0%, #0b0c10 100%);
      color: #fff;
      border-top: 1px solid rgba(255,255,255,.10);
      border-bottom: 1px solid rgba(255,255,255,.10);
    }
    .iso-section::before {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(90deg, rgba(229,9,20,.10), transparent 38%);
      opacity: .55;
      pointer-events: none;
    }
    .iso-section::after {
      content: "ISO";
      position: absolute;
      right: clamp(16px, 5vw, 84px);
      top: 24px;
      color: rgba(255,255,255,.025);
      font-family: "Barlow Condensed", "Geist", sans-serif;
      font-size: clamp(70px, 10vw, 150px);
      font-weight: 950;
      line-height: .72;
      letter-spacing: -.07em;
      pointer-events: none;
    }
    .iso-section .container { position: relative; z-index: 2; }
    .iso-section .section-head {
      display: grid;
      grid-template-columns: minmax(0, 1fr) minmax(260px, 390px);
      align-items: end;
      gap: clamp(18px, 3vw, 44px);
      max-width: 1010px;
      margin: 0 auto 22px;
      padding-left: 0;
      border-left: 0;
    }
    .iso-section .section-head > div {
      padding-left: 18px;
      border-left: 5px solid var(--red);
    }
    .iso-section .kicker {
      display: inline-flex;
      align-items: center;
      min-height: 24px;
      padding: 0 9px;
      margin-bottom: 10px;
      background: rgba(229,9,20,.16);
      border: 1px solid rgba(229,9,20,.58);
      color: #fff;
      font-size: 10px;
      letter-spacing: .16em;
    }
    .iso-section .section-head h2 {
      max-width: 650px;
      color: #fff;
      font-family: "Barlow Condensed", "Geist", sans-serif;
      font-size: clamp(34px, 4vw, 58px);
      line-height: .90;
      letter-spacing: -.04em;
      text-transform: uppercase;
    }
    .iso-section .section-head p {
      max-width: 390px;
      padding-top: 14px;
      border-top: 1px solid rgba(255,255,255,.14);
      color: rgba(255,255,255,.72);
      font-size: 13px;
      line-height: 1.65;
      font-weight: 650;
    }
    .iso-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 10px;
      max-width: 1010px;
      margin: 0 auto;
      padding: 10px;
      align-items: stretch;
      border: 1px solid rgba(255,255,255,.12);
      background: rgba(255,255,255,.035);
      backdrop-filter: blur(10px);
    }
    .iso-card {
      position: relative;
      overflow: hidden;
      min-height: 0;
      display: flex;
      flex-direction: column;
      border: 1px solid rgba(255,255,255,.11);
      border-radius: 0;
      background: #0b0c10;
      box-shadow: none;
      transition: transform .22s ease, border-color .22s ease, background .22s ease;
    }
    .iso-card::before {
      content: "";
      display: block;
      height: 3px;
      width: 100%;
      background: var(--red);
      flex: 0 0 auto;
    }
    .iso-card:hover {
      transform: translateY(-3px);
      border-color: rgba(229,9,20,.70);
      background: #101116;
    }
    .iso-card .iso-image-button {
      width: 100%;
      min-height: 248px;
      display: grid;
      place-items: center;
      padding: 18px;
      background: linear-gradient(180deg, #ffffff, #f7f7f7);
      border-radius: 0;
      border: 0;
      overflow: hidden;
      cursor: zoom-in;
      position: relative;
      text-align: center;
      appearance: none;
    }
    .iso-card .iso-image-button::after { content: none !important; display: none !important; }
    .iso-card .iso-image-button img {
      display: block;
      width: auto !important;
      height: auto !important;
      max-width: 92% !important;
      max-height: 212px !important;
      margin: auto !important;
      object-fit: contain !important;
      object-position: center center !important;
      transform: none !important;
      filter: drop-shadow(0 10px 18px rgba(8,8,10,.12));
    }
    .iso-card .iso-image-button:hover img {
      transform: none !important;
      filter: drop-shadow(0 12px 22px rgba(8,8,10,.16));
    }
    .iso-card-caption {
      position: static;
      left: auto;
      right: auto;
      bottom: auto;
      min-height: 46px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 12px 14px;
      background: #0b0c10;
      color: #fff;
      border: 0;
      border-top: 1px solid rgba(255,255,255,.10);
      backdrop-filter: none;
      font-size: 10px;
      font-weight: 950;
      text-transform: uppercase;
      letter-spacing: .08em;
      pointer-events: none;
    }
    .iso-card-caption span:first-child {
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    /* TYPOGRAPHY + SECTION HEADS */
    .kicker {
      color: var(--red);
      font-size: 12px;
      letter-spacing: .22em;
      font-weight: 1000;
    }
    .section-head {
      align-items: stretch;
      border-left: 8px solid var(--red);
      padding-left: 24px;
      margin-bottom: 42px;
    }
    .section-head h2, .split-copy h2, .coverage-copy h2, .contact-copy h2 {
      color: #fff;
      font-family: "Barlow Condensed", "Geist", sans-serif;
      font-size: clamp(50px, 6.2vw, 102px);
      line-height: .78;
      letter-spacing: -.045em;
      text-transform: uppercase;
    }
    .section-head p, .split-copy p, .coverage-copy p { color: rgba(255,255,255,.66); }

    /* CARDS: SQUARE / HIGH-CONTRAST */
    .service-grid, .method-grid, .news-grid, .quality-grid, .pest-grid { gap: 0; border: 1px solid rgba(255,255,255,.12); }
    .service-card, .method-card, .news-card, .pest-card, .quality-card {
      background: #0c0c10;
      color: #fff;
      border-right: 1px solid rgba(255,255,255,.12);
      border-bottom: 1px solid rgba(255,255,255,.12);
      box-shadow: none;
    }
    .service-card:hover, .method-card:hover, .news-card:hover, .pest-card:hover { outline: 2px solid var(--red); outline-offset: -2px; }
    .service-card { min-height: 460px; grid-template-rows: 260px 1fr; }
    .image-open { background: #121218; }
    .image-open::after {
      background: var(--red);
      color: #fff;
      left: 0;
      bottom: 0;
      padding: 10px 14px;
      transform: translateY(0);
    }
    .image-open:hover img { transform: scale(1.04); filter: saturate(1.08) contrast(1.06); }
    .card-body { padding: 24px; gap: 14px; }
    .badge {
      background: rgba(239,17,29,.15);
      border: 1px solid rgba(239,17,29,.56);
      color: #fff;
      min-height: 28px;
      padding: 0 10px;
    }
    .card-body h3 {
      color: #fff;
      font-family: "Barlow Condensed", "Geist", sans-serif;
      font-size: 38px;
      line-height: .88;
      letter-spacing: -.035em;
      text-transform: uppercase;
    }
    .card-body p { color: rgba(255,255,255,.62); }
    .card-link { color: var(--red); letter-spacing: .06em; text-transform: uppercase; }
    .card-link:hover { color: #fff; }

    /* ABOUT */
    .split { grid-template-columns: 1.02fr .98fr; gap: 0; border: 1px solid rgba(255,255,255,.12); background: #08080a; }
    .media-stack { min-height: 690px; }
    .stack-main { inset: 0; border-right: 1px solid rgba(255,255,255,.12); box-shadow: none; }
    .stack-float { right: 30px; bottom: 30px; width: 38%; height: 42%; border: 8px solid #08080a; box-shadow: none; }
    .stat-card {
      left: 0;
      bottom: 0;
      max-width: 320px;
      padding: 28px;
      border: 1px solid rgba(255,255,255,.16);
      border-left: 8px solid var(--red);
      background: #050506;
      box-shadow: 12px 12px 0 rgba(239,17,29,.18);
    }
    .stat-card strong {
      font-family: "Barlow Condensed", "Geist", sans-serif;
      font-size: 78px;
    }
    .split-copy { padding: 56px; }
    .quote {
      margin-top: 28px;
      border-left: 8px solid var(--red);
      background: #111115;
      color: rgba(255,255,255,.72);
      box-shadow: none;
    }

    /* QUALITY */
    .quality-wrap { background: #030305; }
    .quality-wrap::before {
      background:
        linear-gradient(rgba(255,255,255,.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,0,0,.96), rgba(0,0,0,.68)),
        url('https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389697/Arima_foto_56_zajuwd.png') center/cover no-repeat;
      background-size: 42px 42px, 42px 42px, auto, cover;
    }
    .quality-card {
      min-height: 360px;
      padding: 32px;
      border: 1px solid rgba(255,255,255,.12);
      background: rgba(0,0,0,.46);
      backdrop-filter: blur(14px);
    }
    .quality-card:hover { transform: translateY(-6px); background: rgba(239,17,29,.18); }
    .quality-icon {
      width: 66px;
      height: 66px;
      background: var(--red);
      color: #fff;
    }
    .quality-card h3 {
      font-family: "Barlow Condensed", "Geist", sans-serif;
      font-size: 44px;
      text-transform: uppercase;
    }

    /* METHOD / PEST / GALLERY */
    .method-number {
      top: 0;
      left: 0;
      width: 58px;
      height: 58px;
      background: var(--red);
      box-shadow: none;
    }
    .pest-card { grid-template-rows: 330px 1fr; }
    .mosaic { gap: 0; border: 1px solid rgba(255,255,255,.12); }
    .mosaic .image-open {
      min-height: 290px;
      border: 1px solid rgba(255,255,255,.12);
      box-shadow: none;
    }
    .tall { min-height: 440px !important; }

    /* COVERAGE MAP - keep Leaflet original behavior, only square black/red shell */
    .coverage-card {
      background: #050506;
      border: 1px solid rgba(255,255,255,.12);
      box-shadow: none;
      width: min(1480px, calc(100vw - 48px));
    }
    .coverage-grid { grid-template-columns: 420px minmax(0,1fr); }
    .coverage-copy {
      background: linear-gradient(180deg, #111114, #070709);
      border-right: 1px solid rgba(255,255,255,.12);
      color: #fff;
    }
    .search-box input {
      background: #050506;
      border: 1px solid rgba(255,255,255,.16);
      color: #fff;
      box-shadow: none;
    }
    .region-chip {
      background: #111115;
      color: #fff;
      border: 1px solid rgba(255,255,255,.14);
      box-shadow: none;
    }
    .region-chip small { color: rgba(255,255,255,.52); }
    .region-chip:hover, .region-chip.active { background: var(--red); color: #fff; transform: none; box-shadow: none; }
    .map-panel { background: #050506; }
    .map-stage {
      border: 1px solid rgba(255,255,255,.18);
      background: #e8edf1;
      box-shadow: none;
      overflow: hidden;
    }
    .map-title, .map-reset, .map-legend { border-radius: 0 !important; }
    .map-title { background: rgba(0,0,0,.78); border-left: 6px solid var(--red); }
    .map-reset { background: var(--red); border-color: var(--red); }
    .map-note {
      background: #111115;
      border: 1px solid rgba(255,255,255,.14);
    }
    #coverageMap .leaflet-control-attribution { border-radius: 0 !important; }

    /* CONTACT / FOOTER */
    .contact-wrap { background: #070709; }
    .contact-card {
      grid-template-columns: .9fr 1.1fr;
      background: #050506;
      border: 1px solid rgba(255,255,255,.12);
      box-shadow: none;
    }
    .contact-copy { border-right: 1px solid rgba(255,255,255,.12); }
    .contact-list a {
      min-height: 94px;
      background: linear-gradient(180deg, #15151a, #101014);
      border: 1px solid rgba(255,255,255,.14);
      box-shadow: inset 4px 0 0 rgba(239,17,29,.74);
    }
    .contact-list a:hover {
      background: linear-gradient(180deg, rgba(239,17,29,.22), rgba(16,16,20,1));
      border-color: rgba(239,17,29,.62);
      transform: translateX(4px);
    }
    .contact-list i {
      background: var(--red);
      box-shadow: 0 0 24px rgba(239,17,29,.32);
    }
    .contact-action {
      background: rgba(255,255,255,.04);
      border-color: rgba(255,255,255,.14);
    }
    .contact-list a:hover .contact-action {
      background: var(--red);
      border-color: var(--red);
      color: #fff;
    }
    .contact-form {
      background: #050506;
      color: #fff;
      border: 1px solid rgba(255,255,255,.16);
      box-shadow: 12px 12px 0 rgba(0,0,0,.52);
    }
    .field label { color: rgba(255,255,255,.62); }
    .field input, .field textarea {
      background: #111115;
      color: #fff;
      border: 1px solid rgba(255,255,255,.14);
    }
    footer { margin-top: 0; background: #000; border-top: 1px solid rgba(255,255,255,.12); }
    footer img { border: 0; }



    /* WHATSAPP CTA - HIJAU, ICON, DAN GLOW ELEGAN LEBIH TERLIHAT */
    .btn-whatsapp {
      position: relative;
      overflow: visible;
      isolation: isolate;
      background: #25D366 !important;
      border-color: #25D366 !important;
      color: #fff !important;
      box-shadow:
        0 0 18px rgba(37, 211, 102, .58),
        0 0 0 0 rgba(37, 211, 102, .30),
        inset 0 1px 0 rgba(255,255,255,.28);
      animation: waElegantPulse 1.55s ease-in-out infinite;
    }
    .btn-whatsapp::before {
      content: "";
      position: absolute;
      inset: -9px;
      z-index: -2;
      border: 1px solid rgba(37, 211, 102, .55);
      background: rgba(37, 211, 102, .17);
      filter: blur(7px);
      opacity: .8;
      pointer-events: none;
      animation: waElegantHalo 1.55s ease-in-out infinite;
    }
    .btn-whatsapp:hover {
      background: #1ebe5d !important;
      border-color: #1ebe5d !important;
      box-shadow:
        8px 8px 0 rgba(37, 211, 102, .26),
        0 0 28px rgba(37, 211, 102, .70),
        0 0 58px rgba(37, 211, 102, .38);
    }
    .btn-whatsapp::after {
      content: "";
      position: absolute;
      inset: -8px auto -8px -70%;
      z-index: 0;
      width: 44%;
      transform: skewX(-24deg);
      background: linear-gradient(90deg, transparent, rgba(255,255,255,.78), transparent);
      filter: blur(.2px);
      opacity: .82;
      pointer-events: none;
      animation: waShine 2.4s ease-in-out infinite;
    }
    .btn-whatsapp > * { position: relative; z-index: 2; }
    .btn-video-pulse {
      position: relative;
      overflow: visible;
      isolation: isolate;
      background: var(--red) !important;
      border-color: var(--red) !important;
      color: #fff !important;
      box-shadow:
        0 0 18px rgba(229, 9, 20, .58),
        0 0 0 0 rgba(229, 9, 20, .30),
        inset 0 1px 0 rgba(255,255,255,.28);
      animation: videoRedPulse 1.55s ease-in-out infinite;
    }
    .btn-video-pulse::before {
      content: "";
      position: absolute;
      inset: -9px;
      z-index: -2;
      border: 1px solid rgba(229, 9, 20, .55);
      background: rgba(229, 9, 20, .17);
      filter: blur(7px);
      opacity: .8;
      pointer-events: none;
      animation: videoRedHalo 1.55s ease-in-out infinite;
    }
    .btn-video-pulse:hover {
      background: var(--red-2) !important;
      border-color: var(--red-2) !important;
      box-shadow:
        8px 8px 0 rgba(229, 9, 20, .26),
        0 0 28px rgba(229, 9, 20, .70),
        0 0 58px rgba(229, 9, 20, .38);
    }
    .btn-video-pulse::after {
      content: "";
      position: absolute;
      inset: -8px auto -8px -70%;
      z-index: 0;
      width: 44%;
      transform: skewX(-24deg);
      background: linear-gradient(90deg, transparent, rgba(255,255,255,.78), transparent);
      filter: blur(.2px);
      opacity: .82;
      pointer-events: none;
      animation: waShine 2.4s ease-in-out infinite;
    }
    .btn-video-pulse > * { position: relative; z-index: 2; }
    .wa-icon {
      width: 20px;
      height: 20px;
      flex: 0 0 20px;
      fill: currentColor;
      filter: drop-shadow(0 2px 7px rgba(0,0,0,.28));
    }
    .floating-wa {
      position: fixed;
      right: 22px;
      bottom: 22px;
      z-index: 1400;
      width: 64px;
      height: 64px;
      display: grid;
      place-items: center;
      border: 1px solid rgba(255,255,255,.18);
      background: #25D366;
      color: #fff;
      box-shadow:
        0 18px 44px rgba(0,0,0,.34),
        0 0 28px rgba(37,211,102,.55);
      animation: waElegantPulse 1.55s ease-in-out infinite;
    }
    .floating-wa::before {
      content: "";
      position: absolute;
      inset: -8px;
      z-index: -1;
      border: 1px solid rgba(37,211,102,.48);
      background: rgba(37,211,102,.14);
      filter: blur(8px);
      animation: waElegantHalo 1.55s ease-in-out infinite;
    }
    .floating-wa:hover {
      background: #1ebe5d;
      color: #fff;
      transform: translateY(-3px);
      box-shadow:
        0 22px 54px rgba(0,0,0,.40),
        0 0 42px rgba(37,211,102,.68);
    }
    .floating-wa svg {
      width: 31px;
      height: 31px;
      fill: currentColor;
    }
    .btn-arrow { margin-left: -2px; opacity: .9; }
    @keyframes waElegantPulse {
      0%, 100% {
        box-shadow:
          0 0 14px rgba(37, 211, 102, .48),
          0 0 0 0 rgba(37, 211, 102, .28),
          inset 0 1px 0 rgba(255,255,255,.22);
        filter: brightness(1);
      }
      48% {
        box-shadow:
          0 0 30px rgba(37, 211, 102, .86),
          0 0 0 8px rgba(37, 211, 102, .12),
          0 0 64px rgba(37, 211, 102, .38),
          inset 0 1px 0 rgba(255,255,255,.34);
        filter: brightness(1.12);
      }
    }
    @keyframes waElegantHalo {
      0%, 100% { opacity: .36; transform: scale(.96); }
      48% { opacity: .92; transform: scale(1.06); }
    }
    @keyframes videoRedPulse {
      0%, 100% {
        box-shadow:
          0 0 14px rgba(229, 9, 20, .48),
          0 0 0 0 rgba(229, 9, 20, .28),
          inset 0 1px 0 rgba(255,255,255,.22);
        filter: brightness(1);
      }
      48% {
        box-shadow:
          0 0 30px rgba(229, 9, 20, .86),
          0 0 0 8px rgba(229, 9, 20, .12),
          0 0 64px rgba(229, 9, 20, .38),
          inset 0 1px 0 rgba(255,255,255,.34);
        filter: brightness(1.12);
      }
    }
    @keyframes videoRedHalo {
      0%, 100% { opacity: .36; transform: scale(.96); }
      48% { opacity: .92; transform: scale(1.06); }
    }
    @keyframes waShine {
      0%, 42% { left: -70%; opacity: 0; }
      52% { opacity: .9; }
      72%, 100% { left: 130%; opacity: 0; }
    }
    .map-popup a.map-whatsapp-link { background: #25D366; }
    .map-popup a.map-whatsapp-link:hover { background: #1ebe5d; }

    /* CLIENT SECTION - LOGO STRIP BERGERAK MENYAMPING */
    .client-section {
      overflow: hidden;
      background:
        radial-gradient(circle at 16% 8%, rgba(37,211,102,.12), transparent 28%),
        radial-gradient(circle at 82% 22%, rgba(239,17,29,.18), transparent 30%),
        #070709;
    }
    .client-section .section-head { margin-bottom: 34px; }
    .client-marquee {
      width: 100%;
      overflow: hidden;
      border-top: 1px solid rgba(255,255,255,.12);
      border-bottom: 1px solid rgba(255,255,255,.12);
      background: rgba(0,0,0,.22);
      -webkit-mask-image: linear-gradient(90deg, transparent 0, #000 8%, #000 92%, transparent 100%);
      mask-image: linear-gradient(90deg, transparent 0, #000 8%, #000 92%, transparent 100%);
    }
    .client-marquee + .client-marquee { margin-top: -1px; }
    .client-marquee-track {
      display: flex;
      width: max-content;
      animation: clientSideMove 34s linear infinite;
      will-change: transform;
    }
    .client-marquee.reverse .client-marquee-track {
      animation-direction: reverse;
      animation-duration: 42s;
    }
    .client-marquee:hover .client-marquee-track { animation-play-state: paused; }
    .client-logo-set { display: flex; flex: 0 0 auto; }
    .client-logo-card {
      width: 230px;
      min-height: 122px;
      flex: 0 0 auto;
      display: grid;
      align-content: center;
      gap: 8px;
      padding: 22px 24px;
      border-right: 1px solid rgba(0,0,0,.09);
      background: linear-gradient(180deg, #ffffff, #f1f3f5);
      color: #101014;
      text-align: center;
      box-shadow: inset 0 -4px 0 rgba(239,17,29,.08);
    }
    .client-logo-card strong {
      display: block;
      font-family: "Barlow Condensed", "Geist", sans-serif;
      font-size: 34px;
      line-height: .86;
      letter-spacing: -.035em;
      text-transform: uppercase;
      color: #111827;
    }
    .client-logo-card small {
      display: block;
      color: #6b7280;
      font-size: 10px;
      font-weight: 950;
      letter-spacing: .14em;
      text-transform: uppercase;
    }
    .client-logo-card:nth-child(6n+1) strong { color: #1856a7; }
    .client-logo-card:nth-child(6n+2) strong { color: #4b5563; }
    .client-logo-card:nth-child(6n+3) strong { color: #4f9a45; }
    .client-logo-card:nth-child(6n+4) strong { color: #d4a700; }
    .client-logo-card:nth-child(6n+5) strong { color: #0d4abf; }
    .client-logo-card:nth-child(6n+6) strong { color: #b91c1c; }
    @keyframes clientSideMove {
      from { transform: translate3d(0,0,0); }
      to { transform: translate3d(-50%,0,0); }
    }
    @media (prefers-reduced-motion: reduce) {
      .btn-whatsapp,
      .btn-whatsapp::after,
      .floating-wa,
      .floating-wa::before,
      .btn-video-pulse,
      .btn-video-pulse::after,
      .client-marquee-track { animation: none !important; }
    }


    @media (max-width: 640px) {
      .client-logo-card { width: 178px; min-height: 98px; padding: 18px 16px; }
      .client-logo-card strong { font-size: 27px; }
      .client-logo-card small { font-size: 9px; }
    }

    /* LIGHTBOX */
    .lightbox { background: rgba(0,0,0,.94); }
    .lightbox img, .lightbox video { border: 1px solid rgba(255,255,255,.18); }
    .lightbox-close { background: var(--red); border: 0; }

    @media (max-width: 1120px) {
      .navrow {
        grid-template-columns: minmax(0, 1fr) 54px;
        justify-items: stretch;
      }
      .brand { justify-self: start; }
      .menu-toggle { justify-self: end; }
      .main-nav {
        position: fixed;
        z-index: 1300;
        top: 128px;
        left: 18px;
        right: 18px;
        height: auto;
        max-height: calc(100vh - 148px);
        overflow-y: auto;
        flex-direction: column;
        align-items: stretch;
        gap: 0;
        padding: 10px;
        background: rgba(3,3,5,.98);
        border: 1px solid rgba(255,255,255,.14);
        border-radius: 18px;
        box-shadow: 0 26px 76px rgba(0,0,0,.46);
      }
      .main-nav.open { display: flex; }
      .nav-link,
      .drop-trigger {
        min-height: 50px;
        width: 100%;
        padding: 0 14px;
        justify-content: space-between;
        border-left: 0;
        border-bottom: 1px solid rgba(255,255,255,.10);
      }
      .nav-item { width: 100%; }
      .dropdown {
        position: static;
        display: none;
        width: 100%;
        max-height: none;
        margin: 6px 0 10px;
        opacity: 1;
        visibility: visible;
        transform: none;
        pointer-events: auto;
        box-shadow: none;
      }
      .nav-item.open .dropdown { display: block; }
      .nav-item:hover .dropdown { display: none; }
      .nav-item.open:hover .dropdown { display: block; }
      .lang-switch {
        width: 100%;
        margin-top: 8px;
        border-left: 0;
      }
      .lang-link {
        min-height: 48px;
        width: 50%;
        justify-content: center;
      }
      .hero-actions {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 10px;
      }
      .hero-actions .btn {
        width: 100%;
        min-width: 0;
        margin: 0;
        padding: 0 14px;
        line-height: 1.25;
        text-align: center;
        white-space: normal;
      }
    }
    @media (max-width: 940px) {
      .section { padding: 88px 0; }
      .iso-section .section-head { grid-template-columns: 1fr; gap: 14px; }
      .iso-section .section-head p { max-width: none; }
      .iso-grid { grid-template-columns: 1fr; padding: 8px; }
      .iso-card .iso-image-button { min-height: 260px; }
      .iso-card .iso-image-button img { max-height: 224px !important; }
      .split { display: block; }
      .split-copy { padding: 32px; }
      .coverage-grid { grid-template-columns: 1fr; }
      .coverage-copy { border-right: 0; border-bottom: 1px solid rgba(255,255,255,.12); }
      .hero h1 { font-size: clamp(72px, 18vw, 132px); }
      .hero-copy {
        width: 100%;
        max-width: 100%;
        min-width: 0;
      }
      .hero-actions {
        width: 100%;
        max-width: 100%;
        min-width: 0;
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
      .hero-actions .btn-ghost {
        grid-column: 1 / -1;
      }
    }
    @media (max-width: 640px) {
      .container {
        width: calc(100% - 28px);
        max-width: var(--container);
      }
      .hero-content {
        width: auto;
        max-width: none;
        min-width: 0;
        margin-left: 14px;
        margin-right: 14px;
      }
      .topbar { display: none; }
      .navrow {
        min-height: 74px;
        grid-template-columns: minmax(0, 1fr) 54px;
      }
      .main-nav {
        top: 84px;
        max-height: calc(100vh - 104px);
      }
      .brand { height: 74px; }
      .brand img { width: 138px; }
      .hero-content { padding-top: 118px; }
      .iso-section { padding: 44px 0; }
      .iso-card .iso-image-button { min-height: 232px; padding: 14px; }
      .iso-card .iso-image-button img { max-height: 198px !important; }
      .hero-copy { padding: 24px 20px; border-left-width: 5px; }
      .hero h1 { font-size: 72px; }
      .hero-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
        margin-top: 24px;
      }
      .hero-actions .btn {
        min-height: 54px;
        margin: 0;
        padding: 0 14px;
      }
      .hero-actions .btn-whatsapp::before,
      .hero-actions .btn-video-pulse::before {
        inset: -5px;
        filter: blur(5px);
      }
      .hero-bottom { grid-template-columns: 1fr; }
      .hero-tile { border-right: 0; border-bottom: 1px solid rgba(255,255,255,.13); }
      .coverage-card { width: min(100% - 28px, var(--container)); }
    }

    @media (max-width: 760px) {
      .section {
        padding: 58px 0;
      }

      .section-head,
      .iso-section .section-head,
      .split,
      .coverage-grid,
      .contact-card {
        display: grid;
        grid-template-columns: 1fr !important;
        gap: 18px;
      }

      .section-head {
        align-items: start;
        margin-bottom: 26px;
      }

      .section-head h2,
      .split-copy h2,
      .coverage-copy h2,
      .contact-copy h2 {
        font-size: clamp(38px, 13vw, 58px);
        line-height: .9;
        overflow-wrap: anywhere;
      }

      .service-grid,
      .method-grid,
      .news-grid,
      .quality-grid,
      .pest-grid,
      .hero-bottom {
        grid-template-columns: 1fr !important;
      }

      .service-card,
      .method-card,
      .news-card,
      .pest-card {
        min-height: auto;
        grid-template-rows: minmax(210px, auto) auto;
      }

      .service-card h3,
      .method-card h3,
      .news-card h3,
      .pest-card h3 {
        font-size: clamp(32px, 10vw, 44px);
        line-height: .92;
        overflow-wrap: anywhere;
      }

      .card-link,
      .service-card a,
      .method-card a,
      .news-card a,
      .pest-card a {
        max-width: 100%;
        white-space: normal;
        overflow-wrap: anywhere;
        line-height: 1.35;
      }

      .coverage-card,
      .contact-card {
        width: calc(100% - 28px);
        max-width: var(--container);
        margin-inline: auto;
      }

      .coverage-copy,
      .contact-copy {
        min-width: 0;
        padding: 26px 22px;
        border-right: 0;
      }

      .coverage-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 10px;
      }

      .coverage-actions .btn,
      .contact-form .btn {
        width: 100%;
      }

      .region-list {
        grid-template-columns: 1fr;
        max-height: 300px;
        padding-right: 0;
      }

      .map-panel {
        min-height: auto;
        padding: 12px;
      }

      .map-stage {
        height: 420px;
        min-height: 420px;
        border-radius: 14px;
      }

      #coverageMap {
        min-height: 420px !important;
      }

      .map-title {
        top: 10px;
        left: 10px;
        max-width: calc(100% - 116px);
        padding: 10px 11px;
      }

      .map-title span {
        display: none;
      }

      .map-reset {
        top: 10px;
        right: 10px;
        min-height: 38px;
        padding: 0 11px;
      }

      .map-legend {
        left: 10px;
        right: 10px;
        bottom: 10px;
        max-width: none;
        border-radius: 12px;
      }

      .contact-card {
        overflow: hidden;
      }

      .contact-list {
        gap: 12px;
      }

      .contact-list a {
        width: 100%;
        min-width: 0;
        grid-template-columns: 52px minmax(0, 1fr);
        gap: 12px;
        align-items: center;
        padding: 14px;
      }

      .contact-list a > span {
        min-width: 0;
      }

      .contact-list b,
      .contact-list span span {
        overflow-wrap: anywhere;
      }

      .contact-action {
        grid-column: 2;
        justify-self: start;
        margin-top: 4px;
      }

      .contact-side {
        min-height: auto;
        padding: 22px;
      }

      .contact-form {
        width: 100%;
        margin: 0;
      }

      .footer-row {
        flex-direction: column;
        justify-content: center;
        text-align: center;
        padding: 30px 0;
      }

      .footer-links {
        justify-content: center;
      }
    }

    @media (min-width: 761px) and (max-width: 900px) {
      .contact-card {
        width: calc(100% - 48px);
        max-width: var(--container);
        display: grid;
        grid-template-columns: 1fr !important;
        margin-inline: auto;
        overflow: hidden;
      }

      .contact-copy {
        border-right: 0;
      }

      .contact-side {
        min-height: auto;
        padding: 28px;
      }

      .contact-form {
        width: 100%;
        margin: 0;
      }
    }
  </style>

</head>
<body>
  @if($info?->google_ads_body_script)
  {!! $info->google_ads_body_script !!}
  @endif
  @if(!empty($homeContent?->analytics_body))
  {!! $homeContent->analytics_body !!}
  @endif
  <header class="site-header">
    <div class="topbar">
      <div class="container">
        <a href="tel:{{ preg_replace('/\D+/', '', $phonePrimary) }}">Phone {{ $phonePrimary }}</a>
        <a href="mailto:{{ $emailAddress }}">Email {{ $emailAddress }}</a>
        <a href="https://www.instagram.com/arimapestclean" target="_blank" rel="noopener">@arimapestclean</a>
      </div>
    </div>

    <div class="container navrow">
      <a class="brand" href="#home" aria-label="ARIMA Indonesia Home">
        <img src="{{ $frontendLogo }}" alt="Logo ARIMA Indonesia" />
      </a>

      <nav class="main-nav" id="mainNav" aria-label="Main navigation">
        <a class="nav-link active" href="#home">Home</a>

        <div class="nav-item">
          <button class="drop-trigger" type="button" aria-expanded="false">Service Solution <span>⌄</span></button>
          <div class="dropdown">
            <a href="{{ url('/commercial'.$servicePrefix) }}" target="_blank" rel="noopener">Commercial Protection</a>
            <a href="{{ url('/residential'.$servicePrefix) }}" target="_blank" rel="noopener">Residential Protection</a>
            <a href="{{ url('/industrial'.$servicePrefix) }}" target="_blank" rel="noopener">Industrial Protection</a>
            <a href="{{ url('/disinfection'.$servicePrefix) }}" target="_blank" rel="noopener">Disinfection Protection</a>
            <a href="{{ url('/cleaning'.$servicePrefix) }}" target="_blank" rel="noopener">Cleaning Service</a>
          </div>
        </div>

        <div class="nav-item">
          <button class="drop-trigger" type="button" aria-expanded="false">Method <span>⌄</span></button>
          <div class="dropdown">
            <a href="{{ url('/generalpest'.$servicePrefix) }}" target="_blank" rel="noopener">General Pest</a>
            <a href="{{ url('/termitebaiting'.$servicePrefix) }}" target="_blank" rel="noopener">Termite Baiting</a>
            <a href="{{ url('/fumigation'.$servicePrefix) }}" target="_blank" rel="noopener">Fumigation</a>
          </div>
        </div>

        <div class="nav-item">
          <button class="drop-trigger" type="button" aria-expanded="false">Pest <span>⌄</span></button>
          <div class="dropdown">
            <a href="{{ url('/pest'.$servicePrefix) }}" target="_blank" rel="noopener">Bugs</a>
            <a href="{{ url('/otherpest'.$servicePrefix) }}" target="_blank" rel="noopener">Other</a>
          </div>
        </div>

        <a class="nav-link" href="#contact">Contact Us</a>
        <a class="nav-link" href="#news">News</a>
        <div class="lang-switch" aria-label="Multi language">
          <a class="lang-link {{ empty($isEnglish) ? 'active' : '' }}" href="{{ url('/') }}">ID</a>
          <a class="lang-link {{ !empty($isEnglish) ? 'active' : '' }}" href="{{ url('/eng') }}">EN</a>
        </div>
      </nav>

      <button class="menu-toggle" id="menuToggle" type="button" aria-label="Buka menu" aria-expanded="false">☰</button>
    </div>
  </header>

  <main>
    <section class="hero" id="home">
      <div class="hero-video" aria-hidden="true">
        @php
          $heroVideo = $homeContent?->hero_video ? asset($homeContent->hero_video) : ($homeContent?->hero_video_url ?: asset('assets/arima/arima-revisi-fix_bq4UvNOh.mp4'));
          $heroPoster = $homeContent?->hero_poster ? asset($homeContent->hero_poster) : ($homeContent?->hero_poster_url ?: 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_49_nkonei.png');
          $heroEyebrow = !empty($isEnglish) ? ($homeContent?->hero_eyebrow_eng ?: $homeContent?->hero_eyebrow ?: 'Green Pest Control Since 1998') : ($homeContent?->hero_eyebrow ?: 'Green Pest Control Since 1998');
          $heroTitle = !empty($isEnglish) ? ($homeContent?->hero_title_eng ?: $homeContent?->hero_title ?: 'ARIMA Indonesia') : ($homeContent?->hero_title ?: 'ARIMA Indonesia');
          $heroDescription = !empty($isEnglish)
            ? ($homeContent?->hero_description_eng ?: $homeContent?->hero_description ?: 'ARIMA Indonesia has provided green pest control, pest management, disinfection, fumigation, termite baiting, and cleaning services since 1998.')
            : ($homeContent?->hero_description ?: 'ARIMA Indonesia berdiri sejak tahun 1998 adalah perusahaan jasa di bidang utama pest control yaitu pengendalian hama dengan konsep green pest control. Green pest control adalah sistem pengendalian hama yang sangat ramah lingkungan dengan menggunakan seminimal mungkin pestisida dan didukung oleh dokumentasi / laporan yang di buat secara lengkap untuk dapat menunjang kegiatan pengendalian hama.');
          $heroPrimaryCta = !empty($isEnglish) ? ($homeContent?->hero_primary_cta_eng ?: $homeContent?->hero_primary_cta ?: 'Request Consultation') : ($homeContent?->hero_primary_cta ?: 'Konsultasi WhatsApp');
          $heroSecondaryCta = !empty($isEnglish) ? ($homeContent?->hero_secondary_cta_eng ?: $homeContent?->hero_secondary_cta ?: 'Service Solution') : ($homeContent?->hero_secondary_cta ?: 'Service Solution');
        @endphp
        <video autoplay muted loop playsinline preload="metadata" poster="{{ $heroPoster }}">
          <source src="{{ $heroVideo }}" type="video/mp4" />
        </video>
      </div>
      <div class="hero-content">
        <div class="hero-copy reveal">
          <span class="eyebrow">{{ $heroEyebrow }}</span>
          <h1>{{ $heroTitle }}</h1>
          <p>{{ $heroDescription }}</p>
          <div class="hero-actions">
            <a class="btn btn-red btn-whatsapp" href="{{ $info?->link_wa ?: 'https://wa.me/628113000655' }}" target="_blank" rel="noopener"><svg class="wa-icon" viewBox="0 0 32 32" aria-hidden="true" focusable="false"><path d="M16.02 3.2c-7.03 0-12.75 5.62-12.75 12.54 0 2.23.6 4.38 1.74 6.27L3.2 28.8l6.98-1.78a12.9 12.9 0 0 0 5.84 1.43c7.03 0 12.75-5.62 12.75-12.54S23.05 3.2 16.02 3.2Zm0 22.98c-1.9 0-3.75-.5-5.36-1.44l-.39-.23-4.14 1.06 1.1-4.02-.26-.41a10.27 10.27 0 0 1-1.5-5.4c0-5.66 4.74-10.27 10.55-10.27 5.8 0 10.53 4.6 10.53 10.27 0 5.66-4.72 10.44-10.53 10.44Zm5.78-7.7c-.32-.16-1.88-.92-2.17-1.02-.29-.11-.5-.16-.72.16-.21.31-.82 1.02-1.01 1.23-.18.21-.37.24-.68.08-.32-.16-1.34-.49-2.55-1.56-.94-.83-1.58-1.86-1.76-2.17-.19-.32-.02-.49.14-.65.14-.14.32-.37.48-.55.16-.19.21-.32.32-.53.1-.21.05-.4-.03-.56-.08-.16-.71-1.7-.97-2.33-.26-.61-.52-.53-.72-.54h-.61c-.21 0-.56.08-.85.4-.29.31-1.11 1.08-1.11 2.63s1.14 3.06 1.3 3.27c.16.21 2.25 3.38 5.45 4.74.76.33 1.36.52 1.82.67.76.24 1.46.2 2.01.12.61-.09 1.88-.76 2.14-1.49.27-.73.27-1.35.19-1.49-.08-.13-.29-.21-.61-.37Z"/></svg><span>{{ $heroPrimaryCta }}</span><span class="btn-arrow">↗</span></a>
            <a class="btn btn-red btn-video-pulse" href="{{ $heroVideo }}" target="_blank" rel="noopener"><span>{{ !empty($isEnglish) ? 'Open Video' : 'Buka Video' }}</span><span class="btn-arrow">↗</span></a>
            <a class="btn btn-ghost" href="#services">{{ $heroSecondaryCta }}</a>
          </div>
        </div>
        <div class="hero-bottom reveal">
          <a class="hero-tile" href="{{ url('/commercial'.$servicePrefix) }}" target="_blank" rel="noopener"><small>Service</small><strong>Commercial</strong></a>
          <a class="hero-tile" href="{{ url('/residential'.$servicePrefix) }}" target="_blank" rel="noopener"><small>Service</small><strong>Residential</strong></a>
          <a class="hero-tile" href="{{ url('/industrial'.$servicePrefix) }}" target="_blank" rel="noopener"><small>Service</small><strong>Factory</strong></a>
          <a class="hero-tile" href="{{ url('/disinfection'.$servicePrefix) }}" target="_blank" rel="noopener"><small>Service</small><strong>Disinfection</strong></a>
        </div>
      </div>
    </section>

    <div class="marquee" aria-hidden="true">
      <div class="marquee-track">
        <span>Green Pest Control • Pest Management • Fumigation • Termite Baiting • Cleaning Service • Disinfection Protection •</span>
        <span>Green Pest Control • Pest Management • Fumigation • Termite Baiting • Cleaning Service • Disinfection Protection •</span>
      </div>
    </div>

    @if(($homeContent?->iso_is_active ?? true) && isset($homeIsos) && $homeIsos->isNotEmpty())
      <section class="section iso-section" id="iso">
        <div class="container">
          <div class="section-head reveal">
            <div>
              <span class="kicker">{{ !empty($isEnglish) ? ($homeContent?->iso_kicker_eng ?: $homeContent?->iso_kicker ?: 'Certification') : ($homeContent?->iso_kicker ?: 'Sertifikasi') }}</span>
              <h2>{{ !empty($isEnglish) ? ($homeContent?->iso_title_eng ?: $homeContent?->iso_title ?: 'Quality Standard & ISO Certification') : ($homeContent?->iso_title ?: 'Standar Mutu & Sertifikasi ISO') }}</h2>
            </div>
            <p>{{ !empty($isEnglish) ? ($homeContent?->iso_description_eng ?: $homeContent?->iso_description ?: 'ARIMA Indonesia is committed to documented quality, safety, and professional service standards.') : ($homeContent?->iso_description ?: 'Komitmen ARIMA Indonesia terhadap standar mutu, keselamatan, dan layanan profesional yang terdokumentasi.') }}</p>
          </div>

          <div class="iso-grid">
            @foreach($homeIsos as $iso)
              @php
                $isoImage = $iso->image && str_starts_with($iso->image, 'http') ? $iso->image : ($iso->image ? asset($iso->image) : null);
                $isoTitle = !empty($isEnglish) ? ($iso->title_eng ?: $iso->title ?: 'ISO Certificate') : ($iso->title ?: 'Sertifikat ISO');
              @endphp
              @if($isoImage)
                <article class="iso-card reveal">
                  <button class="iso-image-button js-lightbox" type="button" data-src="{{ $isoImage }}" data-alt="{{ $isoTitle }}">
                    <img loading="lazy" src="{{ $isoImage }}" alt="{{ $isoTitle }}">
                  </button>
                  <div class="iso-card-caption"><span>{{ $isoTitle }}</span></div>
                </article>
              @endif
            @endforeach
          </div>
        </div>
      </section>
    @endif

    <section class="section client-section" id="clients">
      <div class="container">
        <div class="section-head reveal">
          <div>
            <span class="kicker">{{ !empty($isEnglish) ? ($homeContent?->client_kicker_eng ?: $homeContent?->client_kicker ?: 'Clients & Partners') : ($homeContent?->client_kicker ?: 'Client & Partner') }}</span>
            <h2>{{ !empty($isEnglish) ? ($homeContent?->client_title_eng ?: $homeContent?->client_title ?: 'Our Clients and Partners') : ($homeContent?->client_title ?: 'Klien dan Mitra Kami') }}</h2>
          </div>
          <p>{{ !empty($isEnglish) ? ($homeContent?->client_description_eng ?: $homeContent?->client_description ?: 'Trusted by institutions, businesses, and operational facilities across sectors.') : ($homeContent?->client_description ?: 'Logo klien dibuat bergerak menyamping dengan animasi halus, tetap modern, dan berhenti saat kursor diarahkan ke area logo.') }}</p>
        </div>
      </div>
      <div class="client-marquee reveal" aria-label="Daftar klien dan mitra ARIMA Indonesia bergerak ke samping">
        <div class="client-marquee-track">
          <div class="client-logo-set">
            @foreach($primaryClients as $client)
              <div class="client-logo-card">
                @if(!empty($client->logo))
                  <img src="{{ asset($client->logo) }}" alt="{{ $client->name }}" style="max-height:42px;margin:0 auto 8px;object-fit:contain;">
                @endif
                <strong>{{ $client->name }}</strong>
                <small>{{ !empty($isEnglish) ? ($client->subtitle_eng ?: $client->subtitle) : $client->subtitle }}</small>
              </div>
            @endforeach
          </div>
          <div class="client-logo-set" aria-hidden="true">
            @foreach($primaryClients as $client)
              <div class="client-logo-card">
                @if(!empty($client->logo))
                  <img src="{{ asset($client->logo) }}" alt="{{ $client->name }}" style="max-height:42px;margin:0 auto 8px;object-fit:contain;">
                @endif
                <strong>{{ $client->name }}</strong>
                <small>{{ !empty($isEnglish) ? ($client->subtitle_eng ?: $client->subtitle) : $client->subtitle }}</small>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="client-marquee reverse reveal" aria-hidden="true">
        <div class="client-marquee-track">
          <div class="client-logo-set">
            @foreach($secondaryClients as $client)
              <div class="client-logo-card">
                @if(!empty($client->logo))
                  <img src="{{ asset($client->logo) }}" alt="{{ $client->name }}" style="max-height:42px;margin:0 auto 8px;object-fit:contain;">
                @endif
                <strong>{{ $client->name }}</strong>
                <small>{{ !empty($isEnglish) ? ($client->subtitle_eng ?: $client->subtitle) : $client->subtitle }}</small>
              </div>
            @endforeach
          </div>
          <div class="client-logo-set">
            @foreach($secondaryClients as $client)
              <div class="client-logo-card">
                @if(!empty($client->logo))
                  <img src="{{ asset($client->logo) }}" alt="{{ $client->name }}" style="max-height:42px;margin:0 auto 8px;object-fit:contain;">
                @endif
                <strong>{{ $client->name }}</strong>
                <small>{{ !empty($isEnglish) ? ($client->subtitle_eng ?: $client->subtitle) : $client->subtitle }}</small>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>

    <section class="section" id="services">
      <div class="container">
        <div class="section-head reveal">
          <div>
            <span class="kicker">Service Solution</span>
            <h2>I Need Service For :</h2>
          </div>
          <p>Commercial Protection, Residential Protection, Industrial Protection, Disinfection Protection, Cleaning Service.</p>
        </div>

        <div class="service-grid">
          <article class="service-card reveal">
            <button class="image-open js-lightbox" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_52_czfaeb.png" data-alt="Commercial Protection"><img src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_52_czfaeb.png" alt="Commercial Protection" /></button>
            <div class="card-body"><span class="badge">Service Solution</span><h3>Commercial Protection</h3><p>COMMERCIAL</p><a class="card-link" href="{{ url('/commercial'.$servicePrefix) }}" target="_blank" rel="noopener">{{ $isEnglishHome ? 'Open Commercial Protection page' : 'Buka halaman Commercial Protection' }} ↗</a></div>
          </article>
          <article class="service-card reveal">
            <button class="image-open js-lightbox" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_54_hhmqez.png" data-alt="Residential Protection"><img src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_54_hhmqez.png" alt="Residential Protection" /></button>
            <div class="card-body"><span class="badge">Service Solution</span><h3>Residential Protection</h3><p>RESIDENTIAL</p><a class="card-link" href="{{ url('/residential'.$servicePrefix) }}" target="_blank" rel="noopener">{{ $isEnglishHome ? 'Open Residential Protection page' : 'Buka halaman Residential Protection' }} ↗</a></div>
          </article>
          <article class="service-card reveal">
            <button class="image-open js-lightbox" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389692/Arima_foto_51_n2ypvi.png" data-alt="Industrial Protection"><img src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389692/Arima_foto_51_n2ypvi.png" alt="Industrial Protection" /></button>
            <div class="card-body"><span class="badge">Service Solution</span><h3>Industrial Protection</h3><p>FACTORY</p><a class="card-link" href="{{ url('/industrial'.$servicePrefix) }}" target="_blank" rel="noopener">{{ $isEnglishHome ? 'Open Industrial Protection page' : 'Buka halaman Industrial Protection' }} ↗</a></div>
          </article>
          <article class="service-card reveal">
            <button class="image-open js-lightbox" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389692/Arima_foto_55_tiujg5.png" data-alt="Disinfection Protection"><img src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389692/Arima_foto_55_tiujg5.png" alt="Disinfection Protection" /></button>
            <div class="card-body"><span class="badge">Service Solution</span><h3>Disinfection Protection</h3><p>DISINFECTION</p><a class="card-link" href="{{ url('/disinfection'.$servicePrefix) }}" target="_blank" rel="noopener">{{ $isEnglishHome ? 'Open Disinfection Protection page' : 'Buka halaman Disinfection Protection' }} ↗</a></div>
          </article>
          <article class="service-card reveal">
            <button class="image-open js-lightbox" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389689/Arima_foto_53_jros1p.png" data-alt="Cleaning Service"><img src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389689/Arima_foto_53_jros1p.png" alt="Cleaning Service" /></button>
            <div class="card-body"><span class="badge">Service Solution</span><h3>Cleaning Service</h3><p>Cleaning Service</p><a class="card-link" href="{{ url('/cleaning'.$servicePrefix) }}" target="_blank" rel="noopener">{{ $isEnglishHome ? 'Open Cleaning Service page' : 'Buka halaman Cleaning Service' }} ↗</a></div>
          </article>
        </div>
      </div>
    </section>

    <section class="section soft" id="about">
      <div class="container split">
        <div class="media-stack reveal">
          <button class="image-open stack-main js-lightbox" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389686/Arima_foto_50_gopelo.png" data-alt="Dokumentasi ARIMA Indonesia"><img src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389686/Arima_foto_50_gopelo.png" alt="Dokumentasi ARIMA Indonesia" /></button>
          <button class="image-open stack-float js-lightbox" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389682/Arima_foto_40_sk5raw.png" data-alt="Tim ARIMA Indonesia"><img src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389682/Arima_foto_40_sk5raw.png" alt="Tim ARIMA Indonesia" /></button>
          <div class="stat-card"><strong>1998</strong><span>ARIMA Indonesia berdiri sejak tahun 1998.</span></div>
        </div>
        <div class="split-copy reveal">
          <span class="kicker">About Us</span>
          <h2>About Us</h2>
          <p>ARIMA Indonesia berdiri sejak tahun 1998 adalah perusahaan jasa di bidang utama pest control yaitu pengendalian hama dengan konsep green pest control. Green pest control adalah sistem pengendalian hama yang sangat ramah lingkungan dengan menggunakan seminimal mungkin pestisida dan didukung oleh dokumentasi / laporan yang di buat secara lengkap untuk dapat menunjang kegiatan pengendalian hama.</p>
          <div class="quote">Tujuan kami dalam menciptakan suatu wilayah yang terbebas dari serangan hama dengan menurunkan tingkat infestasi hama. Kami berpengalaman dengan dukungan tenaga ahli yang berpengalaman. Kami berkomitmen menjadi yang terbaik demi kepuasaan pelanggan</div>
          <div class="hero-actions"><a class="btn btn-red" href="#contact">Contact Us</a><a class="btn" href="#coverage">Sebaran Wilayah</a></div>
        </div>
      </div>
    </section>

    <section class="section quality-wrap" id="quality">
      <div class="container">
        <div class="section-head reveal">
          <div><span class="kicker">Pest Management Quality</span><h2>Pest Management Quality</h2></div>
          <p>Bahan Kimia, Teknologi, Sumber Daya.</p>
        </div>
        <div class="quality-grid">
          <a class="quality-card reveal" href="{{ url('/generalpest'.$servicePrefix) }}" target="_blank" rel="noopener">
            <div><span class="quality-icon">01</span><h3>Bahan Kimia</h3><p>Kami menerapkan bahan kimia dalam jumlah yang cukup pada sasaran hama atau sumber perkembangbiakan hama. Semua bahan kimia yang kami gunakan mematuhi program HACCP dan disediakan MSDS</p></div><span class="card-link">Read more ↗</span>
          </a>
          <a class="quality-card reveal" href="{{ url('/termitebaiting'.$servicePrefix) }}" target="_blank" rel="noopener">
            <div><span class="quality-icon">02</span><h3>Teknologi</h3><p>Kami menggunakan teknologi terbaru yang ramah lingkungan untuk mencapai hasil yang maksimal</p></div><span class="card-link">Read more ↗</span>
          </a>
          <a class="quality-card reveal" href="{{ url('/fumigation'.$servicePrefix) }}" target="_blank" rel="noopener">
            <div><span class="quality-icon">03</span><h3>Sumber Daya</h3><p>Kami berpengalaman lebih dari 20 tahun dalam bidang pest baik untuk komersial, industri yang berada di Indonesia. Teknisi kami memberikan servis terbaik mulai dari persiapan hingga eksekusi.</p></div><span class="card-link">Read more ↗</span>
          </a>
        </div>
      </div>
    </section>

    <section class="section" id="method">
      <div class="container">
        <div class="section-head reveal">
          <div><span class="kicker">Method</span><h2>Method</h2></div>
          <p>General Pest, Termite Baiting, Fumigation.</p>
        </div>
        <div class="method-grid">
          <article class="method-card reveal"><span class="method-number">01</span><button class="image-open js-lightbox" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389680/Arima_foto_38_r1d4dr.png" data-alt="General Pest"><img src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389680/Arima_foto_38_r1d4dr.png" alt="General Pest" /></button><div class="card-body"><span class="badge">Method</span><h3>General Pest</h3><p>General Pest</p><a class="card-link" href="{{ url('/generalpest'.$servicePrefix) }}" target="_blank" rel="noopener">{{ $isEnglishHome ? 'Open General Pest page' : 'Buka halaman General Pest' }} ↗</a></div></article>
          <article class="method-card reveal"><span class="method-number">02</span><button class="image-open js-lightbox" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389664/Arima_foto_25_p67nun.png" data-alt="Termite Baiting"><img src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389664/Arima_foto_25_p67nun.png" alt="Termite Baiting" /></button><div class="card-body"><span class="badge">Method</span><h3>Termite Baiting</h3><p>Termite Baiting</p><a class="card-link" href="{{ url('/termitebaiting'.$servicePrefix) }}" target="_blank" rel="noopener">{{ $isEnglishHome ? 'Open Termite Baiting page' : 'Buka halaman Termite Baiting' }} ↗</a></div></article>
          <article class="method-card reveal"><span class="method-number">03</span><button class="image-open js-lightbox" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389656/Arima_foto_10_unvkoc.png" data-alt="Fumigation"><img src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389656/Arima_foto_10_unvkoc.png" alt="Fumigation" /></button><div class="card-body"><span class="badge">Method</span><h3>Fumigation</h3><p>Fumigation</p><a class="card-link" href="{{ url('/fumigation'.$servicePrefix) }}" target="_blank" rel="noopener">{{ $isEnglishHome ? 'Open Fumigation page' : 'Buka halaman Fumigation' }} ↗</a></div></article>
        </div>
      </div>
    </section>

    <section class="section soft" id="pest">
      <div class="container">
        <div class="section-head reveal">
          <div><span class="kicker">Pest</span><h2>Pest</h2></div>
          <p>Bugs, Other.</p>
        </div>
        <div class="pest-grid">
          <article class="pest-card reveal"><button class="image-open js-lightbox" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389651/Arima_foto_2_rw8cre.png" data-alt="Bugs"><img src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389651/Arima_foto_2_rw8cre.png" alt="Bugs" /></button><div class="card-body"><span class="badge">Pest</span><h3>Bugs</h3><p>Bugs</p><a class="card-link" href="{{ url('/pest'.$servicePrefix) }}" target="_blank" rel="noopener">{{ $isEnglishHome ? 'Open Bugs page' : 'Buka halaman Bugs' }} ↗</a></div></article>
          <article class="pest-card reveal"><button class="image-open js-lightbox" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389650/Arima_foto_7_dviquh.png" data-alt="Other"><img src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389650/Arima_foto_7_dviquh.png" alt="Other" /></button><div class="card-body"><span class="badge">Pest</span><h3>Other</h3><p>Other</p><a class="card-link" href="{{ url('/otherpest'.$servicePrefix) }}" target="_blank" rel="noopener">{{ $isEnglishHome ? 'Open Other Pest page' : 'Buka halaman Other Pest' }} ↗</a></div></article>
        </div>
      </div>
    </section>

    <section class="section" id="gallery">
      <div class="container">
        <div class="section-head reveal">
          <div><span class="kicker">Content Images</span><h2>Gallery</h2></div>
          <p>Klik gambar untuk membuka popup.</p>
        </div>
        <div class="mosaic">
          <button class="image-open js-lightbox span-6 reveal" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_49_nkonei.png" data-alt="Arima foto 49"><img loading="lazy" src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_49_nkonei.png" alt="Arima foto 49" /></button>
          <button class="image-open js-lightbox span-3 reveal" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389697/Arima_foto_56_zajuwd.png" data-alt="Arima foto 56"><img loading="lazy" src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389697/Arima_foto_56_zajuwd.png" alt="Arima foto 56" /></button>
          <button class="image-open js-lightbox span-3 reveal" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_52_czfaeb.png" data-alt="Arima foto 52"><img loading="lazy" src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_52_czfaeb.png" alt="Arima foto 52" /></button>
          <button class="image-open js-lightbox span-4 tall reveal" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_54_hhmqez.png" data-alt="Arima foto 54"><img loading="lazy" src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389695/Arima_foto_54_hhmqez.png" alt="Arima foto 54" /></button>
          <button class="image-open js-lightbox span-4 reveal" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389692/Arima_foto_51_n2ypvi.png" data-alt="Arima foto 51"><img loading="lazy" src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389692/Arima_foto_51_n2ypvi.png" alt="Arima foto 51" /></button>
          <button class="image-open js-lightbox span-4 reveal" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389692/Arima_foto_55_tiujg5.png" data-alt="Arima foto 55"><img loading="lazy" src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389692/Arima_foto_55_tiujg5.png" alt="Arima foto 55" /></button>
          <button class="image-open js-lightbox span-3 reveal" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389643/Arima_foto_15_ywcxii.png" data-alt="Arima foto 15"><img loading="lazy" src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389643/Arima_foto_15_ywcxii.png" alt="Arima foto 15" /></button>
          <button class="image-open js-lightbox span-3 reveal" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389646/Arima_foto_18_d5lrxl.png" data-alt="Arima foto 18"><img loading="lazy" src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389646/Arima_foto_18_d5lrxl.png" alt="Arima foto 18" /></button>
          <button class="image-open js-lightbox span-6 reveal" data-src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389650/Arima_foto_3_npsvfn.png" data-alt="Arima foto 3"><img loading="lazy" src="https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389650/Arima_foto_3_npsvfn.png" alt="Arima foto 3" /></button>
        </div>
      </div>
    </section>

    <section class="section soft" id="coverage">
      <div class="container coverage-card reveal">
        <div class="coverage-grid">
          <div class="coverage-copy">
            <span class="kicker">Sebaran Wilayah</span>
            <h2>Sebaran Wilayah</h2>
            <p>Commercial, Residential, Factory, Disinfection.</p>
            <div class="search-box">
              <input id="regionSearch" type="search" placeholder="Search wilayah, contoh: Surabaya, Bali, Jakarta" autocomplete="off" />
              <span>⌕</span>
            </div>
            <div class="region-list" id="regionList" aria-label="Daftar wilayah layanan"></div>
            <div class="coverage-actions">
              <a class="btn btn-red btn-whatsapp" id="regionWhatsapp" href="{{ $info?->link_wa ?: 'https://wa.me/628113000655' }}" target="_blank" rel="noopener"><svg class="wa-icon" viewBox="0 0 32 32" aria-hidden="true" focusable="false"><path d="M16.02 3.2c-7.03 0-12.75 5.62-12.75 12.54 0 2.23.6 4.38 1.74 6.27L3.2 28.8l6.98-1.78a12.9 12.9 0 0 0 5.84 1.43c7.03 0 12.75-5.62 12.75-12.54S23.05 3.2 16.02 3.2Zm0 22.98c-1.9 0-3.75-.5-5.36-1.44l-.39-.23-4.14 1.06 1.1-4.02-.26-.41a10.27 10.27 0 0 1-1.5-5.4c0-5.66 4.74-10.27 10.55-10.27 5.8 0 10.53 4.6 10.53 10.27 0 5.66-4.72 10.44-10.53 10.44Zm5.78-7.7c-.32-.16-1.88-.92-2.17-1.02-.29-.11-.5-.16-.72.16-.21.31-.82 1.02-1.01 1.23-.18.21-.37.24-.68.08-.32-.16-1.34-.49-2.55-1.56-.94-.83-1.58-1.86-1.76-2.17-.19-.32-.02-.49.14-.65.14-.14.32-.37.48-.55.16-.19.21-.32.32-.53.1-.21.05-.4-.03-.56-.08-.16-.71-1.7-.97-2.33-.26-.61-.52-.53-.72-.54h-.61c-.21 0-.56.08-.85.4-.29.31-1.11 1.08-1.11 2.63s1.14 3.06 1.3 3.27c.16.21 2.25 3.38 5.45 4.74.76.33 1.36.52 1.82.67.76.24 1.46.2 2.01.12.61-.09 1.88-.76 2.14-1.49.27-.73.27-1.35.19-1.49-.08-.13-.29-.21-.61-.37Z"/></svg><span>{{ $isEnglishHome ? 'Area Consultation' : 'Konsultasi Wilayah' }}</span><span class="btn-arrow">↗</span></a>
              <a class="btn" href="https://www.google.com/maps/search/?api=1&query=ARIMA%20Indonesia%20pest%20control" target="_blank" rel="noopener">Buka Google Maps ↗</a>
            </div>
          </div>
          <div class="map-panel">
            <div class="map-stage" aria-label="Peta asli interaktif wilayah layanan ARIMA Indonesia">
              <div id="coverageMap"></div>
              <button class="map-reset" id="mapReset" type="button">Reset Peta</button>
              <div class="map-title"><strong>Peta Interaktif Wilayah Layanan</strong><span>OpenStreetMap + titik koordinat kota</span></div>
              <div class="map-legend"><i></i><span>Zoom peta untuk melihat titik kota yang berdekatan</span></div>
            </div>
            <a class="map-note" id="coverageMapOpen" href="https://www.google.com/maps/search/?api=1&query=ARIMA%20Indonesia%20pest%20control" target="_blank" rel="noopener">
              <span>Klik nama wilayah / marker untuk zoom, lalu buka di Google Maps.</span>
              <span id="selectedRegion">Semua wilayah</span>
            </a>
          </div>
        </div>
      </div>
    </section>

    <section class="section" id="news">
      <div class="container">
        @php
          $newsItems = isset($latestNews) && $latestNews->isNotEmpty()
            ? $latestNews
            : collect([
                (object) [
                  'id' => 1,
                  'title' => 'Cara Mudah Menangkap Tikus',
                  'title_eng' => 'Easy Ways to Catch Mice',
                  'description' => 'Ada beberapa cara yang dapat digunakan untuk menangkap tikus secara efektif dan mudah.',
                  'description_eng' => 'Several simple methods can help catch mice effectively.',
                  'image' => 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389680/Arima_foto_38_r1d4dr.png',
                ],
                (object) [
                  'id' => 2,
                  'title' => 'Hindari Kecoa di Rumah Anda',
                  'title_eng' => 'Avoid Cockroaches in Your Home',
                  'description' => 'Hindari Kecoa di Rumah Anda',
                  'description_eng' => 'Avoid cockroaches in your home.',
                  'image' => 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389650/Arima_foto_3_npsvfn.png',
                ],
                (object) [
                  'id' => 3,
                  'title' => 'Mengurangi Populasi Semut di Rumah',
                  'title_eng' => 'Reduce Ant Population at Home',
                  'description' => 'Mengurangi Populasi Semut di Rumah',
                  'description_eng' => 'Reduce ant population at home.',
                  'image' => 'https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389650/Arima_foto_7_dviquh.png',
                ],
              ]);
          $newsTitles = $newsItems->map(fn ($item) => $isEnglishHome ? ($item->title_eng ?: $item->title) : $item->title)->filter()->take(3)->implode(', ');
        @endphp
        <div class="section-head reveal">
          <div><span class="kicker">{{ $isEnglishHome ? 'Latest Post' : 'Berita Terbaru' }}</span><h2>{{ $isEnglishHome ? 'Latest Post' : 'Berita Terbaru' }}</h2></div>
          <p>{{ $newsTitles }}.</p>
        </div>
        <div class="news-grid">
          @foreach($newsItems as $newsItem)
            @php
              $newsTitle = $isEnglishHome ? ($newsItem->title_eng ?: $newsItem->title) : $newsItem->title;
              $newsDescription = $isEnglishHome ? ($newsItem->description_eng ?: $newsItem->description) : $newsItem->description;
              $newsImage = str_starts_with($newsItem->image ?? '', 'http') ? $newsItem->image : asset($newsItem->image ?: 'assets/img/Default_pest_control_use_white_hazmat_0.jpg');
              $newsHref = $isEnglishHome ? route('news.show_eng', $newsItem->id) : route('news.show', $newsItem->id);
            @endphp
            <article class="news-card reveal">
              <button class="image-open js-lightbox" data-src="{{ $newsImage }}" data-alt="{{ $newsTitle }}">
                <img loading="lazy" src="{{ $newsImage }}" alt="{{ $newsTitle }}" />
              </button>
              <div class="card-body">
                <span class="badge">{{ $isEnglishHome ? 'Latest Post' : 'Berita' }}</span>
                <h3>{{ $newsTitle }}</h3>
                <p>{{ \Illuminate\Support\Str::limit(strip_tags($newsDescription), 116) }}</p>
                <a class="card-link" href="{{ $newsHref }}" target="_blank" rel="noopener">{{ $isEnglishHome ? 'Read more' : 'Baca selengkapnya' }} ↗</a>
              </div>
            </article>
          @endforeach
        </div>
      </div>
    </section>

    <section class="section contact-wrap" id="contact">
      <div class="container contact-card reveal">
        <div class="contact-copy">
          <span class="kicker">Contact Us</span>
          <h2>Contact Us</h2>
          <p>Your Name. Your Email. Message to us ... Submit.</p>
          <div class="contact-list">
            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($officeAddress) }}" target="_blank" rel="noopener" aria-label="Open ARIMA location in Google Maps">
              <i aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 21s7-5.1 7-11a7 7 0 1 0-14 0c0 5.9 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg></i>
              <span><b>{{ $isEnglishHome ? 'Google Maps' : 'Google Maps' }}</b><span>{{ $officeAddress }}</span></span>
              <em class="contact-action">{{ $isEnglishHome ? 'Open' : 'Buka' }}</em>
            </a>
            <a href="tel:{{ preg_replace('/\D+/', '', $phonePrimary) }}" aria-label="Call ARIMA">
              <i aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6.1 6.1l1.3-1.3a2 2 0 0 1 2.1-.5c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2Z"/></svg></i>
              <span><b>{{ $isEnglishHome ? 'Phone' : 'Telepon' }}</b><span>{{ $phonePrimary }}<br>{{ $phoneSecondary }}<br>{{ $phoneSms }} (SMS Only)</span></span>
              <em class="contact-action">{{ $isEnglishHome ? 'Call' : 'Telepon' }}</em>
            </a>
            <a href="mailto:{{ $emailAddress }}" aria-label="Email ARIMA">
              <i aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z"/><path d="m22 7-10 6L2 7"/></svg></i>
              <span><b>Email & Website</b><span>{{ $emailAddress }}<br>{{ $websiteLink }}</span></span>
              <em class="contact-action">Email</em>
            </a>
            <a href="https://www.instagram.com/arimapestclean" target="_blank" rel="noopener" aria-label="Open ARIMA Instagram">
              <i aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><path d="M17.5 6.5h.01"/></svg></i>
              <span><b>{{ $isEnglishHome ? 'Social Media' : 'Sosial Media' }}</b><span>@arimapestclean</span></span>
              <em class="contact-action">Instagram</em>
            </a>
          </div>
        </div>
        <div class="contact-side">
          <form class="contact-form" id="contactForm">
            <h3>Message to us ...</h3>
            <div class="field"><label for="name">Your Name</label><input id="name" name="name" type="text" placeholder="Your Name" required /></div>
            <div class="field"><label for="email">Your Email</label><input id="email" name="email" type="email" placeholder="Your Email" required /></div>
            <div class="field"><label for="message">Message to us ...</label><textarea id="message" name="message" rows="4" placeholder="Message to us ..." required></textarea></div>
            <button class="btn btn-red" type="submit">Submit ↗</button>
          </form>
        </div>
      </div>

      <footer>
        <div class="container footer-row">
          <a href="#home"><img src="{{ $frontendLogo }}" alt="Logo ARIMA Indonesia" /></a>
          <div class="footer-links">
            <a href="#home">Home</a>
            <a href="#services">Service Solution</a>
            <a href="#method">Method</a>
            <a href="#pest">Pest</a>
            <a href="#contact">Contact Us</a>
            <a href="#news">News</a>
            <a href="{{ $isEnglishHome ? url('/') : url('/eng') }}" target="_blank" rel="noopener">{{ $isEnglishHome ? 'Indonesia' : 'English' }}</a>
          </div>
        </div>
      </footer>
    </section>
  </main>

  <a class="floating-wa" href="{{ $info?->link_wa ?: 'https://wa.me/628113000655' }}" target="_blank" rel="noopener" aria-label="Konsultasi WhatsApp ARIMA">
    <svg viewBox="0 0 32 32" aria-hidden="true" focusable="false"><path d="M16.02 3.2c-7.03 0-12.75 5.62-12.75 12.54 0 2.23.6 4.38 1.74 6.27L3.2 28.8l6.98-1.78a12.9 12.9 0 0 0 5.84 1.43c7.03 0 12.75-5.62 12.75-12.54S23.05 3.2 16.02 3.2Zm0 22.98c-1.9 0-3.75-.5-5.36-1.44l-.39-.23-4.14 1.06 1.1-4.02-.26-.41a10.27 10.27 0 0 1-1.5-5.4c0-5.66 4.74-10.27 10.55-10.27 5.8 0 10.53 4.6 10.53 10.27 0 5.66-4.72 10.44-10.53 10.44Zm5.78-7.7c-.32-.16-1.88-.92-2.17-1.02-.29-.11-.5-.16-.72.16-.21.31-.82 1.02-1.01 1.23-.18.21-.37.24-.68.08-.32-.16-1.34-.49-2.55-1.56-.94-.83-1.58-1.86-1.76-2.17-.19-.32-.02-.49.14-.65.14-.14.32-.37.48-.55.16-.19.21-.32.32-.53.1-.21.05-.4-.03-.56-.08-.16-.71-1.7-.97-2.33-.26-.61-.52-.53-.72-.54h-.61c-.21 0-.56.08-.85.4-.29.31-1.11 1.08-1.11 2.63s1.14 3.06 1.3 3.27c.16.21 2.25 3.38 5.45 4.74.76.33 1.36.52 1.82.67.76.24 1.46.2 2.01.12.61-.09 1.88-.76 2.14-1.49.27-.73.27-1.35.19-1.49-.08-.13-.29-.21-.61-.37Z"/></svg>
  </a>

  <div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Image popup">
    <div class="lightbox-inner">
      <button class="lightbox-close" id="lightboxClose" type="button" aria-label="Tutup popup">×</button>
      <img id="lightboxImage" src="" alt="" />
      <video id="lightboxVideo" controls playsinline></video>
      <div class="lightbox-caption" id="lightboxCaption"></div>
    </div>
  </div>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <script>
    const menuToggle = document.getElementById('menuToggle');
    const mainNav = document.getElementById('mainNav');
    const navItems = document.querySelectorAll('.nav-item');
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('main section[id]');
    const revealItems = document.querySelectorAll('.reveal');
    const contactForm = document.getElementById('contactForm');
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxVideo = document.getElementById('lightboxVideo');
    const lightboxCaption = document.getElementById('lightboxCaption');
    const lightboxClose = document.getElementById('lightboxClose');
    const regionSearch = document.getElementById('regionSearch');
    const regionList = document.getElementById('regionList');
    const coverageMapElement = document.getElementById('coverageMap');
    const mapReset = document.getElementById('mapReset');
    const selectedRegion = document.getElementById('selectedRegion');
    const regionWhatsapp = document.getElementById('regionWhatsapp');
    const coverageMapOpen = document.getElementById('coverageMapOpen');

    const regions = [
      { name: 'Jakarta', province: 'DKI Jakarta', lat: -6.2088, lng: 106.8456 },
      { name: 'Bandung', province: 'Jawa Barat', lat: -6.9175, lng: 107.6191 },
      { name: 'Semarang', province: 'Jawa Tengah', lat: -6.9667, lng: 110.4167 },
      { name: 'Yogyakarta', province: 'DI Yogyakarta', lat: -7.7956, lng: 110.3695 },
      { name: 'Solo', province: 'Jawa Tengah', lat: -7.5755, lng: 110.8243 },
      { name: 'Madiun', province: 'Jawa Timur', lat: -7.6298, lng: 111.5239 },
      { name: 'Kediri', province: 'Jawa Timur', lat: -7.8480, lng: 112.0178 },
      { name: 'Mojokerto', province: 'Jawa Timur', lat: -7.4705, lng: 112.4401 },
      { name: 'Gresik', province: 'Jawa Timur', lat: -7.1566, lng: 112.6555 },
      { name: 'Surabaya', province: 'Jawa Timur', lat: -7.2575, lng: 112.7521 },
      { name: 'Sidoarjo', province: 'Jawa Timur', lat: -7.4468, lng: 112.7183 },
      { name: 'Pasuruan', province: 'Jawa Timur', lat: -7.6453, lng: 112.9075 },
      { name: 'Malang', province: 'Jawa Timur', lat: -7.9666, lng: 112.6326 },
      { name: 'Probolinggo', province: 'Jawa Timur', lat: -7.7764, lng: 113.2037 },
      { name: 'Jember', province: 'Jawa Timur', lat: -8.1737, lng: 113.7009 },
      { name: 'Banyuwangi', province: 'Jawa Timur', lat: -8.2192, lng: 114.3691 },
      { name: 'Bali', province: 'Bali', lat: -8.6500, lng: 115.2167 }
    ];

    const whatsappBase = 'https://wa.me/{{ preg_replace('/\D+/', '', $info?->phone_wa ?: '628113000655') }}?text=';
    let coverageMap;
    let coverageBounds;
    const regionMarkers = new Map();

    function getRegionMessage(regionName) {
      return regionName
        ? `{{ $isEnglishHome ? 'Hello ARIMA Indonesia, I would like to consult about pest control service for' : 'Halo ARIMA Indonesia, saya ingin konsultasi layanan pest control untuk wilayah' }} ${regionName}.`
        : '{{ $isEnglishHome ? 'Hello ARIMA Indonesia, I would like to consult about pest control service.' : 'Halo ARIMA Indonesia, saya ingin konsultasi layanan pest control.' }}';
    }

    function setWhatsapp(regionName) {
      regionWhatsapp.href = whatsappBase + encodeURIComponent(getRegionMessage(regionName));
      selectedRegion.textContent = regionName || 'Semua wilayah';
      if (coverageMapOpen) {
        coverageMapOpen.href = 'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(regionName ? `${regionName} pest control ARIMA Indonesia` : 'ARIMA Indonesia pest control');
      }
    }

    function clearActiveRegion() {
      document.querySelectorAll('.region-chip, .arima-marker').forEach(item => item.classList.remove('active'));
    }

    function selectRegion(region, shouldZoom = true) {
      if (!region) return;
      setWhatsapp(region.name);
      clearActiveRegion();
      const matchingChip = Array.from(document.querySelectorAll('.region-chip')).find(item => item.dataset.region === region.name);
      if (matchingChip) matchingChip.classList.add('active');
      const marker = regionMarkers.get(region.name);
      if (marker) {
        const markerElement = marker.getElement();
        if (markerElement) markerElement.classList.add('active');
        if (shouldZoom && coverageMap) { forceCoverageMapResize(false); coverageMap.flyTo([region.lat, region.lng], 11.5, { duration: .85 }); }
        marker.openPopup();
      }
    }

    function resetCoverageMap() {
      setWhatsapp('');
      clearActiveRegion();
      if (regionSearch) regionSearch.value = '';
      renderRegions('');
      if (coverageMap && coverageBounds) { forceCoverageMapResize(true); }
    }

    function markerPopup(region) {
      const messageUrl = whatsappBase + encodeURIComponent(getRegionMessage(region.name));
      return `
        <div class="map-popup">
          <strong>${region.name}</strong>
          <span>${region.province}</span>
          <a class="map-whatsapp-link" href="${messageUrl}" target="_blank" rel="noopener">Konsultasi WhatsApp wilayah ↗</a>
        </div>`;
    }

    function initCoverageMap() {
      if (!coverageMapElement) return;
      if (typeof L === 'undefined') {
        coverageMapElement.innerHTML = '<div class="map-fallback">Peta interaktif membutuhkan koneksi internet untuk memuat OpenStreetMap. Search wilayah dan tombol WhatsApp tetap bisa digunakan.</div>';
        return;
      }

      coverageMap = L.map(coverageMapElement, {
        scrollWheelZoom: false,
        zoomControl: true,
        attributionControl: true,
        preferCanvas: true
      });

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        minZoom: 5,
        maxZoom: 18,
        tileSize: 256,
        updateWhenIdle: false,
        keepBuffer: 4,
        attribution: '&copy; OpenStreetMap contributors'
      }).addTo(coverageMap);

      coverageBounds = L.latLngBounds(regions.map(region => [region.lat, region.lng]));

      regions.forEach(region => {
        const marker = L.marker([region.lat, region.lng], {
          title: region.name,
          icon: L.divIcon({
            className: 'arima-marker',
            html: '<span></span>',
            iconSize: [20, 20],
            iconAnchor: [10, 10],
            popupAnchor: [0, -12]
          })
        }).addTo(coverageMap);

        marker.bindPopup(markerPopup(region));
        marker.on('click', () => selectRegion(region, false));
        marker.on('popupclose', () => marker.getElement()?.classList.remove('active'));
        regionMarkers.set(region.name, marker);
      });

      forceCoverageMapResize(true);
      [50, 250, 700, 1400, 2600].forEach(delay => setTimeout(() => forceCoverageMapResize(false), delay));

      if ('ResizeObserver' in window) {
        const mapResizeObserver = new ResizeObserver(() => forceCoverageMapResize(false));
        mapResizeObserver.observe(coverageMapElement);
      }
    }

    function forceCoverageMapResize(shouldFit = false) {
      if (!coverageMap || !coverageBounds) return;
      coverageMap.invalidateSize({ animate: false, pan: false });
      if (shouldFit) coverageMap.fitBounds(coverageBounds.pad(.22), { animate: false, padding: [28, 28] });
    }

    function renderRegions(filter = '') {
      const keyword = filter.trim().toLowerCase();
      const filtered = regions.filter(region => `${region.name} ${region.province}`.toLowerCase().includes(keyword));
      regionList.innerHTML = '';

      regionMarkers.forEach((marker, name) => {
        const region = regions.find(item => item.name === name);
        const visible = !keyword || (region && `${region.name} ${region.province}`.toLowerCase().includes(keyword));
        marker.setOpacity(visible ? 1 : .24);
        marker.getElement()?.classList.toggle('is-muted', !visible);
      });

      filtered.forEach(region => {
        const chip = document.createElement('button');
        chip.type = 'button';
        chip.className = 'region-chip';
        chip.dataset.region = region.name;
        chip.innerHTML = `${region.name}<small>${region.province}</small>`;
        chip.addEventListener('click', () => selectRegion(region));
        regionList.appendChild(chip);
      });

      if (!filtered.length) {
        const empty = document.createElement('span');
        empty.className = 'region-chip';
        empty.textContent = 'Wilayah tidak ditemukan';
        regionList.appendChild(empty);
      }
    }

    menuToggle.addEventListener('click', () => {
      const isOpen = mainNav.classList.toggle('open');
      menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      menuToggle.textContent = isOpen ? '×' : '☰';
    });

    navItems.forEach(item => {
      const trigger = item.querySelector('.drop-trigger');
      trigger.addEventListener('click', () => {
        if (window.matchMedia('(max-width: 1120px)').matches) {
          const isOpen = item.classList.toggle('open');
          trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        }
      });
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', () => {
        mainNav.classList.remove('open');
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.textContent = '☰';
      });
    });

    const activeNav = () => {
      let current = 'home';
      sections.forEach(section => {
        const top = section.offsetTop - 130;
        if (window.scrollY >= top) current = section.getAttribute('id');
      });
      navLinks.forEach(link => link.classList.toggle('active', link.getAttribute('href') === `#${current}`));
    };

    const revealObserver = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: .12 });
    revealItems.forEach(item => revealObserver.observe(item));

    document.querySelectorAll('.js-lightbox').forEach(trigger => {
      trigger.addEventListener('click', event => {
        event.preventDefault();
        event.stopPropagation();
        const src = trigger.dataset.src || trigger.getAttribute('src') || trigger.querySelector('img')?.src;
        if (!src) return;
        const type = trigger.dataset.type || (src.toLowerCase().endsWith('.mp4') ? 'video' : 'image');
        const alt = trigger.dataset.alt || trigger.querySelector('img')?.alt || 'ARIMA Indonesia';
        lightboxImage.style.display = type === 'video' ? 'none' : 'block';
        lightboxVideo.style.display = type === 'video' ? 'block' : 'none';
        if (type === 'video') {
          lightboxVideo.src = src;
          lightboxVideo.play().catch(() => {});
          lightboxImage.removeAttribute('src');
        } else {
          lightboxImage.src = src;
          lightboxImage.alt = alt;
          lightboxVideo.pause();
          lightboxVideo.removeAttribute('src');
        }
        lightboxCaption.textContent = alt;
        lightbox.classList.add('open');
        document.body.classList.add('modal-open');
      });
    });

    function closeLightbox() {
      lightbox.classList.remove('open');
      document.body.classList.remove('modal-open');
      lightboxImage.src = '';
      lightboxVideo.pause();
      lightboxVideo.removeAttribute('src');
    }
    lightboxClose.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', event => { if (event.target === lightbox) closeLightbox(); });
    document.addEventListener('keydown', event => { if (event.key === 'Escape' && lightbox.classList.contains('open')) closeLightbox(); });

    if (regionSearch) {
      initCoverageMap();
      regionSearch.addEventListener('input', event => renderRegions(event.target.value));
      regionSearch.addEventListener('keydown', event => {
        if (event.key === 'Enter') {
          event.preventDefault();
          const keyword = regionSearch.value.trim().toLowerCase();
          const match = regions.find(region => `${region.name} ${region.province}`.toLowerCase().includes(keyword));
          if (match) selectRegion(match);
        }
      });
      if (mapReset) mapReset.addEventListener('click', resetCoverageMap);
      renderRegions();
      setWhatsapp('');
    }

    window.addEventListener('load', () => forceCoverageMapResize(true));
    window.addEventListener('resize', () => forceCoverageMapResize(false));
    const coverageSection = document.getElementById('coverage');
    if (coverageSection && 'IntersectionObserver' in window) {
      const mapVisibilityObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) forceCoverageMapResize(false);
        });
      }, { threshold: .2 });
      mapVisibilityObserver.observe(coverageSection);
    }

    window.addEventListener('scroll', activeNav, { passive: true });
    activeNav();

    contactForm.addEventListener('submit', event => {
      event.preventDefault();
      const name = encodeURIComponent(document.getElementById('name').value.trim());
      const email = encodeURIComponent(document.getElementById('email').value.trim());
      const message = encodeURIComponent(document.getElementById('message').value.trim());
      const subject = encodeURIComponent('Message to ARIMA Indonesia');
      const body = `Your Name: ${name}%0D%0AYour Email: ${email}%0D%0A%0D%0AMessage to us:%0D%0A${message}`;
      window.location.href = `mailto:{{ $emailAddress }}?subject=${subject}&body=${body}`;
    });
  </script>
</body>
</html>
