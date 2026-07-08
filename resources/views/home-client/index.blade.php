@extends('layouts.admin')

@section('breadcrumb')
Home Clients
@endsection

@section('content')
<div class="content">
  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center flex-wrap" style="gap:12px;">
        <div>
          <h4 class="card-title">Home Clients</h4>
          <p class="card-category mb-0">Logo/nama client dan subtitle bilingual untuk halaman home.</p>
        </div>
        <a class="btn btn-primary" href="{{ route('admin.home-client.create') }}"><i class="bi bi-plus-circle mx-1"></i>Add Client</a>
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
              <th>Name</th>
              <th>Subtitle ID</th>
              <th>Subtitle EN</th>
              <th>Order</th>
              <th>Status</th>
              <th style="width:170px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse($clients as $client)
              <tr>
                <td><strong>{{ $client->name }}</strong></td>
                <td>{{ $client->subtitle }}</td>
                <td>{{ $client->subtitle_eng }}</td>
                <td>{{ $client->sort_order }}</td>
                <td>{{ $client->is_active ? 'Active' : 'Hidden' }}</td>
                <td>
                  <a class="btn btn-sm btn-info text-white" href="{{ route('admin.home-client.edit', $client->id) }}"><i class="bi bi-pencil"></i></a>
                  <form action="{{ route('admin.home-client.destroy', $client->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this client?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit"><i class="bi bi-trash"></i></button>
                  </form>
                </td>
              </tr>
            @empty
              <tr><td colspan="6"><x-empty text="Belum ada client." /></td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="mt-3">{{ $clients->links() }}</div>
    </div>
  </div>
</div>
@endsection
