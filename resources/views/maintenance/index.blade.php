@extends('layouts.admin')

@section('breadcrumb')
Maintenance
@endsection

@section('content')
<div class="content">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Maintenance</h4>
      <p class="card-category mb-0">Run selected Laravel maintenance commands from CMS.</p>
    </div>
    <div class="card-body">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <div class="row">
        @foreach($commands as $key => $command)
          <div class="col-md-4">
            <div class="card" style="box-shadow:none;">
              <div class="card-body">
                <h5>{{ $command['label'] }}</h5>
                <p class="text-muted">{{ $command['description'] }}</p>
                <form method="POST" action="{{ route('admin.maintenance.run') }}" onsubmit="return confirm('Run {{ $command['label'] }}?')">
                  @csrf
                  <input type="hidden" name="command" value="{{ $key }}">
                  <button class="btn btn-primary" type="submit"><i class="bi bi-terminal mx-1"></i>Run</button>
                </form>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      @if(session('artisan_output'))
        <hr>
        <h5>Command Output</h5>
        <pre style="white-space:pre-wrap;background:#111827;color:#e5e7eb;border-radius:8px;padding:16px;max-height:420px;overflow:auto;">{{ session('artisan_output') }}</pre>
      @endif
    </div>
  </div>
</div>
@endsection
