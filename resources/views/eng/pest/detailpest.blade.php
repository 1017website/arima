@extends('layouts.master_eng')

@section('content')

<div class="bg-stay bg-stay2"
    style="height: 40%; min-height: 30%; background-image: url('{{ env('APP_URL') . $bug->header_image }}'); background-size: cover;">
</div>
<div class="pt-3">
    <div class="container">
        <div class="row py-3 px-4">
            <div class="col-sm-12">
                <h2 class="fw-bold text-left py-4">{{ $bug->title_eng }}</h2>
                <h4 class="fw-bold text-left py-2">Ecosystem / living place</h4>
                <div>
                    {!! $bug->ekosistem_eng !!}
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 content-mobile"
        style="background-color: #ec1e22; color: white;height:150px;align-content: center;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 py-auto">
                    <h5 class="fw-bold text-center py-2">Fun Fact:</h5>
                    <h5 class="fw-bold text-center py-2">{{$bug->funfact_eng}}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row py-3 px-4">
            <div class="col-sm-12">
                <h4 class="fw-bold text-left py-4">Countermeasures</h4>
                <div>
                    {!! $bug->penanggulangan_eng !!}
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row py-3 px-4">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            {{-- For bug types --}}
                            @foreach($bug->detailBugs as $bugType)
                            <div class="col-sm-4 mx-auto" style="align-content: center;">
                                <!-- Update link here -->
                                <div style="text-align: center;">
                                    <img class="p-4 mx-auto px-auto" style="width:300px;height:300px;object-fit:cover"
                                        src="{{ env('APP_URL') . $bugType->image }}">
                                </div>
                                <p class="text-center" style="margin-bottom: -3px;font-weight: 600;">
                                    {{$bugType->title_bugs}}</p>
                                @if($bugType->latin_title != '-')
                                <p class="text-center" style="font-style: italic">{{$bugType->latin_title}}</p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12" style="align-content: center;">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12 py-auto">
                                    <h5 class="fw-bold text-center py-2">Consultation :</h5>
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
                                <a class="fw-bold" href="\generalpest_eng" style="color: #343a40!important;">General
                                    Pest</a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 pt-3 pb-3">
                            <div class="m-auto p-auto text-center"
                                style="background:white;max-width:260px;height:50px;border-radius:40px;align-content: center;">
                                <a class="fw-bold" href="\termitebaiting_eng" style="color: #343a40!important;">Termite
                                    Baiting</a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 pt-3 pb-3">
                            <div class="m-auto p-auto text-center"
                                style="background:white;max-width:260px;height:50px;border-radius:40px;align-content: center;">
                                <a class="fw-bold" href="\fumigation_eng"
                                    style="color: #343a40!important;">Fumigation</a>
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
                                <a class="fw-bold" href="\commercial_eng" style="color: #343a40!important;">Commercial
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-3 pt-3">
                            <div class="m-auto p-auto text-center unique-button"
                                style="max-width:260px;height:50px;border-radius:40px;align-content: center;">
                                <a class="fw-bold" href="\residential_eng" style="color: #343a40!important;">Residential
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-3 pt-3">
                            <div class="m-auto p-auto text-center unique-button"
                                style="max-width:260px;height:50px;border-radius:40px;align-content: center;">
                                <a class="fw-bold" href="\factory_eng" style="color: #343a40!important;">Factory
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-3 pt-3">
                            <div class="m-auto p-auto text-center unique-button"
                                style="max-width:260px;height:50px;border-radius:40px;align-content: center;">
                                <a class="fw-bold" href="\disinfection_eng"
                                    style="color: #343a40!important;">Disinfection
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