@extends('layouts.admin')

@section('breadcrumb')
Home ISO / Create
@endsection

@section('content')
<div class="content">
  <div class="card">
    <form method="POST" action="{{ route('admin.home-iso.store') }}" enctype="multipart/form-data">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <h4 class="card-title">Create ISO Content</h4>
          <div>
            <a href="{{ route('admin.home-iso.index') }}" class="btn btn-info text-white">Back</a>
            <button class="btn btn-primary" type="submit">Save</button>
          </div>
        </div>
      </div>
      @include('home-iso._form')
    </form>
  </div>
</div>
@endsection
