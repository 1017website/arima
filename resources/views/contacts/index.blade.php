@extends('layouts.master')

@section('content')

<div style="height: 40%; min-height: 30%; background-image: url('assets/img/contact.jpg'); background-size: cover;">
</div>
<div class="pt-3">
    <div class="container">
        <div class="row py-3 px-4">
            <div class="col-sm-12">
                <h2 class="fw-bold text-left py-4">Contact Us</h2>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row py-3 px-4">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                            <div class="col-lg-12">
                                <div class="row" style="place-content: center">
                                    @if(session('success'))
                                    <div class="alert alert-success m-2"
                                        style="color:white;font-weight:bold;background:#31a72b!important">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                    @if(session('error'))
                                    <div class="alert alert-danger m-2"
                                        style="color:white;background:#cd2a2a;font-weight:bold">
                                        {{ session('error') }}
                                    </div>
                                    @endif
                                    <form method="POST" class="row g-3" action="{{ route('store-contact')}}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="name" name="name" type="text"
                                                    placeholder="Enter your name..." data-sb-validations="required"
                                                    required
                                                    style="border-radius: 20px;
                                                    height: 50px;
                                                    background: linear-gradient(180deg, #f0f0f0, #fcfcfc);
                                                    border-style: ridge;box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);" />
                                                <label for="name" style="color:#7d7b7c">Your Name</label>
                                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is
                                                    required.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="email" id="email" type="email"
                                                    placeholder="(123) 456-7890" data-sb-validations="required" required
                                                    style="border-radius: 20px;
                                                    height: 50px;
                                                    background: linear-gradient(180deg, #f0f0f0, #fcfcfc);
                                                    border-style: ridge;box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);" />
                                                <label for="email" style="color:#7d7b7c">Your Email</label>
                                                <div class="invalid-feedback" data-sb-feedback="email:required">An email
                                                    is required.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3 ml-2">
                                            <textarea class="form-control" name="message" id="message" type="text"
                                                placeholder="Enter your message here..." style="border-radius: 20px;
                                                height: 100px;max-width: 500px;
                                                background: linear-gradient(180deg, #f0f0f0, #fcfcfc);
                                                border-style: ridge;box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);"
                                                data-sb-validations="required" required></textarea>
                                            <label for="message" style="color:#7d7b7c">Message to us ...</label>
                                            <div class="invalid-feedback" data-sb-feedback="message:required">A message
                                                is
                                                required.
                                            </div>
                                        </div>
                                        <div class="col-12 d-grid" style="justify-content: right;">
                                            <button class="btn text-white py-1 btn-test" type="submit"
                                                style="width:100px;background-color:#cd2a2a;border-radius:10px"><span>Submit</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <iframe data-aos="fade-up" data-aos-duration="1000" src="{{$information->google_map}}"
                            width="100%" height="400" style="border:0; max-width: 100%; height: 500;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                <a class="fw-bold" href="\factory" style="color: #343a40!important;">Factory
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