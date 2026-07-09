@extends('layouts.admin')

@section('breadcrumb')
Meta & Google Ads
@endsection

@section('content')
<div class="content">
  <div class="card">
    <form method="POST" action="{{ route('admin.settings.meta-ads.update') }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap" style="gap:12px;">
          <div>
            <h4 class="card-title">Meta & Google Ads</h4>
            <p class="card-category mb-0">Global default meta tag and Google Ads snippets for frontend pages.</p>
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

        <h5 class="mb-3">Meta Default</h5>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Meta Title ID</label>
              <input class="form-control" name="meta_title" value="{{ old('meta_title', $information->meta_title) }}">
              @error('meta_title')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
              <label>Meta Description ID</label>
              <textarea class="form-control" name="meta_description" rows="4">{{ old('meta_description', $information->meta_description) }}</textarea>
              @error('meta_description')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
              <label>Meta Keywords ID</label>
              <textarea class="form-control" name="meta_keywords" rows="3">{{ old('meta_keywords', $information->meta_keywords) }}</textarea>
              @error('meta_keywords')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Meta Title EN</label>
              <input class="form-control" name="meta_title_eng" value="{{ old('meta_title_eng', $information->meta_title_eng) }}">
              @error('meta_title_eng')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
              <label>Meta Description EN</label>
              <textarea class="form-control" name="meta_description_eng" rows="4">{{ old('meta_description_eng', $information->meta_description_eng) }}</textarea>
              @error('meta_description_eng')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="form-group">
              <label>Meta Keywords EN</label>
              <textarea class="form-control" name="meta_keywords_eng" rows="3">{{ old('meta_keywords_eng', $information->meta_keywords_eng) }}</textarea>
              @error('meta_keywords_eng')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Meta Image</label>
              <input type="file" class="form-control" name="meta_image" accept="image/*">
              @if($information->meta_image)
                <img src="{{ asset($information->meta_image) }}" alt="Meta Image" style="width:180px;height:100px;object-fit:cover;border-radius:8px;margin-top:10px;">
              @endif
              @error('meta_image')<small class="text-danger d-block">{{ $message }}</small>@enderror
            </div>
          </div>
        </div>

        <hr>
        <h5 class="mb-3">Google Ads</h5>
        <div class="form-group">
          <label>AdSense Client ID</label>
          <input class="form-control" name="google_adsense_client_id" value="{{ old('google_adsense_client_id', $information->google_adsense_client_id) }}" placeholder="ca-pub-xxxxxxxxxxxxxxxx">
          @error('google_adsense_client_id')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="form-group">
          <label>Head Script</label>
          <textarea class="form-control" name="google_ads_head_script" rows="6" placeholder="Google Ads script for head">{{ old('google_ads_head_script', $information->google_ads_head_script) }}</textarea>
          @error('google_ads_head_script')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="form-group">
          <label>Body Script</label>
          <textarea class="form-control" name="google_ads_body_script" rows="6" placeholder="Optional body snippet">{{ old('google_ads_body_script', $information->google_ads_body_script) }}</textarea>
          @error('google_ads_body_script')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
