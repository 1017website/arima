@extends('layouts.admin')

@section('breadcrumb')
Visit Analytics
@endsection

@section('content')
<style>
  .analytics-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(190px, 1fr)); gap: 14px; margin-bottom: 18px; }
  .analytics-card { padding: 18px; border: 1px solid #e5e7eb; border-radius: 8px; background: #fff; box-shadow: 0 14px 32px rgba(15,23,42,.05); }
  .analytics-label { margin: 0 0 10px; color: #667085; font-size: 11px; font-weight: 800; letter-spacing: .04em; text-transform: uppercase; }
  .analytics-value { margin: 0; color: #14161b; font-size: 34px; line-height: 1; font-weight: 800; }
  .analytics-layout { display: grid; grid-template-columns: minmax(0, 1.25fr) minmax(300px, .75fr); gap: 18px; margin-bottom: 18px; }
  .bar-chart { display: grid; grid-template-columns: repeat(30, minmax(8px, 1fr)); gap: 5px; align-items: end; min-height: 180px; padding: 18px 8px 6px; }
  .bar { min-height: 4px; border-radius: 999px 999px 2px 2px; background: linear-gradient(180deg, #e50914, #a8060f); }
  .bar-labels { display: flex; justify-content: space-between; color: #667085; font-size: 11px; font-weight: 700; }
  .metric-list { display: grid; gap: 10px; }
  .metric-row { display: grid; grid-template-columns: minmax(0, 1fr) auto; gap: 12px; align-items: center; padding: 12px; border: 1px solid #eef0f3; border-radius: 8px; background: #fbfcfd; }
  .metric-row strong { display: block; overflow: hidden; color: #14161b; font-size: 13px; text-overflow: ellipsis; white-space: nowrap; }
  .metric-row span { color: #667085; font-size: 12px; font-weight: 700; }
  @media (max-width: 980px) { .analytics-layout { grid-template-columns: 1fr; } }
</style>

<div class="content">
  <div class="analytics-grid">
    <div class="analytics-card"><p class="analytics-label">Today</p><p class="analytics-value">{{ number_format($summary['today']) }}</p></div>
    <div class="analytics-card"><p class="analytics-label">Last 7 Days</p><p class="analytics-value">{{ number_format($summary['last_7_days']) }}</p></div>
    <div class="analytics-card"><p class="analytics-label">Last 30 Days</p><p class="analytics-value">{{ number_format($summary['last_30_days']) }}</p></div>
    <div class="analytics-card"><p class="analytics-label">Unique 30 Days</p><p class="analytics-value">{{ number_format($summary['unique_30_days']) }}</p></div>
  </div>

  <div class="analytics-layout">
    <div class="card">
      <div class="card-header"><h4 class="card-title">Traffic 30 Hari</h4><p class="card-category">Jumlah visit publik per hari.</p></div>
      <div class="card-body">
        <div class="bar-chart">
          @foreach($dailyVisits as $day)
            <div class="bar" title="{{ $day['date']->format('d M Y') }}: {{ $day['total'] }} visits" style="height: {{ max(4, round(($day['total'] / $maxDaily) * 170)) }}px;"></div>
          @endforeach
        </div>
        <div class="bar-labels"><span>{{ $dailyVisits->first()['date']->format('d M') }}</span><span>{{ $dailyVisits->last()['date']->format('d M') }}</span></div>
      </div>
    </div>

    <div class="card">
      <div class="card-header"><h4 class="card-title">Device</h4><p class="card-category">Distribusi perangkat 30 hari terakhir.</p></div>
      <div class="card-body">
        <div class="metric-list">
          @forelse($devices as $device)
            <div class="metric-row"><strong>{{ ucfirst($device->device ?: 'Unknown') }}</strong><span>{{ number_format($device->total) }}</span></div>
          @empty
            <x-empty text="Belum ada data device." />
          @endforelse
        </div>
      </div>
    </div>
  </div>

  <div class="analytics-layout">
    <div class="card">
      <div class="card-header"><h4 class="card-title">Top Pages</h4><p class="card-category">Halaman publik paling sering dibuka 30 hari terakhir.</p></div>
      <div class="card-body">
        <div class="metric-list">
          @forelse($topPages as $page)
            <div class="metric-row"><strong>{{ $page->path }}</strong><span>{{ number_format($page->total) }}</span></div>
          @empty
            <x-empty text="Belum ada kunjungan." />
          @endforelse
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header"><h4 class="card-title">UTM Sources</h4><p class="card-category">Sumber campaign yang memakai utm_source.</p></div>
      <div class="card-body">
        <div class="metric-list">
          @forelse($sources as $source)
            <div class="metric-row"><strong>{{ $source->utm_source }}</strong><span>{{ number_format($source->total) }}</span></div>
          @empty
            <x-empty text="Belum ada UTM source." />
          @endforelse
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header"><h4 class="card-title">Recent Visits</h4><p class="card-category">Kunjungan publik terbaru yang tercatat oleh CMS.</p></div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr><th>Time</th><th>Path</th><th>Locale</th><th>Device</th><th>Browser</th><th>Referrer</th></tr>
          </thead>
          <tbody>
            @forelse($recentVisits as $visit)
              <tr>
                <td>{{ $visit->visited_at?->format('d M Y H:i') }}</td>
                <td>{{ $visit->path }}</td>
                <td>{{ strtoupper($visit->locale ?? '-') }}</td>
                <td>{{ ucfirst($visit->device ?? '-') }}</td>
                <td>{{ $visit->browser ?? '-' }}</td>
                <td style="max-width:320px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $visit->referrer ?: '-' }}</td>
              </tr>
            @empty
              <tr><td colspan="6"><x-empty text="Belum ada visit." /></td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="mt-3">{{ $recentVisits->links() }}</div>
    </div>
  </div>
</div>
@endsection
