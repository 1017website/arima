@csrf
<div class="card-body">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Client Name</label>
        <input class="form-control" name="name" value="{{ old('name', $client->name) }}" required>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>Sort Order</label>
        <input type="number" min="0" class="form-control" name="sort_order" value="{{ old('sort_order', $client->sort_order ?? 0) }}">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>Status</label>
        <div style="padding-top:10px;">
          <label style="display:flex;gap:8px;align-items:center;text-transform:none;letter-spacing:0;font-size:14px;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $client->is_active ?? true) ? 'checked' : '' }}>
            Active
          </label>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Subtitle ID</label>
        <input class="form-control" name="subtitle" value="{{ old('subtitle', $client->subtitle) }}">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Subtitle EN</label>
        <input class="form-control" name="subtitle_eng" value="{{ old('subtitle_eng', $client->subtitle_eng) }}">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Logo</label>
        <input type="file" class="form-control" name="logo" accept="image/*">
        @if($client->logo)
          <img src="{{ asset($client->logo) }}" alt="{{ $client->name }}" style="width:140px;height:80px;object-fit:contain;border:1px solid #e5e7eb;border-radius:8px;margin-top:10px;">
        @endif
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>URL</label>
        <input class="form-control" name="url" value="{{ old('url', $client->url) }}" placeholder="https://...">
      </div>
    </div>
  </div>
</div>
