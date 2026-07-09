@csrf
<div class="card-body">
  @if($errors->any())
    <div class="alert alert-danger">Ada field yang belum valid. Silakan cek form di bawah.</div>
  @endif

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Title ID</label>
        <input class="form-control" name="title" value="{{ old('title', $iso->title) }}" placeholder="Contoh: ISO 9001">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Title EN</label>
        <input class="form-control" name="title_eng" value="{{ old('title_eng', $iso->title_eng) }}" placeholder="Example: ISO 9001">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Sort Order</label>
        <input type="number" min="0" class="form-control" name="sort_order" value="{{ old('sort_order', $iso->sort_order ?? 0) }}">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Status</label>
        <div style="padding-top:10px;">
          <label style="display:flex;gap:8px;align-items:center;text-transform:none;letter-spacing:0;font-size:14px;">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $iso->is_active ?? true) ? 'checked' : '' }}>
            Active
          </label>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Click URL</label>
        <input class="form-control" name="url" value="{{ old('url', $iso->url) }}" placeholder="https://... atau kosongkan">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Upload ISO Image</label>
        <input type="file" class="form-control" name="image" accept="image/*">
        <small class="text-muted d-block mt-2">Upload gambar baru jika ingin mengganti file lama.</small>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Image URL</label>
        <input class="form-control" name="image_url" value="{{ old('image_url', $iso->image) }}" placeholder="https://.../sertifikat.png">
        <small class="text-muted d-block mt-2">Bisa pakai URL Cloudinary atau kosongkan jika upload file.</small>
      </div>
    </div>

    @if($iso->image)
      @php $isoPreview = str_starts_with($iso->image, 'http') ? $iso->image : asset($iso->image); @endphp
      <div class="col-md-12">
        <div class="form-group">
          <label>Current Preview</label>
          <div style="border:1px solid #e5e7eb;border-radius:10px;background:#f9fafb;padding:14px;display:inline-block;">
            <img src="{{ $isoPreview }}" alt="{{ $iso->title ?: 'ISO Certificate' }}" style="width:220px;max-height:300px;object-fit:contain;border-radius:8px;background:#fff;">
          </div>
        </div>
      </div>
    @endif
  </div>
</div>
