@extends('layouts.admin')

@section('content')

@section('breadcrumb')
Bug / Detail / {{$bug->id}}
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
                            <h4 class="card-title">Detail Bug {{$bug->id}}</h4>
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
                                        <label for="exampleFormControlSelect1">Types of Bug</label>
                                        <select class="form-control @error('types') is-invalid @enderror" id="exampleFormControlSelect1" name="types" disabled>
                                            <option selected disabled hidden>Select the types of bug</option>
                                            <option value="0" {{ $bug->types == 0 ? 'selected' : '' }}>Types of insect pests</option>
                                            <option value="1" {{ $bug->types == 1 ? 'selected' : '' }}>Other types of pests</option>
                                        </select>
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
                                            placeholder="{{$bug->title}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title (English Version)</label>
                                        <input type="text" id="title_eng" name="title_eng"
                                            class="form-control @error('title') is-invalid @enderror"
                                            placeholder="{{$bug->title_eng}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="color:black">Icon</label>
                                        <div class="grid grid-cols-6">
                                            <img id="image_display" class="object-cover"
                                                style="width:13rem;height:13rem;object-fit:cover"
                                                src="{{asset($bug->icon)}}" alt="image description">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label style="color:black">Header Image</label>
                                        <div class="grid grid-cols-6">
                                            <img id="image_display" class="object-cover"
                                                style="width:20rem;height:13rem;object-fit:cover"
                                                src="{{asset($bug->header_image)}}" alt="image description">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Ekosistem (IDN Version)</label>
                                        <div style="text-align: justify">
                                            <div class="form-control" style="text-align: justify" disabled>{!!
                                                $bug->ekosistem !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Ekosistem (ENG Version)</label>
                                        <div style="text-align: justify">
                                            <div class="form-control" style="text-align: justify" disabled>{!!
                                                $bug->ekosistem_eng !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Fun Fact</label>
                                        <div style="text-align: justify">
                                            <div class="form-control" style="text-align: justify" disabled>{!!
                                                $bug->funfact !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Fun Fact (English Version)</label>
                                        <div style="text-align: justify">
                                            <div class="form-control" style="text-align: justify" disabled>{!!
                                                $bug->funfact_eng !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Penanggulangan (IDN Version)</label>
                                        <div style="text-align: justify">
                                            <div class="form-control" style="text-align: justify" disabled>{!!
                                                $bug->penanggulangan !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Penanggulangan (ENG Version)</label>
                                        <div style="text-align: justify">
                                            <div class="form-control" style="text-align: justify" disabled>{!!
                                                $bug->penanggulangan_eng !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Bug Types</label>
                                    <div class="row">
                                        <div class="col-sm-12 py-2" style="background:#e3e3e3;border-radius:10px">
                                            @if($bugTypes->isEmpty())
                                            <div class="btn btn-primary fw-bold">There's no bug type yet.</div>
                                            @else
                                            <div class="row">
                                                @foreach($bugTypes as $key => $value)
                                                <div class="col-sm-3">
                                                    <div class="col-sm-12 py-2">
                                                        @if($value->image)
                                                        <img class="object-contain items-center"
                                                            style="width:10rem;height:10rem;object-fit:cover"
                                                            src="{{asset($value->image)}}">
                                                        @else
                                                        <img class="object-contain items-center"
                                                            style="width:10rem;height:10rem;object-fit:cover"
                                                            src="{{ asset('admin-assets/img/no-photo.png') }}">
                                                        @endif
                                                    </div>
                                                    <div class="col-sm-12 py-2" style="align-self: center">
                                                        <h6>{{$value->title_bugs}}</h6>
                                                        <p style="font-style: italic">{{$value->latin_title}}</p>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('admin.bug.edit', $bug->id) }}" class="btn btn-primary text-white"
                                        type="submit"><i class="bi bi-pencil mx-1"></i>Edit</a>
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

@endsection