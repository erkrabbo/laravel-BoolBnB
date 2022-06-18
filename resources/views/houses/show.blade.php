{{-- aggiungere sponsorizzazione --}}
{{-- aggiungere link alle views? --}}
@extends('layouts.app')

{{-- @section('pageTitle', $house->Title) --}}

@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="bold pt-2 text-uppercase">{{ $house->Title }}</h1>
                    <h6 class="text-secondary pt-2 text-lowercase">{{ $house->Address }}</h6>
                    
                    
                    <div class="house-img d-flex align-items-stretch w-100 h-75 py-5">
                        <img class="img-rounded w-50 py-1" src="{{ $house->Poster }}" alt="{{ $house->Title }}">
                        <div class="side-imgs d-flex flex-wrap w-50">
                            @foreach ($house_images as $house_image)
                                <img class="img-rounded w-50 h-50 p-1" src="{{ $house_image->path }}" alt="{{ $house->Title }}">
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="d-flex mt-3">
                        <div class="w-50">
                            <h4 class="lighter py-3">Proprietario: {{ $user->name }}</h4>
                            <div class="py-3 content ">
                                <h4 class="bold">Descrizione:</h4>
                                <p>{{ $house->Content }}</p>
                            </div>
                            <div class="pt-3">
                                <h4 class="bold">Servizi inclusi:</h4>
                                <div class="d-flex flex-wrap services">
                                    @foreach($services as $service)
                                        <h6>{{ $service->name }}</h6> 
                                        {{$loop->last ? '.' : ','}}
                                    @endforeach
                                {{-- pensare se aggiungere tutti i servizi e implementare la logica per cui
                                se i servizi non sono inclusi nella casa sbarrarli --}}
                                </div>
                            </div>
                        </div>

                        <div class="book_form w-50 mx-4 py-3">
                            <div class="price d-flex justify-content-center">
                                <h2>{{round($house->Night_price / 1000)}} € <span class="text-secondary"> / notte</span></h2>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="book_date_guest w-75 h-50">
                                    <div class="dates d-flex px-1">
                                        <div class="w-100 d-flex">
                                            <input class="w-50 h-100 pb-3 pt-3 check-input check-in" type="text" placeholder="Check-in">
                                            <input class="w-50 h-100 pb-3 pt-3 check-input check-out" type="text" placeholder="Check-out">
                                        </div>
                                    </div>
                                    <div class="guests">
                                        <input class="pb-4 pt-1 px-2 w-100 guest" type="number" placeholder="Ospiti">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button class="book-btn w-50 btn btn-danger mt-4" href="#"><span class="text-white text-uppercase">Prenota</span></button>
                            </div>
                            <div class="d-flex justify-content-center">
                                <h6 class="text-secondary py-3">Non riceverai alcun addebito in questa fase</h6>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 py-3">
                        <h2>Dove ti troverai</h2>
                    </div>
                    @auth
                        @if(Auth::User()->id === $house->user_id)
                            <a class="btn btn-primary mt-4" href="{{ route('houses.edit', $house->id) }}"><span class="text-white">Modifica l'inserzione</span></a>
                        @endif
                    @endauth
                    {{-- <a class="btn btn-primary mt-4" href="{{ route('houses.destroy') }}"><span class="text-white">Elimina l'inserzione</span></a> --}}

                </div>
            </div>
            {{-- aggiungere form per messaggio per contattare l'host --}}
        </div>

    </main>
@endsection
