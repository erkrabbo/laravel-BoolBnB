@extends('layouts.app')

@section('content')
   <main class="h-100 spons-main">
    <div class="container sponsorization">
        <div class="cards mt-4 row row-cols-1 row-cols-md-2 row-cols-lg-3">
            @foreach($sponsorizations as $sponsorization)
            <div class="col">
                <a href="{{ "/admin/houses/braintree?id=" . $sponsorization->id . '&house=' . request()->id }}">
                    <div class="d-flex justify-content-center">
                        <div class="sponsor-card py-5 my-2 flip-card">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <div class="sponsor p-3 mt-2">
                                        <h2 class="text-black text-uppercase">Nome Promozione:</h2>
                                        <h4 class="text-info text-uppercase">{{ $sponsorization->name }}</h4>
                                    </div>
                                    <div class="sponsor p-3 mt-2">
                                        <h2 class="text-black text-uppercase">Prezzo:</h2>
                                        <h4 class="text-info text-uppercase">{{ $sponsorization->price / 100 }} €</h4>
                                    </div>
                                    <div class="sponsor p-3 mt-2">
                                        <h2 class="text-black text-uppercase">Durata:</h2>
                                        <h4 class="text-info text-uppercase">{{ $sponsorization->duration }} ore</h4>
                                    </div>
                                </div>
                                <div class="flip-card-back">
                                    <p>Le promozioni di BoolBnb ti permettono di sponsorizzare la tua casa e metterla in primo piano nella pagina principale. <br> La durata della promozione varia a seconda dell'offerta.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
   </main>
@endsection
