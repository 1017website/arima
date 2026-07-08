@extends('layouts.admin')

@section('content')

@section('breadcrumb')
Disinfection / Edit
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
                            <h4 class="card-title" style="font-weight:bold">Edit Content Disinfection</h4>
                            <hr class="pt-1" style="margin-top:0px;border-top: 5px solid #920909;">
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                        <div class="alert alert-danger m-2" style="color:white;font-weight:bold">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('admin.disinfection.update',$disinfection->id)}}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12 pr-1">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" id="title" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            placeholder="Title" value="{{$disinfection->title}}" required>
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
                                        <label style="color:black">Background</label>
                                        <div class="grid grid-cols-6">
                                            @if($disinfection->background)
                                            <img id="image_display" class="object-contain items-center"
                                                style="width:10rem;height:10rem;object-fit:cover"
                                                src="{{asset($disinfection->background)}}">
                                            @else
                                            <img id="image_display" class="object-contain items-center"
                                                style="width:10rem;height:10rem;object-fit:cover"
                                                src="{{ asset('admin-assets/img/no-photo.png') }}">
                                            @endif
                                        </div>
                                        <input type="file"
                                            class="form-control mt-3 @error('background') is-invalid @enderror"
                                            id="file_input" name="background" value="">
                                        @error('background')
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
                                        <label>Description (IDN Version)</label>
                                        <div id="editor1"></div>
                                        <textarea class="@error('description') is-invalid @enderror" name="description"
                                            style="display:none;">{{$disinfection->description}}</textarea>
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
                                        <label>Description (ENG Version)</label>
                                        <div id="editor2"></div>
                                        <textarea class="@error('description_eng') is-invalid @enderror"
                                            name="description_eng"
                                            style="display:none;">{{$disinfection->description_eng}}</textarea>
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
                                    <button class="btn btn-success text-white" type="submit"><i
                                            class="bi bi-save mx-1"></i>Save</button>
                                    <a href="/admin/disinfection" class="btn btn-info text-white"><i
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
    @foreach(['description', 'description_eng'] as $fieldName)
        ClassicEditor
            .create(document.querySelector('#editor{{$loop->iteration}}'))
            .then(editor => {
                editor.setData(`{!! $disinfection[$fieldName] !!}`);
                editor.model.document.on('change:data', () => {
                    const data = editor.getData();
                    document.querySelector(`textarea[name="{{$fieldName}}"]`).value = data;
                });
            })
            .catch(error => {
                console.error(error);
            });
    @endforeach
</script>
@endsection