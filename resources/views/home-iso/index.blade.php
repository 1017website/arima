@extends('layouts.admin')

@section('breadcrumb')
Home ISO
@endsection

@section('content')
<div class="content">
  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center flex-wrap" style="gap:12px;">
        <div>
          <h4 class="card-title">Home ISO</h4>
          <p class="card-category mb-0">Kelola gambar sertifikat ISO yang tampil di bawah running text halaman home.</p>
        </div>
        <a class="btn btn-primary" href="{{ route('admin.home-iso.create') }}"><i class="bi bi-plus-circle mx-1"></i>Add ISO</a>
      </div>
    </div>
    <div class="card-body">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Preview</th>
              <th>Title ID</th>
              <th>Title EN</th>
              <th>Order</th>
              <th>Status</th>
              <th style="width:170px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($isos as $iso)
              @php $isoImage = $iso->image && str_starts_with($iso->image, 'http') ? $iso->image : ($iso->image ? asset($iso->image) : null); @endphp
              <tr>
                <td>
                  @if($isoImage)
                    <img src="{{ $isoImage }}" alt="{{ $iso->title ?: 'ISO Certificate' }}" style="width:68px;height:88px;object-fit:contain;border:1px solid #e5e7eb;border-radius:8px;background:#fff;">
                  @else
                    -
                  @endif
                </td>
                <td><strong>{{ $iso->title ?: '-' }}</strong></td>
                <td>{{ $iso->title_eng ?: '-' }}</td>
                <td>{{ $iso->sort_order }}</td>
                <td>{{ $iso->is_active ? 'Active' : 'Hidden' }}</td>
                <td>
                  <a class="btn btn-sm btn-info text-white" href="{{ route('admin.home-iso.edit', $iso->id) }}"><i class="bi bi-pencil"></i></a>
                  <form action="{{ route('admin.home-iso.destroy', $iso->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this ISO item?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit"><i class="bi bi-trash"></i></button>
                  </form>
                </td>
              </tr>
            @empty
              <tr><td colspan="6"><x-empty text="Belum ada konten ISO." /></td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="mt-3">{{ $isos->links() }}</div>
    </div>
  </div>
</div>
@endsection
