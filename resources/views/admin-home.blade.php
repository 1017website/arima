@extends('layouts.admin')

@section('breadcrumb')
Dashboard
@endsection

@section('content')
<style>
    .dashboard-stack {
        display: grid;
        gap: 18px;
    }
    .dashboard-hero {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 360px;
        gap: 18px;
    }
    .dashboard-panel {
        min-height: 214px;
        padding: 26px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 14px 32px rgba(15,23,42,.05);
    }
    .dashboard-intro {
        position: relative;
        overflow: hidden;
        background:
            linear-gradient(135deg, rgba(229,9,20,.22), rgba(229,9,20,0) 34%),
            linear-gradient(135deg, #15161a, #0d0e11);
        color: #fff;
    }
    .dashboard-intro::before {
        content: "";
        position: absolute;
        inset: 0 0 auto;
        height: 4px;
        background: linear-gradient(90deg, #e50914, #ff6670 46%, rgba(255,255,255,.2));
    }
    .dashboard-intro > * { position: relative; }
    .dashboard-eyebrow {
        margin: 0 0 12px;
        color: #ffb3b8;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .06em;
        text-transform: uppercase;
    }
    .dashboard-title {
        max-width: 720px;
        margin: 0 0 12px;
        color: inherit;
        font-size: 34px;
        line-height: 1.08;
        font-weight: 800;
        letter-spacing: 0;
    }
    .dashboard-copy {
        max-width: 680px;
        margin: 0;
        color: rgba(255,255,255,.76);
        font-size: 14px;
        line-height: 1.75;
        font-weight: 600;
    }
    .dashboard-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 24px;
    }
    .dashboard-action {
        min-height: 42px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 0 14px;
        border-radius: 8px;
        background: #e50914;
        color: #fff;
        font-size: 13px;
        font-weight: 750;
        text-decoration: none;
    }
    .dashboard-action.secondary {
        background: rgba(255,255,255,.1);
        border: 1px solid rgba(255,255,255,.18);
    }
    .dashboard-action:hover {
        color: #fff;
        text-decoration: none;
        filter: brightness(.96);
    }
    .dashboard-checklist {
        display: grid;
        gap: 14px;
        margin-top: 18px;
    }
    .dashboard-check {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        color: #374151;
        font-size: 13px;
        line-height: 1.55;
        font-weight: 700;
    }
    .dashboard-check i {
        color: #10b981;
        font-size: 18px;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
        gap: 12px;
    }
    .stat-card {
        min-height: 96px;
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 12px 24px rgba(15,23,42,.045);
        text-decoration: none;
    }
    .stat-card:hover {
        border-color: #cfd4dc;
        text-decoration: none;
    }
    .stat-icon {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #fff1f2;
        color: #e50914;
        font-size: 18px;
    }
    .stat-value {
        color: #17181c;
        font-size: 28px;
        line-height: 1;
        font-weight: 800;
    }
    .stat-label {
        margin-top: 6px;
        color: #6b7280;
        font-size: 12px;
        font-weight: 750;
    }
    .quick-section {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        background: #fff;
        box-shadow: 0 14px 32px rgba(15,23,42,.05);
    }
    .quick-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 16px;
        padding: 22px 24px 0;
    }
    .quick-title {
        margin: 0;
        color: #17181c;
        font-size: 20px;
        font-weight: 800;
    }
    .quick-caption {
        margin: 6px 0 0;
        color: #6b7280;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
    }
    .quick-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
        padding: 22px 24px 24px;
    }
    .quick-link {
        min-height: 76px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 16px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        background: #fbfcfd;
        color: #17181c;
        font-size: 13px;
        font-weight: 750;
        text-decoration: none;
    }
    .quick-link span {
        display: block;
        color: #6b7280;
        font-size: 12px;
        font-weight: 650;
        margin-top: 4px;
    }
    .quick-link:hover {
        border-color: #cfd4dc;
        color: #e50914;
        text-decoration: none;
    }
    @media (max-width: 1180px) {
        .dashboard-hero,
        .stats-grid,
        .quick-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
    @media (max-width: 680px) {
        .dashboard-hero,
        .stats-grid,
        .quick-grid {
            grid-template-columns: 1fr;
        }
        .dashboard-title { font-size: 28px; }
    }
</style>

<div class="content">
    <div class="dashboard-stack">
        <div class="dashboard-hero">
            <section class="dashboard-panel dashboard-intro">
                <p class="dashboard-eyebrow">ARIMA CMS</p>
                <h2 class="dashboard-title">Selamat datang, {{ $user->name }}.</h2>
                <p class="dashboard-copy">
                    Kelola konten website, service solution, method, pest library, berita, dan pesan pelanggan dari satu console yang ringkas.
                </p>
                <div class="dashboard-actions">
                    <a class="dashboard-action" href="/admin/information">
                        <i class="bi bi-building"></i>
                        Website Information
                    </a>
                    <a class="dashboard-action secondary" href="{{ url('/') }}" target="_blank" rel="noopener">
                        <i class="bi bi-box-arrow-up-right"></i>
                        Lihat Website
                    </a>
                </div>
            </section>

            <section class="dashboard-panel">
                <p class="dashboard-eyebrow" style="color:#e50914;">Workflow</p>
                <h3 class="card-title">Prioritas konten</h3>
                <div class="dashboard-checklist">
                    <div class="dashboard-check"><i class="bi bi-check-circle-fill"></i><span>Update profil, kontak, dan informasi legal perusahaan.</span></div>
                    <div class="dashboard-check"><i class="bi bi-check-circle-fill"></i><span>Rapikan banner utama dan service yang tampil di website.</span></div>
                    <div class="dashboard-check"><i class="bi bi-check-circle-fill"></i><span>Cek pest library dan news sebelum publish.</span></div>
                </div>
            </section>
        </div>

        <div class="stats-grid">
            @foreach ($stats as $stat)
                <a class="stat-card" href="{{ $stat['url'] }}">
                    <span class="stat-icon"><i class="bi {{ $stat['icon'] }}"></i></span>
                    <span>
                        <span class="stat-value">{{ $stat['value'] }}</span>
                        <span class="stat-label">{{ $stat['label'] }}</span>
                    </span>
                </a>
            @endforeach
        </div>

        <section class="quick-section">
            <div class="quick-header">
                <div>
                    <h4 class="quick-title">Shortcut Konten</h4>
                    <p class="quick-caption">Akses cepat ke modul yang paling sering diedit.</p>
                </div>
            </div>
            <div class="quick-grid">
                <a class="quick-link" href="/admin/commercial">
                    <div>Commercial <span>Konten service solution</span></div>
                    <i class="bi bi-arrow-right"></i>
                </a>
                <a class="quick-link" href="/admin/general_pest">
                    <div>General Pest <span>Konten method</span></div>
                    <i class="bi bi-arrow-right"></i>
                </a>
                <a class="quick-link" href="/admin/news/create">
                    <div>Tambah News <span>Buat artikel baru</span></div>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </section>
    </div>
</div>
@endsection
