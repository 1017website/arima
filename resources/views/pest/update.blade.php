@extends('layouts.admin')

@section('content')

@section('breadcrumb')
Pest / Edit
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
                            <h4 class="card-title" style="font-weight:bold">Edit Content Pest</h4>
                            <hr class="pt-1" style="margin-top:0px;border-top: 5px solid #920909;">
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                        <div class="alert alert-danger m-2" style="color:white;font-weight:bold">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('admin.pest.update',$pest->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12 pr-1">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" id="title" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            placeholder="Title" value="{{$pest->title}}" required>
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="color:black">Header Image</label>
                                        <div class="grid grid-cols-6">
                                            @if($pest->header_image)
                                            <img id="image_display" class="object-contain items-center"
                                                style="width:10rem;height:10rem;object-fit:cover"
                                                src="{{asset($pest->header_image)}}">
                                            @else
                                            <img id="image_display" class="object-contain items-center"
                                                style="width:10rem;height:10rem;object-fit:cover"
                                                src="{{ asset('admin-assets/img/no-photo.png') }}">
                                            @endif
                                        </div>
                                        <input type="file"
                                            class="form-control mt-3 @error('header_image') is-invalid @enderror"
                                            id="file_input" name="header_image" value="">
                                        @error('header_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-success text-white" type="submit"><i
                                            class="bi bi-save mx-1"></i>Save</button>
                                    <a href="/admin/pest" class="btn btn-info text-white"><i
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
<script src="https://cdn.tiny.cloud/1/a2m8qq7i48j1gc5izphurmemg39o165ft6pbpiz5a7waq805/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>

<script>
    const fileInput = document.getElementById('file_input');
    const imageDisplay = document.getElementById('image_display');

    fileInput.addEventListener('change', function() {
        if (fileInput.files.length > 0) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imageDisplay.src = e.target.result;
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    });
</script>

<script>
    tinymce.init({
        selector: 'textarea#list_type',
        plugins: 'lists textcolor',
        toolbar: 'undo redo | bold italic | bullist numlist | forecolor backcolor',
        height: 300, // You can adjust the height as needed
        menubar: false // Optionally, you can hide the menubar
    });
</script>
@endsection