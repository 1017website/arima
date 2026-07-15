<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Arima Admin</title>
  @php
    $adminInfo = $siteInformation ?? null;
    $adminFaviconPath = $adminInfo?->cms_favicon ?: $adminInfo?->frontend_favicon ?: $adminInfo?->logo_favicon;
    $adminSidebarLogoPath = $adminInfo?->cms_sidebar_logo ?: $adminInfo?->frontend_logo ?: $adminInfo?->logo_company ?: $adminInfo?->logo_header;
  @endphp
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin-assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ $adminFaviconPath ? asset($adminFaviconPath) : asset('admin-assets/img/favicon.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
  <link href="{{ asset('admin-assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin-assets/css/now-ui-dashboard.css?v=1.5.0') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

  <style>
    :root {
      --cms-red: #e50914;
      --cms-red-dark: #b60710;
      --cms-ink: #14161b;
      --cms-muted: #667085;
      --cms-line: #e5e7eb;
      --cms-soft: #f7f8fb;
      --cms-panel: #ffffff;
      --cms-sidebar: #0c0d10;
      --cms-sidebar-soft: #15171c;
      --cms-font-ui: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      --cms-font-display: "Sora", var(--cms-font-ui);
    }

    * { box-sizing: border-box; }
    html, body { min-height: 100%; }
    html { overflow-x: hidden; }
    body {
      margin: 0;
      background: var(--cms-soft);
      color: var(--cms-ink);
      font-family: var(--cms-font-ui);
      font-size: 14px;
      letter-spacing: 0;
      -webkit-font-smoothing: antialiased;
      text-rendering: optimizeLegibility;
      overflow-x: hidden;
    }

    a { color: inherit; }
    img { max-width: 100%; }

    .card img {
      height: auto;
    }

    .admin-shell {
      min-height: 100vh;
      display: block;
      background: var(--cms-soft);
    }

    .admin-sidebar {
      position: fixed;
      inset: 0 auto 0 0;
      z-index: 30;
      width: 264px;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      background:
        linear-gradient(180deg, rgba(255,255,255,.035), rgba(255,255,255,0) 160px),
        var(--cms-sidebar);
      color: #fff;
      border-right: 1px solid rgba(255,255,255,.08);
    }

    .admin-nav::-webkit-scrollbar {
      width: 8px;
    }

    .admin-nav::-webkit-scrollbar-track {
      background: transparent;
    }

    .admin-nav::-webkit-scrollbar-thumb {
      background: rgba(255,255,255,.16);
      border-radius: 999px;
    }

    .admin-brand {
      flex: 0 0 auto;
      min-height: 84px;
      display: flex;
      align-items: center;
      padding: 18px 18px;
      border-bottom: 1px solid rgba(255,255,255,.08);
    }

    .admin-brand a {
      display: flex;
      align-items: center;
      gap: 12px;
      color: #fff;
      text-decoration: none;
    }

    .admin-brand-mark {
      width: 42px;
      height: 42px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border: 1px solid rgba(255,255,255,.12);
      border-radius: 8px;
      background: var(--cms-red);
      color: #fff;
      font-size: 20px;
      box-shadow: 0 14px 26px rgba(229,9,20,.26);
    }

    .admin-brand-logo {
      width: 52px;
      height: 42px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      padding: 6px;
      border-radius: 8px;
      background: #fff;
    }

    .admin-brand-logo img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .admin-brand-title {
      display: block;
      color: #fff;
      font-family: var(--cms-font-display);
      font-size: 15px;
      font-weight: 700;
      letter-spacing: 0;
      line-height: 1.1;
    }

    .admin-brand-caption {
      display: block;
      margin-top: 4px;
      color: #9aa3b2;
      font-size: 11px;
      font-weight: 600;
    }

    .admin-nav {
      flex: 1 1 auto;
      min-height: 0;
      overflow-y: auto;
      overscroll-behavior: contain;
      padding: 14px 10px 22px;
    }

    .admin-nav-group {
      margin: 18px 0 7px;
      padding: 0 10px;
      color: #828b9b;
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 0;
      text-transform: uppercase;
    }

    .admin-nav a,
    .admin-logout button {
      width: 100%;
      min-height: 39px;
      display: flex;
      align-items: center;
      gap: 10px;
      margin: 2px 0;
      padding: 0 10px;
      border: 0;
      border-radius: 8px;
      background: transparent;
      color: #cdd3dd;
      font: inherit;
      font-size: 13px;
      font-weight: 600;
      text-align: left;
      text-decoration: none;
      cursor: pointer;
    }

    .admin-nav a i,
    .admin-logout button i {
      width: 20px;
      color: #8f99aa;
      font-size: 15px;
      text-align: center;
    }

    .admin-nav a:hover,
    .admin-logout button:hover {
      background: rgba(255,255,255,.075);
      color: #fff;
      text-decoration: none;
    }

    .admin-nav a.is-active {
      background: linear-gradient(135deg, var(--cms-red), #c6000b);
      color: #fff;
      box-shadow: 0 12px 28px rgba(229, 9, 20, .22);
    }

    .admin-nav a.is-active i { color: #fff; }

    .admin-logout {
      margin-top: 14px;
      padding-top: 14px;
      border-top: 1px solid rgba(255,255,255,.08);
    }

    .admin-main {
      min-width: 0;
      width: auto;
      min-height: 100vh;
      margin-left: 264px;
      display: flex;
      flex-direction: column;
      overflow-x: hidden;
    }

    .admin-topbar {
      position: sticky;
      top: 0;
      z-index: 10;
      min-height: 76px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 18px;
      padding: 0 32px;
      background: rgba(255,255,255,.86);
      border-bottom: 1px solid var(--cms-line);
      backdrop-filter: blur(18px);
    }

    .admin-title {
      margin: 0;
      color: var(--cms-ink);
      font-family: var(--cms-font-display);
      font-size: 24px;
      font-weight: 700;
      letter-spacing: 0;
    }

    .admin-subtitle {
      margin: 3px 0 0;
      color: var(--cms-muted);
      font-size: 12px;
      font-weight: 500;
    }

    .admin-actions {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
      justify-content: flex-end;
    }

    .admin-topbar > div:first-child {
      min-width: 0;
    }

    .admin-user {
      min-height: 38px;
      display: inline-flex;
      align-items: center;
      gap: 9px;
      padding: 0 12px;
      border: 1px solid var(--cms-line);
      border-radius: 999px;
      background: #fff;
      color: var(--cms-ink);
      font-size: 12px;
      font-weight: 600;
      box-shadow: 0 8px 20px rgba(15,23,42,.04);
    }

    .admin-link {
      min-height: 38px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 0 13px;
      border: 1px solid var(--cms-line);
      border-radius: 999px;
      background: #fff;
      color: var(--cms-ink);
      font-size: 12px;
      font-weight: 600;
      text-decoration: none;
      box-shadow: 0 8px 20px rgba(15,23,42,.04);
    }

    .admin-link:hover {
      border-color: #cfd4dc;
      color: var(--cms-red);
      text-decoration: none;
    }

    .admin-body {
      flex: 1;
      padding: 28px 32px 18px;
    }

    .panel-header {
      display: none !important;
    }

    .content {
      width: 100%;
      max-width: 1400px;
      margin: 0 auto;
      padding: 0 !important;
    }

    .admin-body > .content > .row > .col-md-4,
    .admin-body > .content > .row > .col-md-6,
    .admin-body > .content > .row > .col-md-8,
    .admin-body > .content > .row > .col-md-9,
    .admin-body > .content > .row > .col-md-10 {
      flex: 0 0 100%;
      max-width: 100%;
    }

    .row {
      margin-left: -10px;
      margin-right: -10px;
    }

    .row>[class*="col-"] {
      min-width: 0;
      padding-left: 10px;
      padding-right: 10px;
    }

    .card {
      margin-bottom: 20px;
      border: 1px solid var(--cms-line);
      border-radius: 8px;
      background: var(--cms-panel);
      box-shadow: 0 14px 32px rgba(15,23,42,.05);
    }

    .card .card-header {
      padding: 22px 24px 8px;
      background: transparent;
      border-bottom: 0;
    }

    .card .card-body {
      padding: 20px 24px 24px;
    }

    .card .card-title,
    .title {
      margin: 0;
      color: var(--cms-ink);
      font-family: var(--cms-font-display);
      font-size: 20px;
      font-weight: 700;
      letter-spacing: 0;
    }

    .card-category,
    label {
      color: var(--cms-muted) !important;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0;
      text-transform: uppercase;
    }

    .form-group {
      margin-bottom: 18px;
    }

    .input-group {
      min-width: 0;
    }

    .form-control {
      min-height: 42px;
      border: 1px solid var(--cms-line);
      border-radius: 7px;
      background-color: #f9fafb;
      color: var(--cms-ink);
      font-size: 14px;
      font-weight: 500;
      box-shadow: none;
    }

    input[type="file"]:not(.custom-file-input) {
      display: block !important;
      width: 100%;
      max-width: 100%;
      min-height: 46px;
      height: 46px !important;
      padding: 7px 10px;
      border: 1px solid var(--cms-line);
      border-radius: 7px;
      background: #fff;
      color: var(--cms-ink);
      font-size: 13px;
      line-height: 1.35;
      cursor: pointer;
      opacity: 1 !important;
      visibility: visible !important;
      overflow: hidden;
      white-space: nowrap;
    }

    input[type="file"]:not(.custom-file-input)::file-selector-button {
      min-height: 30px;
      margin-right: 12px;
      padding: 0 13px;
      border: 0;
      border-radius: 6px;
      background: var(--cms-red);
      color: #fff;
      font: inherit;
      font-size: 12px;
      font-weight: 700;
      cursor: pointer;
    }

    input[type="file"]:not(.custom-file-input)::-webkit-file-upload-button {
      min-height: 30px;
      margin-right: 12px;
      padding: 0 13px;
      border: 0;
      border-radius: 6px;
      background: var(--cms-red);
      color: #fff;
      font: inherit;
      font-size: 12px;
      font-weight: 700;
      cursor: pointer;
    }

    input[type="file"]:not(.custom-file-input):disabled {
      background: #f3f4f6;
      color: #8b949e;
      cursor: not-allowed;
    }

    input[type="file"]:not(.custom-file-input):disabled::file-selector-button,
    input[type="file"]:not(.custom-file-input):disabled::-webkit-file-upload-button {
      background: #c9ced6;
      cursor: not-allowed;
    }

    .custom-file {
      width: 100%;
      height: 46px;
      min-width: 0;
    }

    .custom-file-input {
      height: 46px;
      cursor: pointer;
    }

    .custom-file-label {
      height: 46px;
      padding: 12px 14px;
      border: 1px solid var(--cms-line);
      border-radius: 7px;
      background: #f9fafb;
      color: var(--cms-muted) !important;
      font-size: 13px;
      font-weight: 500;
      line-height: 20px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    .custom-file-label::after {
      height: 44px;
      padding: 12px 14px;
      border-left: 1px solid var(--cms-line);
      border-radius: 0 7px 7px 0;
      background: var(--cms-red);
      color: #fff;
      font-size: 12px;
      font-weight: 700;
      line-height: 20px;
      content: "Choose File";
    }

    textarea.form-control {
      min-height: 120px;
      max-height: none !important;
      padding: 12px 14px;
      resize: vertical;
      border: 1px solid var(--cms-line);
      border-radius: 7px;
      line-height: 1.6;
    }

    .form-control:focus {
      border-color: var(--cms-red);
      box-shadow: 0 0 0 3px rgba(229,9,20,.14);
    }

    .btn {
      border-radius: 7px;
      font-family: var(--cms-font-ui);
      font-weight: 700;
      letter-spacing: 0;
      text-transform: none;
      box-shadow: none !important;
    }

    .btn-primary,
    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary:not(:disabled):not(.disabled):active {
      background: var(--cms-red) !important;
      border-color: var(--cms-red) !important;
      color: #fff !important;
    }

    .btn-primary:hover {
      background: var(--cms-red-dark) !important;
      border-color: var(--cms-red-dark) !important;
    }

    .btn-danger {
      background: #ef4444 !important;
      border-color: #ef4444 !important;
    }

    .table-responsive {
      border: 1px solid var(--cms-line);
      border-radius: 8px;
      background: #fff;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }

    .table {
      margin-bottom: 0;
    }

    .table>thead>tr>th {
      border-top: 0;
      border-bottom: 1px solid var(--cms-line);
      background: #f9fafb;
      color: var(--cms-muted);
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0;
      text-transform: uppercase;
    }

    .table>tbody>tr>td {
      border-top: 1px solid #eef0f3;
      color: var(--cms-ink);
      font-weight: 500;
      vertical-align: middle;
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #fcfcfd;
    }

    .pagination {
      flex-wrap: wrap;
      gap: 6px;
      margin: 0;
    }

    .page-item:first-child .page-link,
    .page-item:last-child .page-link,
    .page-link {
      min-width: 36px;
      min-height: 36px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border: 1px solid var(--cms-line);
      border-radius: 7px;
      color: var(--cms-ink);
      font-size: 13px;
      font-weight: 700;
      line-height: 1;
      box-shadow: none;
    }

    .page-link:hover {
      border-color: #d0d5dd;
      background: #f9fafb;
      color: var(--cms-red);
    }

    .page-item.active .page-link {
      border-color: var(--cms-red);
      background: var(--cms-red);
      color: #fff;
    }

    .page-item.disabled .page-link {
      background: #f9fafb;
      color: #98a2b3;
    }

    .pagination svg {
      width: 16px;
      height: 16px;
      flex: 0 0 16px;
    }

    .alert {
      border: 0;
      border-radius: 7px;
      font-weight: 600;
    }

    .footer {
      padding: 18px 34px 26px;
      background: transparent;
      color: var(--cms-muted);
      font-size: 12px;
    }

    .footer a {
      color: var(--cms-ink);
      font-weight: 700;
    }

    .cms-menu-toggle {
      display: none;
      min-width: 42px;
      min-height: 42px;
      border: 1px solid var(--cms-line);
      border-radius: 8px;
      background: #fff;
      color: var(--cms-ink);
    }

    .cms-loader {
      position: fixed;
      inset: 0;
      z-index: 9999;
      display: grid;
      place-items: center;
      background: rgba(247,248,251,.88);
      backdrop-filter: blur(18px);
      opacity: 0;
      visibility: hidden;
      transition: opacity .18s ease, visibility .18s ease;
    }

    body.cms-loading .cms-loader {
      opacity: 1;
      visibility: visible;
    }

    .cms-loader-card {
      display: inline-flex;
      align-items: center;
      gap: 14px;
      min-width: 220px;
      padding: 18px 20px;
      border: 1px solid rgba(229,9,20,.12);
      border-radius: 8px;
      background: #fff;
      box-shadow: 0 24px 70px rgba(15,23,42,.14);
      color: var(--cms-ink);
      font-weight: 700;
    }

    .cms-loader-mark {
      width: 38px;
      height: 38px;
      border: 3px solid #ffe1e4;
      border-top-color: var(--cms-red);
      border-radius: 50%;
      animation: cmsSpin .72s linear infinite;
    }

    @keyframes cmsSpin {
      to { transform: rotate(360deg); }
    }

    @media (max-width: 1080px) {
      .admin-shell {
        display: block;
      }

      .admin-sidebar {
        inset: 0 auto 0 0;
        z-index: 40;
        width: min(292px, 86vw);
        transform: translateX(-100%);
        transition: transform .22s ease;
        box-shadow: 24px 0 60px rgba(15,23,42,.28);
      }

      body.cms-nav-open .admin-sidebar {
        transform: translateX(0);
      }

      body.cms-nav-open {
        overflow: hidden;
      }

      body.cms-nav-open::after {
        content: "";
        position: fixed;
        inset: 0;
        z-index: 30;
        background: rgba(15,23,42,.52);
        backdrop-filter: blur(2px);
      }

      .cms-menu-toggle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
      }

      .admin-topbar {
        padding: 0 24px;
      }

      .admin-body {
        padding: 24px;
      }

      .admin-main {
        margin-left: 0;
      }
    }

    @media (max-width: 720px) {
      .admin-topbar {
        position: sticky;
        align-items: stretch;
        flex-direction: column;
        gap: 12px;
        min-height: auto;
        padding: 14px 14px;
      }

      .admin-body {
        padding: 16px 12px 10px;
      }

      .admin-actions {
        width: 100%;
        justify-content: flex-start;
      }

      .admin-topbar > div:first-child {
        width: 100%;
      }

      .admin-actions .admin-user,
      .admin-actions .admin-link {
        flex: 1 1 140px;
        justify-content: center;
      }

      .admin-title {
        font-size: 20px;
      }

      .admin-subtitle {
        font-size: 11px;
      }

      .content {
        max-width: none;
      }

      .row {
        margin-left: -6px;
        margin-right: -6px;
      }

      .row>[class*="col-"] {
        padding-left: 6px;
        padding-right: 6px;
      }

      .card {
        margin-bottom: 14px;
        border-radius: 8px;
        box-shadow: 0 10px 22px rgba(15,23,42,.045);
      }

      .card .card-header,
      .card .card-body {
        padding-left: 14px;
        padding-right: 14px;
      }

      .card .card-header {
        padding-top: 16px;
      }

      .card .card-body {
        padding-top: 14px;
        padding-bottom: 16px;
      }

      .card .card-title,
      .title {
        font-size: 18px;
      }

      .card-header .d-flex {
        align-items: flex-start !important;
        flex-direction: column;
      }

      .card-header .btn,
      .btn {
        width: 100%;
        min-height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
      }

      .form-group {
        margin-bottom: 14px;
      }

      .form-control,
      input[type="file"]:not(.custom-file-input),
      .custom-file,
      .custom-file-input,
      .custom-file-label {
        min-height: 44px;
        height: 44px !important;
      }

      textarea.form-control {
        height: auto !important;
        min-height: 112px;
      }

      .custom-file-label,
      input[type="file"]:not(.custom-file-input) {
        font-size: 12px;
      }

      .custom-file-label::after {
        height: 42px;
        padding: 11px 12px;
      }

      .footer {
        padding: 14px 16px 20px;
      }
    }

    @media (max-width: 420px) {
      .admin-brand {
        min-height: 76px;
        padding: 14px;
      }

      .admin-nav {
        padding-left: 8px;
        padding-right: 8px;
      }

      .admin-nav a,
      .admin-logout button {
        min-height: 38px;
        font-size: 12px;
      }

      .admin-title {
        font-size: 18px;
      }

      .admin-link span,
      .admin-user {
        font-size: 11px;
      }

      input[type="file"]:not(.custom-file-input)::file-selector-button,
      input[type="file"]:not(.custom-file-input)::-webkit-file-upload-button {
        max-width: 118px;
        margin-right: 8px;
        padding: 0 10px;
      }
    }
  </style>
</head>

<body>
  @php
    $currentUser = auth()->user();
    $isActive = fn (...$patterns) => request()->is(...$patterns) ? 'is-active' : '';
  @endphp

  <div class="admin-shell">
    <aside class="admin-sidebar" aria-label="Admin navigation">
      <div class="admin-brand">
        <a href="{{ route('admin.dashboard') }}">
          @if($adminSidebarLogoPath)
            <span class="admin-brand-logo"><img src="{{ asset($adminSidebarLogoPath) }}" alt="CMS Logo"></span>
          @else
            <span class="admin-brand-mark"><i class="bi bi-shield-check"></i></span>
          @endif
          <span>
            <span class="admin-brand-title">ARIMA CMS</span>
            <span class="admin-brand-caption">Content Console</span>
          </span>
        </a>
      </div>

      <nav class="admin-nav">
        <a class="{{ $isActive('admin') }}" href="{{ route('admin.dashboard') }}">
          <i class="bi bi-speedometer2"></i>
          <span>Dashboard</span>
        </a>

        <div class="admin-nav-group">Main Content</div>
        <a class="{{ $isActive('admin/information*') }}" href="/admin/information">
          <i class="bi bi-building"></i>
          <span>Information</span>
        </a>
        <a class="{{ $isActive('admin/home-content*') }}" href="/admin/home-content">
          <i class="bi bi-house-gear"></i>
          <span>Home Settings</span>
        </a>
        <a class="{{ $isActive('admin/settings/meta-ads*') }}" href="{{ route('admin.settings.meta-ads.edit') }}">
          <i class="bi bi-google"></i>
          <span>Meta & Google Ads</span>
        </a>
        <a class="{{ $isActive('admin/settings/logos*') }}" href="{{ route('admin.settings.logos.edit') }}">
          <i class="bi bi-image"></i>
          <span>Logo & Favicon</span>
        </a>
        <a class="{{ $isActive('admin/analytics*') }}" href="/admin/analytics">
          <i class="bi bi-graph-up-arrow"></i>
          <span>Visit Analytics</span>
        </a>
        <a class="{{ $isActive('admin/qr-generator*') }}" href="{{ route('admin.qr-generator.index') }}">
          <i class="bi bi-qr-code"></i>
          <span>QR Generator</span>
        </a>
        <a class="{{ $isActive('admin/home-client*') }}" href="/admin/home-client">
          <i class="bi bi-buildings"></i>
          <span>Home Clients</span>
        </a>
        <a class="{{ $isActive('admin/home-iso*') }}" href="/admin/home-iso">
          <i class="bi bi-award"></i>
          <span>Home ISO</span>
        </a>
        <a class="{{ $isActive('admin/slider*') }}" href="/admin/slider">
          <i class="bi bi-images"></i>
          <span>Slider</span>
        </a>
        <a class="{{ $isActive('admin/pestManagement*') }}" href="/admin/pestManagement">
          <i class="bi bi-patch-check"></i>
          <span>Pest Management</span>
        </a>
        <a class="{{ $isActive('admin/contact*') }}" href="/admin/contact">
          <i class="bi bi-inbox"></i>
          <span>Contact Form</span>
        </a>
        <a class="{{ $isActive('admin/news*') }}" href="/admin/news">
          <i class="bi bi-newspaper"></i>
          <span>News</span>
        </a>

        <div class="admin-nav-group">Service Solution</div>
        <a class="{{ $isActive('admin/commercial*') }}" href="/admin/commercial">
          <i class="bi bi-briefcase"></i>
          <span>Commercial</span>
        </a>
        <a class="{{ $isActive('admin/residential*') }}" href="/admin/residential">
          <i class="bi bi-house-door"></i>
          <span>Residential</span>
        </a>
        <a class="{{ $isActive('admin/factory*') }}" href="/admin/factory">
          <i class="bi bi-buildings"></i>
          <span>Factory</span>
        </a>
        <a class="{{ $isActive('admin/disinfection*') }}" href="/admin/disinfection">
          <i class="bi bi-shield-plus"></i>
          <span>Disinfection</span>
        </a>
        <a class="{{ $isActive('admin/cleaning*') }}" href="/admin/cleaning">
          <i class="bi bi-stars"></i>
          <span>Cleaning</span>
        </a>

        <div class="admin-nav-group">Method</div>
        <a class="{{ $isActive('admin/general_pest*') }}" href="/admin/general_pest">
          <i class="bi bi-bug"></i>
          <span>General Pest</span>
        </a>
        <a class="{{ $isActive('admin/termite_baiting*') }}" href="/admin/termite_baiting">
          <i class="bi bi-bullseye"></i>
          <span>Termite Baiting</span>
        </a>
        <a class="{{ $isActive('admin/fumigation*') }}" href="/admin/fumigation">
          <i class="bi bi-cloud-fog2"></i>
          <span>Fumigation</span>
        </a>

        <div class="admin-nav-group">Pest Library</div>
        <a class="{{ $isActive('admin/pest*') }}" href="/admin/pest">
          <i class="bi bi-journal-text"></i>
          <span>Content Pest</span>
        </a>
        <a class="{{ $isActive('admin/bug*') }}" href="/admin/bug">
          <i class="bi bi-grid-3x3-gap"></i>
          <span>Bugs</span>
        </a>

        <div class="admin-nav-group">Access</div>
        <a class="{{ $isActive('admin/user*') }}" href="/admin/user">
          <i class="bi bi-people"></i>
          <span>User List</span>
        </a>
        <a class="{{ $isActive('admin/maintenance*') }}" href="{{ route('admin.maintenance.index') }}">
          <i class="bi bi-terminal"></i>
          <span>Maintenance</span>
        </a>

        <form class="admin-logout" method="POST" action="{{ route('admin.logout') }}">
          @csrf
          <button type="submit">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
          </button>
        </form>
      </nav>
    </aside>

    <main class="admin-main">
      <header class="admin-topbar">
        <div style="display:flex; align-items:center; gap:12px;">
          <button class="cms-menu-toggle" type="button" aria-label="Open menu">
            <i class="bi bi-list"></i>
          </button>
          <div>
            <h1 class="admin-title">@yield('breadcrumb', 'Dashboard')</h1>
            <p class="admin-subtitle">Kelola konten website ARIMA Indonesia.</p>
          </div>
        </div>
        <div class="admin-actions">
          <span class="admin-user">
            <i class="bi bi-person-circle"></i>
            {{ $currentUser?->name ?? 'Admin' }}
          </span>
          <a class="admin-link" href="{{ url('/') }}" target="_blank" rel="noopener">
            <i class="bi bi-box-arrow-up-right"></i>
            View Website
          </a>
        </div>
      </header>

      <div class="admin-body">
        @yield('content')
      </div>

      <footer class="footer">
        <div class="container-fluid px-0">
          <div class="copyright" id="copyright">
            &copy; <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Website by <a href="https://1017studios.com/index.html" target="_blank" rel="noopener">1017studios</a>.
          </div>
        </div>
      </footer>
    </main>
  </div>

  <div class="cms-loader" aria-hidden="true">
    <div class="cms-loader-card">
      <span class="cms-loader-mark"></span>
      <span>Loading CMS...</span>
    </div>
  </div>

  <script src="{{ asset('admin-assets/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('admin-assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('admin-assets/js/core/bootstrap.min.js') }}"></script>
  <script>
    function syncActiveAdminNav() {
      const nav = document.querySelector('.admin-nav');
      const active = nav?.querySelector('a.is-active');
      if (!nav || !active) return;

      const navTop = nav.scrollTop;
      const navBottom = navTop + nav.clientHeight;
      const activeTop = active.offsetTop - nav.offsetTop;
      const activeBottom = activeTop + active.offsetHeight;

      if (activeTop < navTop || activeBottom > navBottom) {
        nav.scrollTop = Math.max(activeTop - 24, 0);
      }
    }

    syncActiveAdminNav();

    document.querySelector('.cms-menu-toggle')?.addEventListener('click', function () {
      document.body.classList.toggle('cms-nav-open');
      syncActiveAdminNav();
    });

    document.addEventListener('click', function (event) {
      if (!document.body.classList.contains('cms-nav-open')) return;
      if (event.target.closest('.admin-sidebar') || event.target.closest('.cms-menu-toggle')) return;
      document.body.classList.remove('cms-nav-open');
    });

    window.addEventListener('pageshow', function () {
      document.body.classList.remove('cms-loading');
      syncActiveAdminNav();
    });

    document.addEventListener('submit', function (event) {
      if (event.target.closest('[data-no-loader]')) return;
      document.body.classList.add('cms-loading');
    }, true);

    document.addEventListener('click', function (event) {
      const link = event.target.closest('a[href]');
      if (!link || link.target === '_blank' || link.hasAttribute('download') || link.dataset.noLoader !== undefined) return;
      const href = link.getAttribute('href');
      if (!href || href.startsWith('#') || href.startsWith('javascript:') || href.startsWith('mailto:') || href.startsWith('tel:')) return;
      document.body.classList.add('cms-loading');
    }, true);
  </script>
  @yield('jquery')
</body>

</html>
