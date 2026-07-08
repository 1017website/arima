@extends('layouts.master_eng')

@section('content')

<div class="pt-5"
    style="height: auto; min-height: 40rem; background-image: url('{{ env('APP_URL') . $disinfection->background }}'); background-size: cover; align-items: center;">
    <div class="container" style="background-color: rgba(0, 0, 0, 0.8); color: white;margin-top:100px">
        <div class="row py-3 px-4">
            <div class="col-sm-12">
                <h2 class="fw-bold text-left py-4">{{ $disinfection->title }}</h2>
                <p style="text-align: justify">
                    {!! $disinfection->description_eng !!}
                </p>
            </div>
            <div class="col-sm-12">
                <div class="col-sm-12" style="align-content: center;">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 py-auto">
                                <h5 class="fw-bold text-center py-2">Consultation :</h5>
                                <div class="m-auto p-auto text-center"
                                    style="background:white;width:260px;height:50px;border-radius:40px;align-content: center;">
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

    <div class="mt-5 content-mobile" style="background-color: #000; color: white;height:150px;align-content: center;">
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
                <div class="col-md-12 py-auto">
                    <h5 class="fw-bold text-center text-white py-2">I Need Service For :</h5>
                    <div class="row">
                        <div class="col-md-3 col-sm-3 pt-3">
                            <div class="m-auto p-auto text-center"
                                style="background:white;max-width:260px;height:50px;border-radius:40px;align-content: center;">
                                <a class="fw-bold" href="/commercial_eng" style="color: #343a40!important;">Commercial
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 pt-3">
                            <div class="m-auto p-auto text-center"
                                style="background:white;max-width:260px;height:50px;border-radius:40px;align-content: center;">
                                <a class="fw-bold" href="/residential_eng" style="color: #343a40!important;">Residential
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 pt-3">
                            <div class="m-auto p-auto text-center"
                                style="background:white;max-width:260px;height:50px;border-radius:40px;align-content: center;">
                                <a class="fw-bold" href="/industrial_eng" style="color: #343a40!important;">Factory
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 pt-3">
                            <div class="m-auto p-auto text-center"
                                style="background:white;max-width:260px;height:50px;border-radius:40px;align-content: center;">
                                <a class="fw-bold" href="/disinfection_eng"
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