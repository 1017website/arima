@extends('layouts.master')

@section('content')
<div style="margin-top:10rem">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="fw-bold">News</h2>
            </div>
        </div>
    </div>
</div>

<div class="mt-2"
    style="height: auto; min-height: 30rem; background-image: url('{{env('APP_URL')}}{{$information->image}}'); background-size: cover; align-items: center;">
    @php
    $counter = 0;
    $overlayColors = ['overlay-black', 'overlay-white'];
    @endphp

    @foreach($news as $index => $n)
    @if($counter % 3 == 0)
    <div class="{{ $overlayColors[$counter / 3 % 2] }}">
        <div class="container py-5">
            <div class="col-sm-12">
                <div class="row">
                    @endif
                    <div class="col-sm-4" style="text-align: -webkit-center;">
                        <div class="card"
                            style="width: auto;max-width:25rem;border: none;border-radius: 0;background:#e6e6e6">
                            <a href="{{ route('news.show', $n->id) }}" class=card-for-news>
                                <img class="card-img-top"
                                    style="border-top-left-radius:0%!important;border-top-right-radius:0%!important;height:380px;width:100%;object-fit:cover"
                                    src="{{env('APP_URL')}}{{$n->image}}" alt="Card image cap">
                                <div style="background:#ec1e22;height:80px;place-content: center;">
                                    <h5 class="text-white fw-bold text-center py-2 px-5">{{$n->title}}
                                    </h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    @php
                    $counter++;
                    @endphp
                    @if($counter % 3 == 0 || $index == count($news) - 1)
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
<div class="container">
    <div class="col-sm-12">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end pt-4">
                @if ($news->currentPage() > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $news->previousPageUrl() }}" tabindex="-1" style="border:none;">
                        <i class="fa fa-angle-left"></i>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                @else
                <li class="page-item disabled">
                    <a class="page-link" href="javascript:;" tabindex="-1" style="border:none;">
                        <i class="fa fa-angle-left"></i>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                @endif

                @for ($i = 1; $i <= $news->lastPage(); $i++)
                    <li class="page-item {{ $i == $news->currentPage() ? 'active' : '' }}"
                        style="background-color: white !important;border:none">
                        <a class="page-link fw-bold" href="{{ $news->url($i) }}"
                            style="border:none;{{ $i == $news->currentPage() ? 'color:#dc3545!important;background-color: white !important;border:none;' : '' }}">
                            {{ $i }}
                        </a>
                    </li>
                    @endfor

                    @if ($news->currentPage() < $news->lastPage())
                        <li class="page-item">
                            <a class="page-link" href="{{ $news->nextPageUrl() }}" style="border:none;color:#dc3545">
                                <i class="fa fa-angle-right"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                        @else
                        <li class="page-item disabled">
                            <a class="page-link" href="javascript:;" style="border:none;color:#dc3545">
                                <i class="fa fa-angle-right"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                        @endif
            </ul>
        </nav>
    </div>
</div>




<div class="mt-5 pt-5">
    <div class="container">
        <div class="row py-3 px-4">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12" style="align-content: center;">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12 py-auto">
                                    <h5 class="fw-bold text-center py-2">Konsultasi :</h5>
                                    <div class="m-auto p-auto text-center unique-button"
                                        style="width:260px;height:50px;border-radius:40px;align-content: center;">
                                        <img src="{{asset('assets/img/icon_cs.png')}}"
                                            style="margin-right: 10px;width:30px;max-width:40px" />
                                        <a class="fw-bold" style="color: #343a40!important;">{{$information->phone_1}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 content-mobile"
        style="background-color: #ec1e22; color: white;height:150px;align-content: center;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 py-auto">
                    <h5 class="fw-bold text-center py-2">Our Method :</h5>
                    <div class="row">
                        <div class="col-md-4 col-sm-6 pt-3 pb-3">
                            <div class="m-auto p-auto text-center"
                                style="background:white;max-width:260px;height:50px;border-radius:40px;align-content: center;">
                                <a class="fw-bold" href="\generalpest" style="color: #343a40!important;">General
                                    Pest</a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 pt-3 pb-3">
                            <div class="m-auto p-auto text-center"
                                style="background:white;max-width:260px;height:50px;border-radius:40px;align-content: center;">
                                <a class="fw-bold" href="\termitebaiting" style="color: #343a40!important;">Termite
                                    Baiting</a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 pt-3 pb-3">
                            <div class="m-auto p-auto text-center"
                                style="background:white;max-width:260px;height:50px;border-radius:40px;align-content: center;">
                                <a class="fw-bold" href="\fumigation" style="color: #343a40!important;">Fumigation</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 pb-5 content-mobile" style="height:150px;align-content: center;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 py-auto">
                    <h5 class="fw-bold text-center py-2">I Need Service For :</h5>
                    <div class="row">
                        <div class="col-sm-3 pt-3">
                            <div class="m-auto p-auto text-center unique-button"
                                style="max-width:260px;height:50px;border-radius:40px;align-content: center;">
                                <a class="fw-bold" href="\commercial" style="color: #343a40!important;">Commercial
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-3 pt-3">
                            <div class="m-auto p-auto text-center unique-button"
                                style="max-width:260px;height:50px;border-radius:40px;align-content: center;">
                                <a class="fw-bold" href="\residential" style="color: #343a40!important;">Residential
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-3 pt-3">
                            <div class="m-auto p-auto text-center unique-button"
                                style="max-width:260px;height:50px;border-radius:40px;align-content: center;">
                                <a class="fw-bold" href="\industrial" style="color: #343a40!important;">Factory
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-3 pt-3">
                            <div class="m-auto p-auto text-center unique-button"
                                style="max-width:260px;height:50px;border-radius:40px;align-content: center;">
                                <a class="fw-bold" href="\disinfection" style="color: #343a40!important;">Disinfection
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('jquery')

@endsection