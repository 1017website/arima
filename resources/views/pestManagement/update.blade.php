@extends('layouts.admin')

@section('content')

@section('breadcrumb')
Pest Management / Update
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
                            <h4 class="card-title">Update Pest Management</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                        <div class="alert alert-danger m-2" style="color:white;font-weight:bold">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('admin.pestManagement.update', $pestManagement->id)}}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" id="title" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            placeholder="title" value="{{ $pestManagement->title }}" required>
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
                                        <label>Title (English Version)</label>
                                        <input type="text" id="title_eng" name="title_eng"
                                            class="form-control @error('title') is-invalid @enderror"
                                            placeholder="title in english version"
                                            value="{{ $pestManagement->title_eng }}" required>
                                        @error('title_eng')
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
                                        <label>Description</label>
                                        <textarea rows="10" cols="80"
                                            class="form-control @error('description') is-invalid @enderror"
                                            id="description" name="description"
                                            placeholder="Here can be your description" value=""
                                            required>{{$pestManagement->description}}</textarea>
                                        @error('description')
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
                                        <label>Description (English Version)</label>
                                        <textarea rows="10" cols="80"
                                            class="form-control @error('description_eng') is-invalid @enderror"
                                            id="description_eng" name="description_eng"
                                            placeholder="Here can be your description" value=""
                                            required>{{$pestManagement->description_eng}}</textarea>
                                        @error('description_eng')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Existing Logos</label>
                                    @foreach($pestManagement->logoPest as $logo)
                                    <div class="mb-3">
                                        <div class="input-group mt-2">
                                            <div class="custom-file">
                                                <input type="file" name="logo[]" class="custom-file-input"
                                                    id="existingLogoInput{{$loop->index}}">
                                                <label class="custom-file-label"
                                                    for="existingLogoInput{{$loop->index}}">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <img class="img-thumbnail existing-preview-image"
                                                src="{{ asset($logo->logo) }}" width="100">
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-success" type="submit"><i
                                            class="bi bi-save mx-1"></i>Update</button>
                                    <a href="{{ route('admin.pestManagement.index') }}" class="btn btn-info text-white"><i
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function previewImage(input, previewElement) {
            var file = input.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    previewElement.src = event.target.result;
                    previewElement.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }

        function updateLabel(input) {
            var fileName = input.files[0].name;
            var label = input.closest('.custom-file').querySelector('.custom-file-label');
            label.textContent = fileName;
        }

        function addFileInputChangeListener(input, previewElement) {
            input.addEventListener('change', function() {
                previewImage(this, previewElement);
                updateLabel(this);
            });
        }

        var existingInputs = document.querySelectorAll('[name="logo[]"]');
        existingInputs.forEach(function(input, index) {
            var previewElement = document.querySelectorAll('.existing-preview-image')[index];
            addFileInputChangeListener(input, previewElement);
        });
    });
</script>

@endsection