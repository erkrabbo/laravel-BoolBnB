{{-- aggiungere sponsorizzazione --}}
{{-- aggiungere link alle views? --}}
@extends('layouts.app')

{{-- @section('pageTitle', $house->Title) --}}

@section('content')
    <main>
        <div class="container">
            {{-- @if (session('deleted'))
                <div class="alert alert-warning">{{ session('deleted') }}</div>
            @endif --}}
            <div class="row">
                <div class="col">    
                    <h1 class="bold pt-2 text-uppercase">{{ $house->Title }}</h1>
                    <h6 class="text-secondary pt-2 text-uppercase">{{ $house->Address }}</h6>
                    <div class="house-img d-flex align-items-stretch w-100 h-50 py-5">
                        <img class="img-rounded w-50 py-1" src="{{ Storage::exists($house->Poster) ? asset('storage/' . $house->Poster) : $house->Poster }}" alt="{{ $house->Title }}">
                        <div class="side-imgs d-flex flex-wrap w-50">
                            @foreach ($house_images as $house_image)
                                <img class="img-rounded w-50 h-50 p-1" src="{{ $house_image->path }}" alt="{{ $house->Title }}">
                            @endforeach
                        </div>
                    </div>
                    <div class="d-flex mt-3">
                        <div class="w-50">
                            <h4 class="lighter py-3 ps-1">Proprietario: {{ $user->name }}</h4>
                            <div class="py-3 content ">
                                <h4 class="bold ps-1">Descrizione:</h4>
                                <p class="ps-1">{{ $house->Content }}</p>
                            </div>
                            <div class="pt-3">
                                <h4 class="bold ps-1">Servizi inclusi:</h4>
                                <div class="d-flex flex-wrap services">
                                    @foreach($services as $service)
                                        <h6 class="ps-1">{{ ucfirst($service->name) }}</h6> 
                                        {{$loop->last ? '.' : ','}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="book_form w-50 mx-4 py-3">
                            <div class="price d-flex justify-content-center">
                                @if($house->Night_price < 1000)
                                <h2>{{$house->Night_price}} € <span class="text-secondary"> / notte</span></h2>
                                @else
                                <h2>{{round($house->Night_price / 1000)}} € <span class="text-secondary"> / notte</span></h2>
                                @endif
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
                            <a class="btn btn-primary mt-4 mb-2" href="{{ route('houses.edit', $house->id) }}"><span class="text-white">Modifica l'inserzione</span></a>
                        @endif
                    @endauth
                    
                    <a class="btn btn-primary mt-4 mb-2" href="{{ route('houses.create', $house->id) }}"><span class="text-white">Crea una nuova casa</span></a>
                   
                    
                    {{-- @if (Auth::user()->id === $house->user_id)
                        <button data-id="{{ $house->id }}"  class="mt-4 mb-2 btn btn-danger btn-delete">Delete</button>
                    @endif --}}

                    {{-- <section id="confirmation-overlay" class="overlay d-none">
                        <div class="popup">
                            <h1>Sei sicuro di voler eliminare?</h1>
                            <div class="d-flex justify-content-center">
                                <button id="btn-no" class="btn btn-primary me-3">NO</button>
                                <form method="POST" data-base="{{ route('houses.destroy', '*****') }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">SI</button>
                                </form>
                            </div>
                        </div>
                    </section> --}}
                </div>
            </div>
            {{-- aggiungere form per messaggio per contattare l'host --}}
        </div>

    </main>
@endsection
