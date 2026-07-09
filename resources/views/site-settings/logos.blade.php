@extends('layouts.admin')

@section('breadcrumb')
Logo & Favicon
@endsection

@section('content')
@php
  $fields = [
    'frontend_logo' => ['label' => 'Frontend Logo', 'accept' => 'image/*'],
    'frontend_favicon' => ['label' => 'Frontend Favicon', 'accept' => 'image/*,.ico'],
    'cms_favicon' => ['label' => 'CMS Favicon', 'accept' => 'image/*,.ico'],
    'cms_sidebar_logo' => ['label' => 'CMS Sidebar Logo', 'accept' => 'image/*'],
    'cms_login_logo' => ['label' => 'CMS Login Logo', 'accept' => 'image/*'],
  ];
@endphp
<div class="content">
  <div class="card">
    <form method="POST" action="{{ route('admin.settings.logos.update') }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap" style="gap:12px;">
          <div>
            <h4 class="card-title">Logo & Favicon</h4>
            <p class="card-category mb-0">Manage frontend logo, frontend favicon, CMS favicon, sidebar logo, and login logo.</p>
          </div>
          <button class="btn btn-primary" type="submit"><i class="bi bi-save mx-1"></i>Save Changes</button>
        </div>
      </div>
      <div class="card-body">
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
          <div class="alert alert-danger">Please check the highlighted fields.</div>
        @endif

        <div class="row">
          @foreach($fields as $field => $config)
            <div class="col-md-6">
              <div class="form-group">
                <label>{{ $config['label'] }}</label>
                <div style="min-height:120px;display:flex;align-items:center;justify-content:center;background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;padding:18px;margin-bottom:10px;">
                  @if($information->{$field})
                    <img src="{{ asset($information->{$field}) }}" alt="{{ $config['label'] }}" style="max-width:220px;max-height:92px;object-fit:contain;">
                  @else
                    <span class="text-muted">No file uploaded</span>
                  @endif
                </div>
                <input type="file" class="form-control" name="{{ $field }}" accept="{{ $config['accept'] }}">
                @error($field)<small class="text-danger">{{ $message }}</small>@enderror
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
