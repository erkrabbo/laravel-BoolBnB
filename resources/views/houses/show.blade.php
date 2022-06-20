{{-- aggiungere sponsorizzazione --}}
{{-- aggiungere link alle views? --}}
@extends('layouts.app')

{{-- @section('pageTitle', $house->Title) --}}

@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="pt-2 text-uppercase">{{ $house->Title }}</h1>
                    <h6 class="pt-2 text-lowercase">{{ $house->Address }}</h6>
                    <h4 class="pt-2">Proprietario: {{ $user->name }}</h4>
                    <div class="house-img">
                        <img src="{{ asset('storage/' . $house->Poster) }}" alt="{{ $house->Title }}">
                        @foreach ($house_images as $house_image)
                            <img class="pb-2" src="{{ $house_image->path }}" alt="{{ $house->Title }}">
                        @endforeach
                    </div>
                    <h4 class="pt-2">Descrizione:</h4>
                    <p>{{ $house->Content }}</p>
                    @auth
                        @if(Auth::User()->id === $house->user_id)
                            <a class="btn btn-primary mt-4" href="{{ route('houses.edit', $house->id) }}"><span class="text-white">Modifica l'inserzione</span></a>
                        @endif
                    @endauth
                    {{-- <a class="btn btn-primary mt-4" href="{{ route('houses.destroy') }}"><span class="text-white">Elimina l'inserzione</span></a> --}}

                </div>
            </div>
        </div>

    </main>
@endsection
