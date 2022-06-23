{{-- aggiungere sponsorizzazione --}}
{{-- aggiungere link alle views? --}}
@extends('layouts.app')

{{-- @section('pageTitle', $house->Title) --}}

@section('content')
    <main>
        <div class="container">

            @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
            <div class="row">
                <div class="col">
                    <h1 class="bold pt-2">{{ $house->Title }}</h1>
                    <h6 class="text-secondary pt-2 text-uppercase">{{ $house->Address }}</h6>
                    <div class="house-img d-flex align-items-stretch w-100 h-50 py-3">
                        <img class="img-rounded w-50 py-1" src="{{ Storage::exists($house->Poster) ? asset('storage/' . $house->Poster) : $house->Poster }}" alt="{{ $house->Title }}">
                        <div class="side-imgs d-flex flex-wrap w-50">
                            @foreach ($house_images as $house_image)
                                <img class="img-rounded w-50 h-50 p-1" src="{{ Storage::exists($house_image->path) ? asset('storage/' . $house_image->path) : $house_image->path }}" alt="{{ $house->Title }}">
                            @endforeach
                        </div>
                    </div>
                    <div class="d-flex mt-3">
                        <div class="w-50">
                            <h4 class="lighter py-3 ps-1">Proprietario: <span class="fw-bold">{{ $user->name }}</span></h4>
                            <div class="py-3 content ">
                                <h4 class="section_title ps-1">Descrizione:</h4>
                                <p class="ps-1">{{ $house->Content }}</p>
                            </div>
                            <div class="pt-3 pb-2">
                                <h4 class="section_title ps-1">Servizi inclusi:</h4>
                                <div class="services d-flex flex-wrap">
                                    @foreach($services as $service)
                                        <div class="li_service p-2 d-flex flex-wrap justify-content-center align-items-center">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fa-solid {{ $service->icon }}"></i>
                                                <h6 class="mt-2">{{ ucfirst($service->name) }}</h6>
                                                {{-- {{$loop->last ? '.' : ','}} --}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="content pt-3">
                                    <h4 class="section_title ps-1">Prezzo:</h4>
                                    @if($house->Night_price < 1000)
                                        <h4 class="ps-1">{{$house->Night_price}} € <span class="text-secondary"> / notte</span></h4>
                                    @else
                                        <h4 class="ps-1">{{round($house->Night_price / 1000)}} € <span class="text-secondary"> / notte</span></h4>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="book_form w-50 mx-4 py-3">

                            <div class="d-flex justify-content-center">
                                <form action="">
                                    <h2 class="text-center text-uppercase pb-4 pt-3">Contatta l'host</h2>
                                    <div class="pt-3">
                                        <label class="form-label w-100 text-center text-uppercase text-bolder" for="">Inserisci il tuo nome</label>
                                        <input class="form-control w-100" type="text" name="name">
                                    </div>
                                    <div class="pt-3">
                                        <label class="form-label w-100 text-center text-uppercase text-bolder" for="">Inserisci la tua email</label>
                                        <input class="form-control w-100" type="text" name="email">
                                    </div>
                                    <div class="pt-3">
                                        <label class="form-label w-100 text-center text-uppercase text-bolder" for="">Messaggio</label>
                                        <input class="form-control w-100 h-50" type="text" name="message">
                                    </div>
                                </form>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button class="mod_btn btn_pink w-50 mt-4" href="#"><span class="text-white text-uppercase">Invia</span></button>
                            </div>
                            <div class="d-flex justify-content-center">
                                <h6 class="text-secondary py-3">Verrai ricontattato al più presto</h6>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 py-3">
                        <h2 class="section_title">Dove ti troverai</h2>
                    </div>
                    @auth
                        @if(Auth::User()->id === $house->user_id)
                            <a class="btn btn-primary mt-4 mb-2" href="{{ route('houses.edit', $house->id) }}"><span class="text-white">Modifica l'inserzione</span></a>
                        @endif
                    @endauth

                    {{-- <a class="btn btn-primary mt-4 mb-2" href="{{ route('houses.create', $house->id) }}"><span class="text-white">Crea una nuova casa</span></a> --}}
                </div>
            </div>
        </div>

    </main>
@endsection
