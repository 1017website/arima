@php
    $info = $information ?? null;
    $siteName = $info->name ?? 'ARIMA Indonesia';
    $phone = $info->phone_1 ?? '+62 31 766 1422';
    $waNumber = preg_replace('/\D+/', '', $info->phone_wa ?? '628113000655');
    $waText = $info->order_wa ?? 'Halo ARIMA, saya ingin konsultasi layanan.';
    $waUrl = $info->link_wa ?? ('https://wa.me/'.$waNumber.'?text='.urlencode($waText));
    $email = $info->email ?? 'info@arimaindonesia.com';
    $address = $info->address ?? 'Jl. Raya Wiyung Indah No.7 Surabaya 60228';
    $logo = asset('assets/arima/logo-new.PNG');
@endphp
<!DOCTYPE html>
<html lang="@yield('lang', 'id')">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'ARIMA Indonesia - green pest control, pest management, disinfection, fumigation, termite baiting, dan cleaning service sejak 1998.')">
    <title>@yield('title', $siteName)</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@500;600;700;800;900&family=Manrope:wght@400;500;600;700;800&family=Barlow+Condensed:wght@600;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --red: #e50914;
            --red-dark: #97020a;
            --dark: #08080a;
            --dark-2: #111114;
            --ink: #17171b;
            --muted: #6d6d76;
            --paper: #fff;
            --soft: #f7f7f8;
            --line: rgba(8,8,10,.11);
            --line-light: rgba(255,255,255,.14);
            --container: 1180px;
            --shadow: 0 24px 80px rgba(8,8,10,.14);
            --shadow-red: 0 22px 70px rgba(229,9,20,.32);
            --radius-lg: 26px;
            --radius-md: 18px;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; scroll-padding-top: 96px; }
        body {
            margin: 0;
            color: var(--ink);
            background: #fff;
            font-family: "Manrope", "Geist", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            line-height: 1.65;
            overflow-x: hidden;
        }
        a { color: inherit; text-decoration: none; }
        img { display: block; max-width: 100%; }
        button, input, textarea { font: inherit; }
        .container { width: min(var(--container), calc(100% - 40px)); margin-inline: auto; }
        .site-header {
            position: fixed;
            inset: 0 0 auto;
            z-index: 1000;
            background: rgba(8,8,10,.68);
            color: #fff;
            border-bottom: 1px solid var(--line-light);
            backdrop-filter: blur(22px);
        }
        .topbar {
            background: linear-gradient(90deg, var(--red), var(--red-dark));
            font-size: 12px;
            font-weight: 800;
        }
        .topbar .container {
            min-height: 34px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
        }
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
        .brand img { width: 140px; height: auto; object-fit: contain; }
        .main-nav { display: flex; align-items: center; gap: 2px; }
        .nav-link, .drop-trigger, .lang-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            min-height: 42px;
            border: 0;
            border-radius: 999px;
            background: transparent;
            color: rgba(255,255,255,.82);
            padding: 0 13px;
            font-family: "Geist", sans-serif;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s ease;
        }
        .nav-link:hover, .nav-link.active, .nav-item:hover .drop-trigger, .lang-link:hover {
            color: #fff;
            background: rgba(255,255,255,.11);
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
            color: #fff;
            box-shadow: 0 28px 86px rgba(0,0,0,.38);
            backdrop-filter: blur(22px);
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px);
            pointer-events: none;
            transition: .2s ease;
        }
        .nav-item:hover .dropdown, .nav-item:focus-within .dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
            pointer-events: auto;
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
            font-size: 12px;
            font-weight: 900;
            cursor: pointer;
        }
        .page-hero {
            position: relative;
            min-height: 76vh;
            display: grid;
            align-items: end;
            color: #fff;
            background: var(--dark);
            isolation: isolate;
            overflow: hidden;
        }
        .page-hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: var(--hero-image, url('https://res.cloudinary.com/dcpleyqfl/image/upload/v1782389697/Arima_foto_56_zajuwd.png')) center/cover no-repeat;
            transform: scale(1.02);
            z-index: -2;
        }
        .page-hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 76% 18%, rgba(229,9,20,.28), transparent 30%),
                linear-gradient(90deg, rgba(0,0,0,.88) 0%, rgba(0,0,0,.56) 44%, rgba(0,0,0,.18) 100%),
                linear-gradient(180deg, rgba(0,0,0,.12) 0%, rgba(0,0,0,.82) 100%);
            z-index: -1;
        }
        .hero-inner { padding: 170px 0 58px; max-width: 860px; }
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
            letter-spacing: .08em;
            text-transform: uppercase;
        }
        .eyebrow::before { content: ""; width: 9px; height: 9px; border-radius: 50%; background: var(--red); box-shadow: 0 0 0 7px rgba(229,9,20,.20); }
        h1, h2, h3 { font-family: "Geist", sans-serif; line-height: 1.04; margin: 0; letter-spacing: 0; }
        h1 { max-width: 920px; font-size: clamp(54px, 8vw, 116px); line-height: .9; margin-top: 24px; font-weight: 800; }
        .hero-copy { max-width: 660px; margin: 20px 0 0; color: rgba(255,255,255,.84); font-size: 18px; }
        .hero-actions, .actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 28px; }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 48px;
            padding: 0 19px;
            border: 1px solid transparent;
            border-radius: 999px;
            background: #fff;
            color: var(--ink);
            font-family: "Geist", sans-serif;
            font-weight: 900;
            font-size: 13px;
        }
        .btn:hover { transform: translateY(-3px); box-shadow: var(--shadow); }
        .btn-red { border-color: var(--red); background: var(--red); color: #fff; box-shadow: var(--shadow-red); }
        .btn-dark { border-color: #252529; background: var(--dark); color: #fff; }
        .section { padding: 92px 0; }
        .summary-strip {
            position: relative;
            z-index: 4;
            margin-top: -58px;
        }
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }
        .summary-card {
            min-height: 118px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 18px;
            border: 1px solid rgba(255,255,255,.14);
            border-radius: 22px;
            background: rgba(17,17,20,.88);
            color: #fff;
            box-shadow: 0 20px 70px rgba(8,8,10,.26);
            backdrop-filter: blur(16px);
        }
        .summary-card small { color: rgba(255,255,255,.62); font-weight: 850; text-transform: uppercase; font-size: 10px; }
        .summary-card strong { font-family: "Geist", sans-serif; font-size: 22px; line-height: 1.08; }
        .section.dark { color: #fff; background: var(--dark); }
        .section.soft { background: var(--soft); }
        .section-head {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 28px;
            margin-bottom: 34px;
        }
        .section-head h2 { font-size: clamp(36px, 5vw, 68px); line-height: .96; max-width: 820px; font-weight: 800; }
        .section-head p { color: var(--muted); max-width: 420px; margin: 0; }
        .dark .section-head p { color: rgba(255,255,255,.72); }
        .grid { display: grid; gap: 18px; }
        .grid-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .grid-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .grid-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        .card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            overflow: hidden;
            isolation: isolate;
        }
        .dark .card { background: var(--dark-2); border-color: var(--line-light); color: #fff; }
        .card-media { aspect-ratio: 16/10; background: #e8e8ea; overflow: hidden; }
        .card-media img { width: 100%; height: 100%; object-fit: cover; transition: .25s ease; }
        .card:hover .card-media img { transform: scale(1.04); }
        .card-body { padding: 22px; }
        .badge {
            display: inline-flex;
            padding: 6px 9px;
            background: #fff0f1;
            color: var(--red);
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
        }
        .card h3 { margin-top: 12px; font-size: 24px; }
        .card p { color: var(--muted); margin: 12px 0 0; }
        .dark .card p { color: rgba(255,255,255,.72); }
        .prose {
            max-width: 920px;
            color: #3c3c44;
            font-size: 17px;
        }
        .prose-panel {
            padding: 34px;
            border: 1px solid var(--line);
            border-radius: var(--radius-lg);
            background: #fff;
            box-shadow: var(--shadow);
        }
        .prose h2 { color: var(--ink); font-size: 38px; margin: 0 0 18px; }
        .prose img { margin: 24px 0; }
        .feature-list {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 28px;
            padding: 0;
            list-style: none;
        }
        .feature-list li { padding: 15px 16px; background: #fff; border-left: 4px solid var(--red); font-weight: 800; }
        .contact-panel {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 34px;
            align-items: start;
        }
        .form-grid { display: grid; gap: 14px; }
        .input {
            width: 100%;
            border: 1px solid var(--line);
            background: #fff;
            padding: 14px 15px;
            color: var(--ink);
        }
        textarea.input { min-height: 150px; resize: vertical; }
        .notice { padding: 14px 16px; margin-bottom: 18px; font-weight: 800; }
        .notice.success { background: #eaf8ef; color: #0f6b34; }
        .notice.error { background: #fff0f1; color: #97020a; }
        .site-footer { background: #111114; color: #fff; padding: 0; border-top: 1px solid rgba(255,255,255,.12); }
        .footer-row {
            min-height: 112px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 26px;
        }
        .footer-row img { width: 150px; }
        .footer-links { display: flex; flex-wrap: wrap; justify-content: flex-end; gap: 10px 18px; }
        .footer-links a { color: rgba(255,255,255,.72); font-size: 13px; font-weight: 850; }
        .footer-links a:hover { color: #fff; }
        .footer-bottom { padding: 18px 0; border-top: 1px solid rgba(255,255,255,.10); color: rgba(255,255,255,.58); font-size: 13px; }
        .float-wa {
            position: fixed;
            right: 22px;
            bottom: 22px;
            z-index: 60;
            width: 62px;
            height: 62px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: #24d366;
            color: #fff;
            box-shadow: 0 16px 34px rgba(0,0,0,.26);
            font-size: 28px;
            font-weight: 900;
        }
        .pagination { margin-top: 28px; }
        .pagination nav { display: flex; justify-content: center; }
        @media (max-width: 960px) {
            .menu-toggle { display: inline-grid; place-items: center; }
            .main-nav {
                position: absolute;
                left: 0;
                right: 0;
                top: 100%;
                display: none;
                flex-direction: column;
                align-items: stretch;
                padding: 12px 20px 22px;
                background: var(--dark-2);
                border-top: 1px solid var(--line-light);
            }
            .main-nav.open { display: flex; }
            .dropdown { position: static; width: 100%; opacity: 1; visibility: visible; transform: none; pointer-events: auto; display: none; box-shadow: none; margin: 6px 0 10px; }
            .nav-item:hover .dropdown, .nav-item:focus-within .dropdown { display: block; }
            .section-head, .contact-panel { grid-template-columns: 1fr; display: grid; }
            .grid-3, .grid-4, .feature-list, .summary-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .footer-row { align-items: flex-start; flex-direction: column; padding: 32px 0; }
            .footer-links { justify-content: flex-start; }
        }
        @media (max-width: 640px) {
            .topbar .container { align-items: flex-start; flex-direction: column; padding: 8px 0; gap: 4px; }
            .container { width: min(100% - 28px, var(--container)); }
            .brand img { width: 128px; }
            .hero-inner { padding: 132px 0 54px; }
            .page-hero { min-height: 620px; }
            .grid-2, .grid-3, .grid-4, .feature-list, .summary-grid { grid-template-columns: 1fr; }
            .section { padding: 64px 0; }
            .float-wa { width: 54px; height: 54px; right: 16px; bottom: 16px; }
        }

        /* Match homepage final visual system 1:1 */
        body {
            background:
                linear-gradient(rgba(255,255,255,.018) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.018) 1px, transparent 1px),
                linear-gradient(180deg, #111114 0%, #08080a 100%);
            background-size: 36px 36px, 36px 36px, auto;
        }
        .site-header {
            z-index: 1200;
            background: rgba(3,3,5,.92);
            border: 0;
            border-bottom: 1px solid rgba(255,255,255,.16);
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
        .navrow {
            min-height: 82px;
            display: grid;
            grid-template-columns: 188px minmax(0,1fr) 54px;
            gap: 22px;
        }
        .brand { height: 82px; padding: 0; align-items: center; }
        .brand img { width: 156px; }
        .main-nav { height: 82px; justify-content: flex-end; gap: 0; }
        .nav-link, .drop-trigger, .lang-link {
            min-height: 82px;
            padding: 0 18px;
            border: 0;
            border-left: 1px solid rgba(255,255,255,.10);
            border-radius: 0;
            color: rgba(255,255,255,.76);
            background: transparent;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
        }
        .nav-link:hover, .nav-link.active, .nav-item:hover .drop-trigger {
            color: #fff;
            background: linear-gradient(180deg, rgba(239,17,29,.24), rgba(239,17,29,.08));
            box-shadow: inset 0 -3px 0 var(--red);
        }
        .dropdown {
            top: 100%;
            width: 326px;
            padding: 0;
            border: 1px solid rgba(255,255,255,.16);
            border-radius: 0;
            background: rgba(4,4,6,.96);
            box-shadow: 14px 14px 0 rgba(0,0,0,.50);
        }
        .dropdown a {
            min-height: 52px;
            padding: 0 16px;
            border-bottom: 1px solid rgba(255,255,255,.09);
            border-radius: 0;
            text-transform: uppercase;
            letter-spacing: .05em;
            font-size: 12px;
        }
        .dropdown a:hover { background: var(--red); transform: none; }
        .lang-switch { padding: 0; gap: 0; border: 0; border-left: 1px solid rgba(255,255,255,.10); border-radius: 0; }
        .lang-link { min-height: 82px; padding: 0 12px; border-left: 0; }
        .lang-link.active, .lang-link:hover { background: var(--red); color: #fff; }
        .page-hero {
            min-height: 100svh;
            align-items: stretch;
            background: #000;
            border-bottom: 1px solid rgba(255,255,255,.14);
        }
        .page-hero::before {
            filter: saturate(1.12) contrast(1.06) brightness(1.08);
        }
        .page-hero::after {
            background:
                linear-gradient(90deg, rgba(0,0,0,.82) 0%, rgba(0,0,0,.58) 34%, rgba(0,0,0,.10) 68%, rgba(0,0,0,.42) 100%),
                radial-gradient(circle at 78% 20%, rgba(239,17,29,.24), transparent 30%),
                linear-gradient(180deg, rgba(0,0,0,.06) 0%, rgba(0,0,0,.55) 100%);
        }
        .page-hero .container.hero-inner {
            position: relative;
            z-index: 1;
            min-height: 100svh;
            max-width: var(--container);
            display: grid;
            align-content: end;
            padding: 178px 0 76px;
        }
        .page-hero .eyebrow {
            width: max-content;
            border: 1px solid var(--red);
            border-radius: 0;
            background: var(--red);
            color: #fff;
            padding: 16px 24px;
            font-size: clamp(18px, 2vw, 30px);
            letter-spacing: .12em;
            box-shadow: 0 16px 42px rgba(229,9,20,.32);
        }
        .page-hero .eyebrow::before { display: none; }
        .page-hero h1 {
            max-width: 1060px;
            margin: 22px 0 18px;
            font-family: "Barlow Condensed", "Geist", sans-serif;
            font-size: clamp(72px, 11vw, 168px);
            line-height: .72;
            letter-spacing: -.055em;
            text-transform: uppercase;
            text-shadow: 0 18px 52px rgba(0,0,0,.60);
        }
        .page-hero .hero-copy {
            max-width: 820px;
            color: rgba(255,255,255,.82);
            font-size: clamp(15px, 1.35vw, 19px);
            line-height: 1.75;
        }
        .hero-inner > .hero-copy,
        .page-hero .hero-actions {
            margin-left: 36px;
        }
        .page-hero .eyebrow,
        .page-hero h1 {
            margin-left: 36px;
        }
        .page-hero .container.hero-inner::before {
            content: "";
            position: absolute;
            left: 0;
            bottom: 76px;
            width: min(1080px, calc(100% - 40px));
            height: 58%;
            border-left: 8px solid var(--red);
            background: linear-gradient(90deg, rgba(0,0,0,.54), rgba(0,0,0,.06));
            box-shadow: 24px 24px 0 rgba(239,17,29,.10);
            z-index: -1;
        }
        .summary-strip { display: none; }
        .section { background: #fff; }
        .section.dark { background: #030305; }
        .section-head h2,
        .card h3 {
            font-family: "Barlow Condensed", "Geist", sans-serif;
            text-transform: uppercase;
            letter-spacing: -.035em;
        }
        .card { border-radius: 0; box-shadow: none; border-color: rgba(8,8,10,.12); }
        .card:hover .card-media img { transform: none; }
        .prose-panel { border-radius: 0; box-shadow: none; }
        .site-footer {
            background: #050506;
            border-top: 1px solid rgba(255,255,255,.12);
        }
        .footer-row { min-height: 126px; }
        .footer-row img { width: 150px; }
        .footer-bottom { display: none; }
        @media (max-width: 1120px) {
            .navrow { grid-template-columns: 170px 1fr 54px; }
            .main-nav { top: 118px; left: 0; right: 0; padding: 0; background: rgba(3,3,5,.98); border: 1px solid rgba(255,255,255,.14); }
            .nav-link, .drop-trigger { min-height: 56px; width: 100%; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,.10); }
            .dropdown { width: 100%; }
            .lang-switch { width: 100%; }
            .lang-link { min-height: 48px; width: 50%; justify-content: center; }
        }
        @media (max-width: 640px) {
            .topbar { display: none; }
            .navrow { min-height: 74px; grid-template-columns: 150px 1fr 54px; }
            .brand { height: 74px; }
            .brand img { width: 138px; }
            .page-hero .container.hero-inner { padding-top: 118px; }
            .page-hero h1 { font-size: 72px; }
            .page-hero .hero-actions { display: grid; grid-template-columns: 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <header class="site-header">
        <div class="topbar">
            <div class="container">
                <a href="tel:{{ $phone }}">{{ $phone }}</a>
                <a href="mailto:{{ $email }}">{{ $email }}</a>
                <a href="https://www.instagram.com/arimapestclean" target="_blank" rel="noopener">@arimapestclean</a>
            </div>
        </div>
        <div class="container navrow">
            <a class="brand" href="{{ url('/') }}" aria-label="ARIMA Indonesia">
                <img src="{{ $logo }}" alt="ARIMA Indonesia">
            </a>
            <button class="menu-toggle" type="button" aria-label="Open navigation" data-menu-toggle>Menu</button>
            <nav class="main-nav" data-menu>
                <a class="nav-link {{ request()->is('/') || request()->is('eng') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                <div class="nav-item">
                    <button class="drop-trigger" type="button">Service Solution <span>v</span></button>
                    <div class="dropdown">
                        <a href="{{ url('/commercial') }}">Commercial Protection</a>
                        <a href="{{ url('/residential') }}">Residential Protection</a>
                        <a href="{{ url('/industrial') }}">Industrial Protection</a>
                        <a href="{{ url('/disinfection') }}">Disinfection Protection</a>
                        <a href="{{ url('/cleaning') }}">Cleaning Service</a>
                    </div>
                </div>
                <div class="nav-item">
                    <button class="drop-trigger" type="button">Method <span>v</span></button>
                    <div class="dropdown">
                        <a href="{{ url('/generalpest') }}">General Pest</a>
                        <a href="{{ url('/termitebaiting') }}">Termite Baiting</a>
                        <a href="{{ url('/fumigation') }}">Fumigation</a>
                    </div>
                </div>
                <div class="nav-item">
                    <button class="drop-trigger" type="button">Pest <span>v</span></button>
                    <div class="dropdown">
                        <a href="{{ url('/pest') }}">Bugs</a>
                        <a href="{{ url('/otherpest') }}">Other Pest</a>
                    </div>
                </div>
                <a class="nav-link" href="{{ url('/contact_us') }}">Contact Us</a>
                <a class="nav-link" href="{{ url('/news') }}">News</a>
                <div class="lang-switch">
                    <a class="lang-link {{ request()->is('eng*') ? '' : 'active' }}" href="{{ url('/') }}">ID</a>
                    <a class="lang-link {{ request()->is('eng*') ? 'active' : '' }}" href="{{ url('/eng') }}">EN</a>
                </div>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container footer-row">
            <a href="{{ url('/') }}"><img src="{{ $logo }}" alt="ARIMA Indonesia"></a>
            <div class="footer-links">
                <a href="{{ url('/') }}">Home</a>
                <a href="{{ url('/commercial') }}">Service Solution</a>
                <a href="{{ url('/generalpest') }}">Method</a>
                <a href="{{ url('/pest') }}">Pest</a>
                <a href="{{ url('/contact_us') }}">Contact Us</a>
                <a href="{{ url('/news') }}">News</a>
                <a href="{{ url('/eng') }}">English</a>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">{{ $address }} | {{ $phone }} | {{ $email }} | &copy; {{ date('Y') }} ARIMA Indonesia. Website by 1017studios.</div>
        </div>
    </footer>
    <a class="float-wa" href="{{ $waUrl }}" target="_blank" rel="noopener" aria-label="WhatsApp">WA</a>
    <script>
        const menuButton = document.querySelector('[data-menu-toggle]');
        const menu = document.querySelector('[data-menu]');
        if (menuButton && menu) {
            menuButton.addEventListener('click', () => menu.classList.toggle('open'));
        }
    </script>
    @stack('scripts')
</body>
</html>
