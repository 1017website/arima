@extends('layouts.admin')

@section('breadcrumb')
QR Generator
@endsection

@section('content')
@php
  $defaultWebsite = $siteInformation?->website_link ?: url('/');
  $defaultWhatsapp = $siteInformation?->phone_wa ?: '628113000655';
@endphp

<style>
  .qr-page { display: grid; grid-template-columns: minmax(0, 1.15fr) minmax(320px, .85fr); gap: 20px; align-items: start; }
  .qr-panel { overflow: hidden; border: 1px solid #e5e7eb; border-radius: 12px; background: #fff; box-shadow: 0 14px 32px rgba(15, 23, 42, .05); }
  .qr-panel-header { padding: 22px 24px 18px; border-bottom: 1px solid #eef0f3; }
  .qr-panel-header h2 { margin: 0 0 6px; color: #14161b; font-size: 20px; font-weight: 800; }
  .qr-panel-header p { margin: 0; color: #667085; font-size: 13px; line-height: 1.6; }
  .qr-panel-body { padding: 24px; }
  .qr-type-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 24px; }
  .qr-type { display: flex; min-height: 82px; padding: 14px; border: 1px solid #e3e6ea; border-radius: 10px; background: #fbfcfd; color: #344054; cursor: pointer; flex-direction: column; align-items: flex-start; justify-content: center; gap: 7px; text-align: left; transition: .18s ease; }
  .qr-type i { color: #e50914; font-size: 22px; }
  .qr-type span { font-size: 13px; font-weight: 800; }
  .qr-type:hover { border-color: #f2a5aa; background: #fff7f7; }
  .qr-type.is-active { border-color: #e50914; background: #fff3f4; box-shadow: 0 0 0 3px rgba(229, 9, 20, .08); color: #a8060f; }
  .qr-field { margin-bottom: 18px; }
  .qr-field label { display: block; margin-bottom: 8px; color: #344054; font-size: 12px; font-weight: 800; letter-spacing: .02em; }
  .qr-field .form-control { min-height: 46px; border-color: #dfe3e8; border-radius: 8px; font-size: 14px; }
  .qr-field textarea.form-control { min-height: 96px; resize: vertical; }
  .qr-help { display: block; margin-top: 7px; color: #7b8494; font-size: 11px; line-height: 1.5; }
  .qr-actions { display: flex; gap: 10px; flex-wrap: wrap; }
  .qr-generate { min-height: 44px; padding: 0 18px; border: 0; border-radius: 8px; background: #e50914; color: #fff; font-size: 13px; font-weight: 800; }
  .qr-generate:hover { background: #bc0710; }
  .qr-preview-body { display: flex; flex-direction: column; align-items: center; }
  .qr-canvas-shell { display: grid; width: min(100%, 350px); aspect-ratio: 1; padding: 18px; border: 1px solid #e5e7eb; border-radius: 14px; background-color: #fff; background-image: linear-gradient(45deg, #f5f6f8 25%, transparent 25%), linear-gradient(-45deg, #f5f6f8 25%, transparent 25%), linear-gradient(45deg, transparent 75%, #f5f6f8 75%), linear-gradient(-45deg, transparent 75%, #f5f6f8 75%); background-position: 0 0, 0 9px, 9px -9px, -9px 0; background-size: 18px 18px; place-items: center; }
  #qrCanvas { display: block; width: 100%; height: 100%; border-radius: 4px; background: #fff; image-rendering: pixelated; }
  .qr-result { width: 100%; margin-top: 18px; padding: 14px; border: 1px solid #eef0f3; border-radius: 9px; background: #fafbfc; }
  .qr-result-label { display: flex; margin-bottom: 7px; color: #667085; font-size: 10px; font-weight: 800; letter-spacing: .06em; text-transform: uppercase; justify-content: space-between; gap: 10px; }
  .qr-result-value { overflow: hidden; margin: 0; color: #344054; font-size: 12px; line-height: 1.5; overflow-wrap: anywhere; }
  .qr-preview-actions { display: grid; width: 100%; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 14px; }
  .qr-preview-actions button { min-height: 44px; border-radius: 8px; font-size: 12px; font-weight: 800; }
  .qr-download { border: 0; background: #e50914; color: #fff; }
  .qr-download:disabled { opacity: .45; cursor: not-allowed; }
  .qr-copy { border: 1px solid #dfe3e8; background: #fff; color: #344054; }
  .qr-status { min-height: 20px; margin: 12px 0 0; color: #087443; font-size: 12px; font-weight: 700; text-align: center; }
  .qr-status.is-error { color: #c1121f; }
  .qr-note { display: flex; width: 100%; margin-top: 16px; padding: 12px 14px; border-radius: 9px; background: #fff8e8; color: #775b16; font-size: 11px; line-height: 1.55; gap: 9px; }
  .qr-note i { margin-top: 1px; font-size: 15px; }
  [hidden] { display: none !important; }
  @media (max-width: 980px) { .qr-page { grid-template-columns: 1fr; } }
  @media (max-width: 520px) {
    .qr-panel-body, .qr-panel-header { padding-left: 17px; padding-right: 17px; }
    .qr-type-grid { grid-template-columns: 1fr; }
    .qr-type { min-height: 62px; flex-direction: row; align-items: center; justify-content: flex-start; }
    .qr-preview-actions { grid-template-columns: 1fr; }
  }
</style>

<div class="content">
  <div class="qr-page">
    <section class="qr-panel" aria-labelledby="qrGeneratorTitle">
      <div class="qr-panel-header">
        <h2 id="qrGeneratorTitle">Buat QR Code</h2>
        <p>Pilih tujuan QR, isi alamat atau nomor, lalu generate. Semua proses dilakukan langsung di browser.</p>
      </div>
      <div class="qr-panel-body">
        <div class="qr-type-grid" role="group" aria-label="Pilih tipe QR code">
          <button class="qr-type is-active" type="button" data-qr-type="website" aria-pressed="true">
            <i class="bi bi-globe2"></i><span>Website</span>
          </button>
          <button class="qr-type" type="button" data-qr-type="instagram" aria-pressed="false">
            <i class="bi bi-instagram"></i><span>Instagram</span>
          </button>
          <button class="qr-type" type="button" data-qr-type="whatsapp" aria-pressed="false">
            <i class="bi bi-whatsapp"></i><span>WhatsApp</span>
          </button>
        </div>

        <form id="qrForm" data-no-loader novalidate>
          <div data-fields="website">
            <div class="qr-field">
              <label for="websiteValue">Alamat website</label>
              <input class="form-control" id="websiteValue" type="text" value="{{ $defaultWebsite }}" placeholder="https://arima.co.id" autocomplete="url">
              <small class="qr-help">Boleh ditulis dengan atau tanpa https://</small>
            </div>
          </div>

          <div data-fields="instagram" hidden>
            <div class="qr-field">
              <label for="instagramValue">Username atau link Instagram</label>
              <input class="form-control" id="instagramValue" type="text" value="@arimapestclean" placeholder="@arimapestclean" autocomplete="off">
              <small class="qr-help">Contoh: @arimapestclean atau https://instagram.com/arimapestclean</small>
            </div>
          </div>

          <div data-fields="whatsapp" hidden>
            <div class="qr-field">
              <label for="whatsappValue">Nomor WhatsApp</label>
              <input class="form-control" id="whatsappValue" type="tel" value="{{ $defaultWhatsapp }}" placeholder="0811 3000 655" autocomplete="tel">
              <small class="qr-help">Nomor 08 otomatis diubah ke format Indonesia 62.</small>
            </div>
            <div class="qr-field">
              <label for="whatsappMessage">Pesan otomatis <span style="font-weight:500;color:#8b94a3;">(opsional)</span></label>
              <textarea class="form-control" id="whatsappMessage" maxlength="500" placeholder="Halo ARIMA, saya ingin konsultasi..."></textarea>
            </div>
          </div>

          <div class="qr-actions">
            <button class="qr-generate" type="submit"><i class="bi bi-qr-code me-1"></i> Generate QR Code</button>
          </div>
        </form>
      </div>
    </section>

    <aside class="qr-panel" aria-labelledby="qrPreviewTitle">
      <div class="qr-panel-header">
        <h2 id="qrPreviewTitle">Preview & Download</h2>
        <p>File PNG beresolusi 1200 × 1200 px, siap dipakai untuk digital maupun cetak.</p>
      </div>
      <div class="qr-panel-body qr-preview-body">
        <div class="qr-canvas-shell">
          <canvas id="qrCanvas" width="1200" height="1200" aria-label="Preview QR code"></canvas>
        </div>

        <div class="qr-result">
          <div class="qr-result-label"><span>Tujuan QR</span><span id="qrResultType">Website</span></div>
          <p class="qr-result-value" id="qrResultValue">-</p>
        </div>

        <div class="qr-preview-actions">
          <button class="qr-download" id="downloadQr" type="button" disabled><i class="bi bi-download me-1"></i> Download PNG</button>
          <button class="qr-copy" id="copyQrValue" type="button" disabled><i class="bi bi-copy me-1"></i> Salin Link</button>
        </div>
        <p class="qr-status" id="qrStatus" role="status" aria-live="polite"></p>
        <div class="qr-note"><i class="bi bi-info-circle"></i><span>Selalu scan dan cek QR hasil download sebelum dicetak dalam jumlah banyak.</span></div>
      </div>
    </aside>
  </div>
</div>
@endsection

@section('jquery')
<script src="{{ asset('admin-assets/js/qrcode-matrix.js') }}"></script>
<script>
  (function () {
    const form = document.getElementById('qrForm');
    const canvas = document.getElementById('qrCanvas');
    const context = canvas.getContext('2d');
    const downloadButton = document.getElementById('downloadQr');
    const copyButton = document.getElementById('copyQrValue');
    const resultType = document.getElementById('qrResultType');
    const resultValue = document.getElementById('qrResultValue');
    const status = document.getElementById('qrStatus');
    const typeLabels = { website: 'Website', instagram: 'Instagram', whatsapp: 'WhatsApp' };
    let activeType = 'website';
    let currentPayload = '';

    function setStatus(message, isError) {
      status.textContent = message;
      status.classList.toggle('is-error', Boolean(isError));
    }

    function normalizeUrl(value) {
      let candidate = value.trim();
      if (!candidate) throw new Error('Alamat website wajib diisi.');
      if (!/^https?:\/\//i.test(candidate)) candidate = 'https://' + candidate;

      let parsed;
      try {
        parsed = new URL(candidate);
      } catch (error) {
        throw new Error('Alamat website tidak valid.');
      }

      if (!['http:', 'https:'].includes(parsed.protocol) || !parsed.hostname) {
        throw new Error('Alamat website harus menggunakan http atau https.');
      }

      return parsed.href;
    }

    function getInstagramUrl(value) {
      const candidate = value.trim();
      if (!candidate) throw new Error('Username atau link Instagram wajib diisi.');

      const username = candidate.replace(/^@/, '');
      if (/^[a-zA-Z0-9._]{1,30}$/.test(username)) {
        return 'https://www.instagram.com/' + username + '/';
      }

      const url = normalizeUrl(candidate);
      const hostname = new URL(url).hostname.toLowerCase();
      if (hostname !== 'instagram.com' && !hostname.endsWith('.instagram.com')) {
        throw new Error('Masukkan username atau link instagram.com yang valid.');
      }
      return url;
    }

    function getWhatsappUrl(number, message) {
      const raw = number.trim();
      if (!raw) throw new Error('Nomor WhatsApp wajib diisi.');

      let digits = raw.replace(/\D/g, '');
      if (digits.startsWith('0')) digits = '62' + digits.slice(1);
      else if (digits.startsWith('8')) digits = '62' + digits;

      if (digits.length < 8 || digits.length > 15) {
        throw new Error('Nomor WhatsApp harus berisi 8–15 digit.');
      }

      let url = 'https://wa.me/' + digits;
      const cleanMessage = message.trim();
      if (cleanMessage) url += '?text=' + encodeURIComponent(cleanMessage);
      return url;
    }

    function getPayload() {
      if (activeType === 'website') return normalizeUrl(document.getElementById('websiteValue').value);
      if (activeType === 'instagram') return getInstagramUrl(document.getElementById('instagramValue').value);
      return getWhatsappUrl(
        document.getElementById('whatsappValue').value,
        document.getElementById('whatsappMessage').value
      );
    }

    function clearCanvas() {
      context.fillStyle = '#ffffff';
      context.fillRect(0, 0, canvas.width, canvas.height);
    }

    function drawQr(payload) {
      if (!window.QRCodeMatrix) throw new Error('Generator QR gagal dimuat. Silakan refresh halaman.');
      if (payload.length > 1800) throw new Error('Isi QR terlalu panjang. Pendekkan link atau pesan WhatsApp.');

      const qr = window.QRCodeMatrix.create(payload, 'M');
      const quietZone = 4;
      const totalModules = qr.size + (quietZone * 2);
      const moduleSize = Math.floor(canvas.width / totalModules);
      const qrSize = totalModules * moduleSize;
      const offset = Math.floor((canvas.width - qrSize) / 2);

      clearCanvas();
      context.fillStyle = '#111111';
      for (let row = 0; row < qr.size; row += 1) {
        for (let column = 0; column < qr.size; column += 1) {
          if (!qr.isDark(row, column)) continue;
          context.fillRect(
            offset + ((column + quietZone) * moduleSize),
            offset + ((row + quietZone) * moduleSize),
            moduleSize,
            moduleSize
          );
        }
      }
    }

    function generateQr() {
      try {
        const payload = getPayload();
        drawQr(payload);
        currentPayload = payload;
        resultType.textContent = typeLabels[activeType];
        resultValue.textContent = payload;
        downloadButton.disabled = false;
        copyButton.disabled = false;
        setStatus('QR code berhasil dibuat.', false);
      } catch (error) {
        currentPayload = '';
        downloadButton.disabled = true;
        copyButton.disabled = true;
        resultValue.textContent = '-';
        clearCanvas();
        setStatus(error.message || 'QR code tidak dapat dibuat.', true);
      }
    }

    function activateType(type) {
      activeType = type;
      document.querySelectorAll('[data-qr-type]').forEach(function (button) {
        const active = button.dataset.qrType === type;
        button.classList.toggle('is-active', active);
        button.setAttribute('aria-pressed', String(active));
      });
      document.querySelectorAll('[data-fields]').forEach(function (fields) {
        fields.hidden = fields.dataset.fields !== type;
      });
      resultType.textContent = typeLabels[type];
      setStatus('', false);
      generateQr();
    }

    document.querySelectorAll('[data-qr-type]').forEach(function (button) {
      button.addEventListener('click', function () { activateType(button.dataset.qrType); });
    });

    form.addEventListener('submit', function (event) {
      event.preventDefault();
      generateQr();
    });

    downloadButton.addEventListener('click', function () {
      if (!currentPayload) return;
      const link = document.createElement('a');
      link.download = 'qr-' + activeType + '-arima.png';
      link.href = canvas.toDataURL('image/png');
      document.body.appendChild(link);
      link.click();
      link.remove();
      setStatus('QR code berhasil di-download.', false);
    });

    copyButton.addEventListener('click', async function () {
      if (!currentPayload) return;
      try {
        await navigator.clipboard.writeText(currentPayload);
        setStatus('Link berhasil disalin.', false);
      } catch (error) {
        setStatus('Link gagal disalin. Silakan salin dari kolom tujuan QR.', true);
      }
    });

    clearCanvas();
    generateQr();
  })();
</script>
@endsection
