@extends('layouts.admin')

@section('content')

@section('breadcrumb')
Pest Management / Create
@endsection

<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-4">
                            <h4 class="card-title">Create Pest Management</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                        <div class="alert alert-danger m-2" style="color:white;font-weight:bold">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('admin.pestManagement.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" id="title" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            placeholder="title" required>
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
                                            class="form-control @error('title_eng') is-invalid @enderror"
                                            placeholder="title in english version" required>
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
                                            placeholder="Here can be your description" value="" required></textarea>
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
                                            placeholder="Here can be your description" value="" required></textarea>
                                        @error('description_eng')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="logo_inputs">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Logo</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="logo[]" class="custom-file-input"
                                                    id="logoInput" required>
                                                <label class="custom-file-label" for="logoInput">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <img class="img-thumbnail preview-image" style="display: none;" width="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary" id="add_logo_input">Add More
                                        Logo</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-success" type="submit"><i
                                            class="bi bi-save mx-1"></i>Submit</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Function to preview image
        function previewImage(input) {
            var file = input.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    input.closest('.col-md-12').querySelector('.preview-image').src = event.target.result;
                    input.closest('.col-md-12').querySelector('.preview-image').style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }

        // Function to update label text
        function updateLabel(input) {
            var fileName = input.files[0].name;
            var label = input.closest('.custom-file').querySelector('.custom-file-label');
            label.textContent = fileName;
        }

        // Event listener for file input change
        function addFileInputChangeListener(input) {
            input.addEventListener('change', function() {
                previewImage(this);
                updateLabel(this);
            });
        }

        // Add event listener to initial file input
        addFileInputChangeListener(document.querySelector('.custom-file-input'));

        // Event listener for adding more logos
        document.getElementById('add_logo_input').addEventListener('click', function() {
            var logoInputs = document.getElementById('logo_inputs');
            var newInput = document.createElement('div');
            newInput.classList.add('col-md-12');
            newInput.innerHTML = `
            <div class="form-group">
                <label>Logo</label>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="logo[]" class="custom-file-input" required>
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger remove-logo-input">Remove</button>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <img class="img-thumbnail preview-image" style="display: none;" width="100">
                </div>
            </div>
            `;
            logoInputs.appendChild(newInput);

            // Add event listener to the new file input
            addFileInputChangeListener(newInput.querySelector('.custom-file-input'));
        });

        // Event listener for removing logo input
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-logo-input')) {
                e.target.closest('.col-md-12').remove();
            }
        });
    });
</script>

@endsection