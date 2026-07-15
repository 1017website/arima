<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <meta name="theme-color" content="#0c0d10">
  <title>ARIMA Indonesia — Connect</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Sora:wght@700;800&display=swap" rel="stylesheet">
  <style>
    :root { --red: #e50914; --red-dark: #b60710; --ink: #111318; --muted: #6b7280; --line: #e5e7eb; }
    * { box-sizing: border-box; }
    html, body { min-height: 100%; }
    body {
      margin: 0;
      display: grid;
      min-height: 100vh;
      padding: 28px 18px;
      background:
        radial-gradient(circle at 18% 8%, rgba(229, 9, 20, .16), transparent 34%),
        radial-gradient(circle at 88% 92%, rgba(229, 9, 20, .10), transparent 32%),
        #0c0d10;
      color: var(--ink);
      font-family: Inter, system-ui, sans-serif;
      place-items: center;
    }
    .link-card {
      width: min(100%, 460px);
      padding: 34px;
      border: 1px solid rgba(255, 255, 255, .12);
      border-radius: 24px;
      background: rgba(255, 255, 255, .98);
      box-shadow: 0 30px 90px rgba(0, 0, 0, .35);
      text-align: center;
    }
    .brand-logo {
      display: grid;
      width: 104px;
      height: 84px;
      margin: 0 auto 20px;
      overflow: hidden;
      padding: 11px;
      border: 1px solid #eceef1;
      border-radius: 18px;
      background: #fff;
      box-shadow: 0 16px 34px rgba(229, 9, 20, .26);
      place-items: center;
    }
    .brand-logo img { display: block; width: 100%; height: 100%; object-fit: contain; }
    .brand-fallback { display: grid; width: 100%; height: 100%; border-radius: 12px; background: var(--red); color: #fff; font-family: Sora, sans-serif; font-size: 26px; font-weight: 800; place-items: center; }
    h1 { margin: 0; font-family: Sora, sans-serif; font-size: clamp(25px, 7vw, 32px); font-weight: 800; letter-spacing: -.04em; }
    .tagline { margin: 10px 0 26px; color: var(--muted); font-size: 14px; line-height: 1.6; }
    .link-list { display: grid; gap: 12px; }
    .link-button {
      display: grid;
      min-height: 62px;
      padding: 10px 14px;
      border: 1px solid var(--line);
      border-radius: 14px;
      background: #fff;
      color: var(--ink);
      grid-template-columns: 42px 1fr 32px;
      align-items: center;
      text-align: left;
      text-decoration: none;
      transition: transform .18s ease, border-color .18s ease, box-shadow .18s ease;
    }
    .link-button:hover { transform: translateY(-2px); border-color: #f0a4aa; box-shadow: 0 12px 24px rgba(17, 19, 24, .08); }
    .link-icon { display: grid; width: 38px; height: 38px; border-radius: 10px; background: #fff1f2; color: var(--red); place-items: center; }
    .link-icon svg { width: 21px; height: 21px; fill: currentColor; }
    .link-copy strong { display: block; font-size: 14px; font-weight: 800; }
    .link-copy small { display: block; margin-top: 3px; color: var(--muted); font-size: 11px; }
    .link-arrow { color: var(--red); font-size: 22px; font-weight: 700; text-align: center; }
    .link-button.is-whatsapp { border-color: #bcebd0; background: #f5fff9; }
    .link-button.is-whatsapp .link-icon { background: #dcf8e7; color: #128c4a; }
    .link-button.is-whatsapp .link-arrow { color: #128c4a; }
    .footer-copy { margin: 24px 0 0; color: #9aa1ad; font-size: 11px; font-weight: 600; }
    @media (max-width: 480px) { .link-card { padding: 28px 20px; border-radius: 20px; } }
  </style>
</head>
<body>
  <main class="link-card">
    <div class="brand-logo">
      @if($information?->cms_sidebar_logo || $information?->frontend_logo || $information?->logo_company || $information?->logo_header)
        <img src="{{ asset($information?->cms_sidebar_logo ?: $information?->frontend_logo ?: $information?->logo_company ?: $information?->logo_header) }}" alt="Logo ARIMA Indonesia">
      @else
        <span class="brand-fallback">A</span>
      @endif
    </div>
    <h1>ARIMA Indonesia</h1>
    <p class="tagline">Pest Management, Cleaning &amp; Hygiene Solutions</p>

    <nav class="link-list" aria-label="Link ARIMA Indonesia">
      <a class="link-button" href="{{ $website }}" target="_blank" rel="noopener noreferrer">
        <span class="link-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20Zm6.92 6h-3.03a15.7 15.7 0 0 0-1.38-3.56A8.05 8.05 0 0 1 18.92 8ZM12 4c.83 1.2 1.49 2.52 1.85 4h-3.7A13.3 13.3 0 0 1 12 4ZM4.26 14A7.8 7.8 0 0 1 4 12c0-.69.09-1.36.26-2h3.39a16.5 16.5 0 0 0 0 4H4.26Zm.82 2h3.03c.31 1.26.78 2.46 1.38 3.56A8.05 8.05 0 0 1 5.08 16Zm3.03-8H5.08a8.05 8.05 0 0 1 4.41-3.56A15.7 15.7 0 0 0 8.11 8ZM12 20a13.3 13.3 0 0 1-1.85-4h3.7A13.3 13.3 0 0 1 12 20Zm2.24-6H9.76a14.7 14.7 0 0 1 0-4h4.48a14.7 14.7 0 0 1 0 4Zm.27 5.56A15.7 15.7 0 0 0 15.89 16h3.03a8.05 8.05 0 0 1-4.41 3.56ZM16.35 14a16.5 16.5 0 0 0 0-4h3.39c.17.64.26 1.31.26 2s-.09 1.36-.26 2h-3.39Z"/></svg></span>
        <span class="link-copy"><strong>Website Resmi</strong><small>Kunjungi website ARIMA</small></span>
        <span class="link-arrow" aria-hidden="true">↗</span>
      </a>
      <a class="link-button" href="{{ $instagram }}" target="_blank" rel="noopener noreferrer">
        <span class="link-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5Zm0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7Zm10.5 1.5a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z"/></svg></span>
        <span class="link-copy"><strong>Instagram</strong><small>Ikuti @arimapestclean</small></span>
        <span class="link-arrow" aria-hidden="true">↗</span>
      </a>
      <a class="link-button is-whatsapp" href="{{ $whatsapp }}" target="_blank" rel="noopener noreferrer">
        <span class="link-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12.04 2A9.84 9.84 0 0 0 2.2 11.82c0 1.73.45 3.42 1.31 4.9L2 22l5.43-1.46a9.83 9.83 0 1 0 4.61-18.54Zm0 17.66a7.8 7.8 0 0 1-3.98-1.09l-.28-.17-3.22.87.86-3.13-.18-.29a7.79 7.79 0 1 1 6.8 3.81Zm4.27-5.83c-.23-.12-1.38-.68-1.6-.75-.21-.08-.37-.12-.52.12-.16.23-.61.75-.74.91-.14.15-.28.17-.51.06-.23-.12-.99-.36-1.88-1.15a7.07 7.07 0 0 1-1.3-1.6c-.14-.23-.02-.36.1-.48.11-.1.24-.27.35-.4.12-.14.16-.24.24-.39.08-.16.04-.3-.02-.42-.06-.11-.52-1.26-.72-1.72-.18-.46-.37-.39-.52-.4h-.44c-.16 0-.41.06-.63.3-.21.23-.82.8-.82 1.94s.84 2.25.96 2.41c.11.15 1.65 2.49 4 3.49.56.24 1 .38 1.34.49.56.18 1.07.15 1.48.09.45-.07 1.38-.56 1.58-1.1.19-.53.19-.99.13-1.09-.05-.1-.21-.16-.44-.28Z"/></svg></span>
        <span class="link-copy"><strong>WhatsApp</strong><small>Konsultasi dengan tim ARIMA</small></span>
        <span class="link-arrow" aria-hidden="true">↗</span>
      </a>
    </nav>

    <p class="footer-copy">© {{ date('Y') }} ARIMA Indonesia</p>
  </main>
</body>
</html>
