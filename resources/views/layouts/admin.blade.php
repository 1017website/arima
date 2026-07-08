<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Arima Admin</title>
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin-assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
    }

    * { box-sizing: border-box; }
    html, body { min-height: 100%; }
    body {
      margin: 0;
      background: var(--cms-soft);
      color: var(--cms-ink);
      font-family: "Plus Jakarta Sans", Arial, sans-serif;
      font-size: 14px;
      -webkit-font-smoothing: antialiased;
    }

    a { color: inherit; }
    img { max-width: 100%; }

    .admin-shell {
      min-height: 100vh;
      display: grid;
      grid-template-columns: 264px minmax(0, 1fr);
      background: var(--cms-soft);
    }

    .admin-sidebar {
      position: sticky;
      top: 0;
      height: 100vh;
      overflow-y: auto;
      background:
        linear-gradient(180deg, rgba(255,255,255,.035), rgba(255,255,255,0) 160px),
        var(--cms-sidebar);
      color: #fff;
      border-right: 1px solid rgba(255,255,255,.08);
    }

    .admin-sidebar::-webkit-scrollbar {
      width: 8px;
    }

    .admin-sidebar::-webkit-scrollbar-track {
      background: transparent;
    }

    .admin-sidebar::-webkit-scrollbar-thumb {
      background: rgba(255,255,255,.16);
      border-radius: 999px;
    }

    .admin-brand {
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

    .admin-brand-title {
      display: block;
      color: #fff;
      font-size: 15px;
      font-weight: 800;
      letter-spacing: 0;
      line-height: 1.1;
    }

    .admin-brand-caption {
      display: block;
      margin-top: 4px;
      color: #9aa3b2;
      font-size: 11px;
      font-weight: 700;
    }

    .admin-nav {
      padding: 14px 10px 22px;
    }

    .admin-nav-group {
      margin: 18px 0 7px;
      padding: 0 10px;
      color: #828b9b;
      font-size: 10px;
      font-weight: 800;
      letter-spacing: .08em;
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
      font-weight: 700;
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
      display: flex;
      flex-direction: column;
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
      font-size: 24px;
      font-weight: 800;
      letter-spacing: 0;
    }

    .admin-subtitle {
      margin: 3px 0 0;
      color: var(--cms-muted);
      font-size: 12px;
      font-weight: 650;
    }

    .admin-actions {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
      justify-content: flex-end;
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
      font-weight: 750;
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
      font-weight: 750;
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
      font-size: 20px;
      font-weight: 800;
      letter-spacing: 0;
    }

    .card-category,
    label {
      color: var(--cms-muted) !important;
      font-size: 11px;
      font-weight: 800;
      letter-spacing: .04em;
      text-transform: uppercase;
    }

    .form-group {
      margin-bottom: 18px;
    }

    .form-control {
      min-height: 42px;
      border: 1px solid var(--cms-line);
      border-radius: 7px;
      background-color: #f9fafb;
      color: var(--cms-ink);
      font-size: 14px;
      font-weight: 600;
      box-shadow: none;
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
      font-weight: 750;
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
      font-weight: 800;
      letter-spacing: .04em;
      text-transform: uppercase;
    }

    .table>tbody>tr>td {
      border-top: 1px solid #eef0f3;
      color: var(--cms-ink);
      font-weight: 600;
      vertical-align: middle;
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #fcfcfd;
    }

    .alert {
      border: 0;
      border-radius: 7px;
      font-weight: 800;
    }

    .footer {
      padding: 18px 34px 26px;
      background: transparent;
      color: var(--cms-muted);
      font-size: 12px;
    }

    .footer a {
      color: var(--cms-ink);
      font-weight: 800;
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
      font-weight: 800;
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
        grid-template-columns: 1fr;
      }

      .admin-sidebar {
        position: fixed;
        inset: 0 auto 0 0;
        z-index: 30;
        width: 280px;
        transform: translateX(-100%);
        transition: transform .22s ease;
      }

      body.cms-nav-open .admin-sidebar {
        transform: translateX(0);
      }

      body.cms-nav-open::after {
        content: "";
        position: fixed;
        inset: 0;
        z-index: 20;
        background: rgba(15,23,42,.45);
      }

      .cms-menu-toggle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
      }
    }

    @media (max-width: 720px) {
      .admin-topbar {
        align-items: flex-start;
        flex-direction: column;
        padding: 18px 18px;
      }

      .admin-body {
        padding: 22px 18px 12px;
      }

      .admin-actions {
        width: 100%;
        justify-content: flex-start;
      }

      .admin-title {
        font-size: 20px;
      }

      .card .card-header,
      .card .card-body {
        padding-left: 18px;
        padding-right: 18px;
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
          <span class="admin-brand-mark"><i class="bi bi-shield-check"></i></span>
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
          <span>Home Content</span>
        </a>
        <a class="{{ $isActive('admin/home-client*') }}" href="/admin/home-client">
          <i class="bi bi-buildings"></i>
          <span>Home Clients</span>
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
  <script src="{{ asset('admin-assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <script src="{{ asset('admin-assets/js/plugins/chartjs.min.js') }}"></script>
  <script src="{{ asset('admin-assets/js/plugins/bootstrap-notify.js') }}"></script>
  <script src="{{ asset('admin-assets/js/now-ui-dashboard.min.js?v=1.5.0') }}"></script>
  <script>
    document.querySelector('.cms-menu-toggle')?.addEventListener('click', function () {
      document.body.classList.toggle('cms-nav-open');
    });

    document.addEventListener('click', function (event) {
      if (!document.body.classList.contains('cms-nav-open')) return;
      if (event.target.closest('.admin-sidebar') || event.target.closest('.cms-menu-toggle')) return;
      document.body.classList.remove('cms-nav-open');
    });

    window.addEventListener('pageshow', function () {
      document.body.classList.remove('cms-loading');
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
