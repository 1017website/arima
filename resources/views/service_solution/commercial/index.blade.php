@extends('layouts.admin')

@section('content')

@section('breadcrumb')
Commercial
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
                            <h4 class="card-title" style="font-weight:bold">Content Commercial</h4>
                            <hr class="pt-1" style="margin-top:0px;border-top: 5px solid #920909;">
                        </div>
                    </div>
                    @if (count($errors) > 0)
                    <div
                        class="alert alert-danger shadow border-radius-xl p-2 border-none text-white font-weight-bolder flex flex-col ">
                        <strong>Sorry ! There were some problems with your input.</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success shadow border-radius-xl" style="background:#31a72b!important">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="card-body">
                        @if(session('error'))
                        <div class="alert alert-danger m-2" style="color:white;font-weight:bold">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form id="#form">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="color:black">Title</label>
                                        <input type="text" id="title" name="title" class="form-control"
                                            placeholder="title" value="{{$commercial->title}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="color:black">Background</label>
                                        <div class="grid grid-cols-6">
                                            <img id="image_display" class="object-cover"
                                                style="width:20rem;height:13rem;object-fit:cover"
                                                src="{{asset($commercial->background)}}" alt="image description">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="color:black">Description (IDN Version)</label>
                                        <div style="text-align: justify">
                                            <div class="form-control" style="text-align: justify" disabled>{!! $commercial->description !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="color:black">Description (ENG Version)</label>
                                        <div>
                                            <div class="form-control" disabled>{!! $commercial->description_eng !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="color:black">List Type</label>
                                        <div>
                                            <div class="form-control" disabled>{!! $commercial->list_type !!}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('admin.commercial.edit', $commercial->id) }}"
                                        class="btn btn-primary text-white" type="submit"><i
                                            class="bi bi-pencil mx-1"></i>Edit</a>
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