{{-- aggiungere sponsorizzazione --}}
{{-- aggiungere link alle views? --}}
@extends('layouts.app')

{{-- @section('pageTitle', $house->Title) --}}

@section('content')
    <main>

        <div class="container show">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
            {{-- @if (session('deleted'))
                <div class="alert alert-warning">{{ session('deleted') }}</div>
            @endif --}}
            <div class="row">
                <div class="col">

                    <div class="d-flex justify-content-between">

                            <h1 class="bold pt-2">{{ $house->Title }}</h1>

                            @auth
                                @if(Auth::User()->id === $house->user_id)
                                    <a class="text-decoration-none mod_btn btn_grey_border mt-4 mb-2" href="{{ route('houses.edit', $house->id) }}">Modifica l'inserzione</a>
                                @endif
                            @endauth

                    </div>

                    <h6 class="text-secondary pt-2 text-uppercase">{{ $house->Address }}</h6>
                    <div class="house-img d-flex align-items-stretch w-100 h-50 py-3">
                        <img class="img-rounded w-50 py-1" src="{{ Storage::exists($house->Poster) ? asset('storage/' . $house->Poster) : $house->Poster }}" alt="{{ $house->Title }}">
                        <div class="side-imgs d-flex flex-wrap w-50">
                            @foreach ($house_images as $house_image)
                                <img class="img-rounded w-50 h-50 p-1" src="{{ Storage::exists($house_image->path) ? asset('storage/' . $house_image->path) : $house_image->path }}" alt="{{ $house->Title }}">
                            @endforeach
                        </div>
                    </div>

                    {{-- container di info e contatta --}}
                    <div class="d-flex mt-3 row row-cols-1 row-cols-md-2">

                        {{-- sezione info --}}
                        <div class="infos col ps-1">
                            <h4 class="lighter py-1">Proprietario: <span class="fw-bold">{{ $user->name }}</span></h4>
                            <span class="pb-3"><i class="fa-solid fa-users"></i> Massimo {{$house->N_of_beds }} ospiti | {{ $house->N_of_rooms }} Camere | {{ $house->N_of_baths }} Bagni</span>
                            <div class="py-3 content ">
                                <h4 class="section_title">Descrizione:</h4>
                                <p class="ps-1">{{ $house->Content }}</p>
                            </div>
                            <div class="pt-3 pb-2">
                                <h4 class="section_title">Servizi inclusi:</h4>
                                <div class="pb-3 d-flex services row g-2 row-cols-3 row-cols-lg-4">
                                    @foreach($services as $service)
                                        <div class="li_service d-flex">
                                            <div class="col col_service">
                                                <div class="service_container d-flex flex-column align-items-center">
                                                    <i class="fa-solid {{ $service->icon }}"></i>
                                                    <h6 class="mt-2 text-center">{{ ucfirst($service->name) }}</h6>
                                                    {{-- {{$loop->last ? '.' : ','}} --}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="content py-3">
                                    <h4 class="section_title">Prezzo:</h4>
                                    @if($house->Night_price < 1000)
                                        <h4 class="ps-1">{{$house->Night_price}} € <span class="text-secondary"> / notte</span></h4>
                                    @else
                                        <h4 class="ps-1">{{round($house->Night_price / 1000)}} € <span class="text-secondary"> / notte</span></h4>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- sezione contatta nascosto in phone
                            d-none d-sm-block
                            --}}
                        <div class="book_container col">
                            <div class="book_form ms-5 py-3 d-none d-sm-block">

                                <div class="d-flex justify-content-center">
                                    <form action="">
                                        <h2 class="text-center text-uppercase pb-4 pt-3 section_title">Contatta l'host</h2>
                                        <div class="pt-3">
                                            <label class="form-label w-100 text-center text-uppercase text-bolder" for="">Inserisci il tuo nome</label>
                                            <input class="form-control form_textbox w-100" type="text" name="name">
                                        </div>
                                        <div class="pt-3">
                                            <label class="form-label w-100 text-center text-uppercase text-bolder" for="">Inserisci la tua email</label>
                                            <input class="form-control form_textbox w-100" type="text" name="email">
                                        </div>
                                        <div class="pt-3">
                                            <label class="form-label w-100 text-center text-uppercase text-bolder" for="">Messaggio</label>
                                            <input class="form-control form_textbox w-100 h-50" type="text" name="message">
                                        </div>
                                    </form>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button class="mod_btn btn_pink w-50 mt-4" href="#"><span class="text-white text-uppercase">Invia</span></button>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <h6 class="text-secondary py-3 fw-bold">Verrai ricontattato al più presto</h6>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="mt-5 py-3">
                        <h2 class="section_title">Dove ti troverai</h2>

                        <div class="map">
                            <span>mappa?</span>
                        </div>

                        <span class="pt-2"><i class="fa-solid fa-location-dot"></i> Ti troverai in <span class="fw-bold">{{ $house->Address }}</span></span>

                    </div>
                    <a class="btn btn-primary text-white" href="{{ route('houses.messages') }}">Invia un messaggio</a>
                    @auth
                        @if(Auth::User()->id === $house->user_id)
                            <a class="btn btn-primary mt-4 mb-2" href="{{ route('houses.edit', $house->id) }}"><span class="text-white">Modifica l'inserzione</span></a>
                        @endif
                    @endauth

                    {{-- <a class="btn btn-primary mt-4 mb-2" href="{{ route('houses.create', $house->id) }}"><span class="text-white">Crea una nuova casa</span></a> --}}
                </div>
            </div>

            {{-- visibile solo su telefono
                d-block d-sm-none
                --}}
            <div class="contact_phone be_sticky maledetto row d-block d-sm-none">
                <div class="d-flex justify-content-center phone_button_container col-sm-12">
                    <button class="mod_btn btn_pink_border my-4" href="{{ route('houses.messages') }}"><span class="text-uppercase">contatta l'host</span></button>
                    {{-- <span class="text-secondary text-center py-3 fw-bold inline-block">Verrai ricontattato al più presto</span> --}}
                </div>
            </div>
        </div>

    </main>
@endsection
