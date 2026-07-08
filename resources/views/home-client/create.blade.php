@extends('layouts.admin')

@section('breadcrumb')
Home Clients / Create
@endsection

@section('content')
<div class="content">
  <div class="card">
    <form method="POST" action="{{ route('admin.home-client.store') }}" enctype="multipart/form-data">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <h4 class="card-title">Create Client</h4>
          <div>
            <a href="{{ route('admin.home-client.index') }}" class="btn btn-info text-white">Back</a>
            <button class="btn btn-primary" type="submit">Save</button>
          </div>
        </div>
      </div>
      @include('home-client._form')
    </form>
  </div>
</div>
@endsection
