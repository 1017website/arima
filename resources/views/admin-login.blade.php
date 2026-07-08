<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Arima Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('admin-assets/img/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@500;600;700;800;900&family=Manrope:wght@400;500;600;700;800&family=Barlow+Condensed:wght@700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --red: #e50914;
            --dark: #15161a;
            --line: #e5e7eb;
            --text: #17171b;
            --muted: #6b7280;
        }
        * { box-sizing: border-box; }
        html, body { min-height: 100%; }
        body {
            margin: 0;
            font-family: "Manrope", "Geist", system-ui, sans-serif;
            color: var(--text);
            background:
                linear-gradient(135deg, rgba(255,255,255,.92), rgba(245,246,248,.94)),
                url('{{ asset('admin-assets/img/banner.png') }}') center/cover no-repeat;
        }
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(17,17,20,.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(17,17,20,.035) 1px, transparent 1px);
            background-size: 64px 64px;
            pointer-events: none;
        }
        .auth-page {
            position: relative;
            min-height: 100svh;
            display: grid;
            place-items: center;
            padding: 40px 20px;
        }
        .auth-card {
            width: min(100%, 460px);
            padding: 34px;
            border: 1px solid var(--line);
            border-top: 6px solid var(--red);
            background: #fff;
            box-shadow: 0 24px 80px rgba(15,23,42,.14);
        }
        .brand {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 34px;
        }
        .brand img { width: 164px; height: auto; }
        .badge {
            padding: 10px 12px;
            background: var(--red);
            color: #fff;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: .12em;
            text-transform: uppercase;
        }
        h1 {
            margin: 0 0 8px;
            font-family: "Barlow Condensed", "Geist", sans-serif;
            font-size: 58px;
            line-height: .85;
            letter-spacing: 0;
            text-transform: uppercase;
        }
        p { margin: 0 0 28px; color: var(--muted); font-weight: 600; }
        .alert {
            margin-bottom: 18px;
            padding: 13px 14px;
            border: 1px solid #fecdd3;
            background: #fff1f2;
            color: #9f1239;
            font-weight: 800;
        }
        .field { display: grid; gap: 8px; margin-bottom: 14px; }
        label {
            color: #4b5563;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: .12em;
            text-transform: uppercase;
        }
        input {
            width: 100%;
            min-height: 52px;
            padding: 0 15px;
            border: 1px solid var(--line);
            background: #f9fafb;
            color: var(--text);
            outline: none;
            font: inherit;
        }
        input:focus { border-color: var(--red); box-shadow: 0 0 0 3px rgba(229,9,20,.18); }
        .error { color: #be123c; font-size: 12px; font-weight: 800; }
        .actions {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 0;
            margin-top: 22px;
        }
        button, .home-link {
            min-height: 54px;
            border: 1px solid rgba(255,255,255,.18);
            padding: 0 18px;
            font-family: "Geist", sans-serif;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
            cursor: pointer;
        }
        button { background: var(--red); color: #fff; border-color: var(--red); }
        .home-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--text);
            background: #f9fafb;
            text-decoration: none;
        }
        .hint {
            margin-top: 18px;
            color: #9ca3af;
            font-size: 12px;
        }
        @media (max-width: 560px) {
            .auth-card { padding: 26px; }
            .brand { align-items: flex-start; flex-direction: column; }
            h1 { font-size: 48px; }
            .actions { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <main class="auth-page">
        <section class="auth-card">
            <div class="brand">
                <img src="{{ asset('assets/arima/logo-new.PNG') }}" alt="ARIMA Indonesia">
                <span class="badge">CMS</span>
            </div>
            <h1>Admin Login</h1>
            <p>Masuk ke panel konten ARIMA Indonesia.</p>

            @if (session('error'))
                <div class="alert">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
                    @error('email')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" autocomplete="current-password" required>
                    @error('password')<span class="error">{{ $message }}</span>@enderror
                </div>
                <div class="actions">
                    <button type="submit">Login</button>
                    <a class="home-link" href="{{ url('/') }}">Home</a>
                </div>
            </form>
            <div class="hint">Development admin awal: admin@arima.test / password</div>
        </section>
    </main>
</body>
</html>
