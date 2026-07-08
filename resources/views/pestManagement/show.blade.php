@extends('layouts.admin')

@section('content')

@section('breadcrumb')
Pest Management / Detail / {{$pestManagement->id}}
@endsection

<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="card-title">Detail Pest Management {{$pestManagement->id}}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                        <div class="alert alert-danger m-2" style="color:white;font-weight:bold">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" value="{{ $pestManagement->title }}"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title (English Version)</label>
                                        <input type="text" class="form-control" value="{{ $pestManagement->title_eng }}"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea rows="10" class="form-control"
                                            disabled>{{ $pestManagement->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description (English Version)</label>
                                        <textarea rows="10" class="form-control"
                                            disabled>{{ $pestManagement->description_eng }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Logo</label>
                                        <div>
                                            @if($pestManagement->logoPest->isNotEmpty())
                                            @foreach($pestManagement->logoPest as $logo)
                                            <img src="{{ asset($logo->logo) }}" class="img-thumbnail"
                                                style="width: 100px;">
                                            @endforeach
                                            @else
                                            <img src="{{ asset('admin-assets/img/no-photo.png') }}" class="img-thumbnail"
                                                style="width: 100px;">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('admin.pestManagement.edit', $pestManagement->id) }}"
                                        class="btn btn-primary text-white" type="submit"><i
                                            class="bi bi-pencil mx-1"></i>Edit</a>
                                    <a href="/admin/pestManagement" class="btn btn-info text-white"><i
                                            class="bi bi-arrow-return-left mx-1"></i>Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('jquery')

@endsection