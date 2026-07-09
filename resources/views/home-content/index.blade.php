@extends('layouts.admin')

@section('breadcrumb')
SEO & Home Settings
@endsection

@section('content')
<div class="content">
  <div class="card">
    <form method="POST" action="{{ route('admin.home-content.update', $homeContent->id) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap" style="gap:12px;">
          <div>
            <h4 class="card-title">SEO & Home Settings</h4>
            <p class="card-category mb-0">Setting SEO, analytics script, hero video, client copy, dan teks bilingual halaman home.</p>
          </div>
          <button class="btn btn-primary" type="submit"><i class="bi bi-save mx-1"></i>Save Changes</button>
        </div>
      </div>

      <div class="card-body">
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
          <div class="alert alert-danger">Ada field yang belum valid. Silakan cek form di bawah.</div>
        @endif

        <h5 class="mb-3">Hero Video</h5>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Upload Video</label>
              <input type="file" class="form-control" name="hero_video" accept="video/mp4,video/webm,video/ogg">
              @if($homeContent->hero_video)
                <small class="text-muted d-block mt-2">Current: {{ $homeContent->hero_video }}</small>
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Video URL</label>
              <input type="text" class="form-control" name="hero_video_url" value="{{ old('hero_video_url', $homeContent->hero_video_url) }}" placeholder="https://.../video.mp4">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Upload Poster</label>
              <input type="file" class="form-control" name="hero_poster" accept="image/*">
              @if($homeContent->hero_poster)
                <img src="{{ asset($homeContent->hero_poster) }}" alt="Hero Poster" style="width:180px;height:100px;object-fit:cover;border-radius:8px;margin-top:10px;">
              @endif
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Poster URL</label>
              <input type="text" class="form-control" name="hero_poster_url" value="{{ old('hero_poster_url', $homeContent->hero_poster_url) }}" placeholder="https://.../poster.jpg">
            </div>
          </div>
        </div>

        <hr>
        <h5 class="mb-3">Hero Copy</h5>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group"><label>Eyebrow ID</label><input class="form-control" name="hero_eyebrow" value="{{ old('hero_eyebrow', $homeContent->hero_eyebrow) }}"></div>
            <div class="form-group"><label>Title ID</label><input class="form-control" name="hero_title" value="{{ old('hero_title', $homeContent->hero_title) }}"></div>
            <div class="form-group"><label>Description ID</label><textarea class="form-control" name="hero_description" rows="5">{{ old('hero_description', $homeContent->hero_description) }}</textarea></div>
            <div class="form-group"><label>Primary CTA ID</label><input class="form-control" name="hero_primary_cta" value="{{ old('hero_primary_cta', $homeContent->hero_primary_cta) }}"></div>
            <div class="form-group"><label>Secondary CTA ID</label><input class="form-control" name="hero_secondary_cta" value="{{ old('hero_secondary_cta', $homeContent->hero_secondary_cta) }}"></div>
          </div>
          <div class="col-md-6">
            <div class="form-group"><label>Eyebrow EN</label><input class="form-control" name="hero_eyebrow_eng" value="{{ old('hero_eyebrow_eng', $homeContent->hero_eyebrow_eng) }}"></div>
            <div class="form-group"><label>Title EN</label><input class="form-control" name="hero_title_eng" value="{{ old('hero_title_eng', $homeContent->hero_title_eng) }}"></div>
            <div class="form-group"><label>Description EN</label><textarea class="form-control" name="hero_description_eng" rows="5">{{ old('hero_description_eng', $homeContent->hero_description_eng) }}</textarea></div>
            <div class="form-group"><label>Primary CTA EN</label><input class="form-control" name="hero_primary_cta_eng" value="{{ old('hero_primary_cta_eng', $homeContent->hero_primary_cta_eng) }}"></div>
            <div class="form-group"><label>Secondary CTA EN</label><input class="form-control" name="hero_secondary_cta_eng" value="{{ old('hero_secondary_cta_eng', $homeContent->hero_secondary_cta_eng) }}"></div>
          </div>
        </div>

        <hr>
        <h5 class="mb-3">Client Section Copy</h5>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group"><label>Kicker ID</label><input class="form-control" name="client_kicker" value="{{ old('client_kicker', $homeContent->client_kicker) }}"></div>
            <div class="form-group"><label>Title ID</label><input class="form-control" name="client_title" value="{{ old('client_title', $homeContent->client_title) }}"></div>
            <div class="form-group"><label>Description ID</label><textarea class="form-control" name="client_description" rows="4">{{ old('client_description', $homeContent->client_description) }}</textarea></div>
          </div>
          <div class="col-md-6">
            <div class="form-group"><label>Kicker EN</label><input class="form-control" name="client_kicker_eng" value="{{ old('client_kicker_eng', $homeContent->client_kicker_eng) }}"></div>
            <div class="form-group"><label>Title EN</label><input class="form-control" name="client_title_eng" value="{{ old('client_title_eng', $homeContent->client_title_eng) }}"></div>
            <div class="form-group"><label>Description EN</label><textarea class="form-control" name="client_description_eng" rows="4">{{ old('client_description_eng', $homeContent->client_description_eng) }}</textarea></div>
          </div>
        </div>

        <hr>
        <h5 class="mb-3">SEO</h5>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group"><label>SEO Title ID</label><input class="form-control" name="seo_title" value="{{ old('seo_title', $homeContent->seo_title) }}"></div>
            <div class="form-group"><label>SEO Description ID</label><textarea class="form-control" name="seo_description" rows="4">{{ old('seo_description', $homeContent->seo_description) }}</textarea></div>
            <div class="form-group"><label>SEO Keywords ID</label><textarea class="form-control" name="seo_keywords" rows="3">{{ old('seo_keywords', $homeContent->seo_keywords) }}</textarea></div>
          </div>
          <div class="col-md-6">
            <div class="form-group"><label>SEO Title EN</label><input class="form-control" name="seo_title_eng" value="{{ old('seo_title_eng', $homeContent->seo_title_eng) }}"></div>
            <div class="form-group"><label>SEO Description EN</label><textarea class="form-control" name="seo_description_eng" rows="4">{{ old('seo_description_eng', $homeContent->seo_description_eng) }}</textarea></div>
            <div class="form-group"><label>SEO Keywords EN</label><textarea class="form-control" name="seo_keywords_eng" rows="3">{{ old('seo_keywords_eng', $homeContent->seo_keywords_eng) }}</textarea></div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Open Graph Image</label>
              <input type="file" class="form-control" name="og_image" accept="image/*">
              @if($homeContent->og_image)
                <img src="{{ asset($homeContent->og_image) }}" alt="OG Image" style="width:180px;height:100px;object-fit:cover;border-radius:8px;margin-top:10px;">
              @endif
            </div>
          </div>
        </div>

        <hr>
        <h5 class="mb-3">Analytics</h5>
        <div class="form-group">
          <label>Analytics Head Script</label>
          <textarea class="form-control" name="analytics_head" rows="6" placeholder="Google Analytics / GTM script for head">{{ old('analytics_head', $homeContent->analytics_head) }}</textarea>
        </div>
        <div class="form-group">
          <label>Analytics Body Script</label>
          <textarea class="form-control" name="analytics_body" rows="6" placeholder="GTM noscript or body snippet">{{ old('analytics_body', $homeContent->analytics_body) }}</textarea>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
