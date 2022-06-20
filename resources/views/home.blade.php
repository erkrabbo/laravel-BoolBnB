@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
        {{-- @dd($sponsoredHouses) --}}
        @foreach ($sponsoredHouses as $house)
        <div class="col">
            <div class="card">
                <div class="card-header text-center">{{ $house->Title }}</div>

                <div class="card-body text-center">
                    <img class="img-fluid" src="{{ Storage::exists($house->Poster) ? asset('storage/' . $house->Poster) : $house->Poster }}" alt="">
                    <a class = "stretched-link" href={{"/houses/$house->id"}}></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <h1 class="col-12">RECENTI</h1>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
    @foreach ($houses as $house)
    <div class="col">
        <div class="card">
            <div class="card-header text-center">{{ $house->Title }}</div>

            <div class="card-body text-center">

                <img class="img-fluid" src="{{ Storage::exists($house->Poster) ? asset('storage/' . $house->Poster) : $house->Poster }}" alt="">
                
                <a class = "stretched-link" href={{"/houses/$house->id"}}></a>
            </div>
        </div>
    </div>
    @endforeach
    </div>
</div>
@endsection
