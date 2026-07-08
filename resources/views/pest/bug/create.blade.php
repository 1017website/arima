@extends('layouts.admin')

@section('content')

@section('breadcrumb')
Bug / Create
@endsection

<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            @if($errors->has('image'))
            <div class="alert alert-danger m-2" style="color:white;font-weight:bold">
                {{ $errors->first('image') }}
            </div>
            @endif

            @if($errors->has('latin_title'))
            <div class="alert alert-danger m-2" style="color:white;font-weight:bold">
                {{ $errors->first('latin_title') }}
            </div>
            @endif

            @if($errors->has('title_bugs'))
            <div class="alert alert-danger m-2" style="color:white;font-weight:bold">
                {{ $errors->first('title_bugs') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-4">
                            <h4 class="card-title">Create Bug</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                        <div class="alert alert-danger m-2" style="color:white;font-weight:bold">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('admin.bug.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Types of Bug</label>
                                            <select class="form-control @error('types') is-invalid @enderror"
                                                id="exampleFormControlSelect1" name="types" required>
                                                <option selected disabled hidden>Select the types of bug</option>
                                                <option value="0">Types of insect pests</option>
                                                <option value="1">Other types of pests</option>
                                            </select>
                                        </div>
                                        @error('types')
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
                                            placeholder="title" required>
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
                                        <label style="color:black">Icon</label>
                                        <div class="grid grid-cols-6">
                                            <img id="image_display" class="object-cover"
                                                style="width:10rem;height:10rem;object-fit:cover"
                                                src="{{asset('admin-assets/img/no-photo.png')}}" alt="image description">
                                        </div>
                                        <input type="file" name="icon" id="file_input"
                                            class="form-control mt-2 @error('icon') is-invalid @enderror" />
                                        <small class="text-muted">Please choose an image to upload.</small>
                                        @error('icon')
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
                                            <img id="image_display2" class="object-cover"
                                                style="width:10rem;height:10rem;object-fit:cover"
                                                src="{{asset('admin-assets/img/no-photo.png')}}" alt="image description">
                                        </div>
                                        <input type="file" name="header_image" id="file_input2"
                                            class="form-control mt-2 @error('header_image') is-invalid @enderror" />
                                        <small class="text-muted">Please choose an image to upload.</small>
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
                                    <div class="form-group">
                                        <label>Ekosistem (IDN Version)</label>
                                        <div id="editor1"></div>
                                        <textarea class="@error('ekosistem') is-invalid @enderror" name="ekosistem"
                                            style="display:none;"></textarea>
                                        @error('ekosistem')
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
                                        <label>Ekosistem (ENG Version)</label>
                                        <div id="editor2"></div>
                                        <textarea class="@error('ekosistem_eng') is-invalid @enderror"
                                            name="ekosistem_eng" style="display:none;"></textarea>
                                        @error('ekosistem_eng')
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
                                        <label>Fun Fact</label>
                                        <textarea rows="10" cols="80"
                                            class="form-control @error('funfact') is-invalid @enderror" id="funfact"
                                            name="funfact" placeholder="Here can be your funfact" required></textarea>
                                        @error('funfact')
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
                                        <label>Fun Fact (English Version)</label>
                                        <textarea rows="10" cols="80"
                                            class="form-control @error('funfact_eng') is-invalid @enderror"
                                            id="funfact_eng" name="funfact_eng" placeholder="Here can be your funfact"
                                            required></textarea>
                                        @error('funfact_eng')
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
                                        <label>Penanggulangan (IDN Version)</label>
                                        <div id="editor3"></div>
                                        <textarea class="@error('penanggulangan') is-invalid @enderror"
                                            name="penanggulangan" style="display:none;"></textarea>
                                        @error('penanggulangan')
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
                                        <label>Penanggulangan (ENG Version)</label>
                                        <div id="editor4"></div>
                                        <textarea class="@error('penanggulangan_eng') is-invalid @enderror"
                                            name="penanggulangan_eng" style="display:none;"></textarea>
                                        @error('penanggulangan_eng')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div id="bugTypeSectionTemplate" style="display: none;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Bug Types</label>
                                        <div class="row">
                                            <div class="col-sm-12 py-2" style="background:#e3e3e3;border-radius:10px">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-12 py-2">
                                                            <div class="form-group">
                                                                <label style="color:black">Bug Type Image</label>
                                                                <div class="grid grid-cols-6">
                                                                    <img class="object-cover image_display"
                                                                        style="width:10rem;height:10rem;object-fit:cover"
                                                                        src="{{asset('admin-assets/img/no-photo.png')}}"
                                                                        alt="image description">
                                                                </div>
                                                                <input type="file" name="image[]"
                                                                    class="form-control mt-2 image_input" />
                                                                <small class="text-muted">Please choose an image to
                                                                    upload.</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 py-2" style="align-self: center">
                                                            <div class="form-group">
                                                                <label>Bug Title</label>
                                                                <input type="text" name="title_bugs[]"
                                                                    class="form-control title_bugs"
                                                                    style="background-color:#ffffff"
                                                                    placeholder="Put your bug title here...">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Latin Title</label>
                                                                <input type="text" name="latin_title[]"
                                                                    class="form-control latin_title"
                                                                    style="background-color:#ffffff"
                                                                    placeholder="Put your bug latin title here...">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button"
                                                    class="btn btn-danger remove-bug-type">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary" id="addBugTypeBtn">Add Bug Type</button>

                            <div id="bugTypeSectionContainer">
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-success" type="submit"><i
                                            class="bi bi-save mx-1"></i>Submit</button>
                                    <a href="/admin/bug" class="btn btn-info text-white"><i
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
    const fileInput2 = document.getElementById('file_input2');
    const imageDisplay2 = document.getElementById('image_display2');

    fileInput2.addEventListener('change', function() {
        if (fileInput2.files.length > 0) {
            const reader2 = new FileReader();
            reader2.onload = function(e) {
                imageDisplay2.src = e.target.result;
            };
            reader2.readAsDataURL(fileInput2.files[0]);
        }
    });
</script>

<script>
    @foreach(['ekosistem', 'ekosistem_eng', 'penanggulangan', 'penanggulangan_eng'] as $fieldName)
        ClassicEditor
            .create(document.querySelector('#editor{{$loop->iteration}}'))
            .then(editor => {
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('addBugTypeBtn').addEventListener('click', function() {
        const bugTypeSectionTemplate = document.getElementById('bugTypeSectionTemplate');
        const clonedBugTypeSection = bugTypeSectionTemplate.cloneNode(true);
        clonedBugTypeSection.removeAttribute('id');

        const imageInput = clonedBugTypeSection.querySelector('.image_input');
        const imageDisplay = clonedBugTypeSection.querySelector('.image_display');
        const titleInput = clonedBugTypeSection.querySelector('.title_bugs');
        const latinTitleInput = clonedBugTypeSection.querySelector('.latin_title');
        imageInput.value = '';
        imageDisplay.src = '{{asset('admin-assets/img/no-photo.png')}}';
        titleInput.value = '';
        latinTitleInput.value = '';

        const bugTypeSectionContainer = document.getElementById('bugTypeSectionContainer');
        bugTypeSectionContainer.appendChild(clonedBugTypeSection);

        clonedBugTypeSection.style.display = 'block';

        imageInput.addEventListener('change', function() {
            if (imageInput.files.length > 0) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imageDisplay.src = e.target.result;
                };
                reader.readAsDataURL(imageInput.files[0]);
            }
        });

        const removeButton = clonedBugTypeSection.querySelector('.remove-bug-type');
        removeButton.addEventListener('click', function() {
            clonedBugTypeSection.remove();
        });
    });
});

</script>

@endsection