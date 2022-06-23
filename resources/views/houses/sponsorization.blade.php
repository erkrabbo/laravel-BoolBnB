@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="cards d-flex justify-content-around mt-4">
                    @foreach($sponsorizations as $sponsorization)
                    <a href="{{ "/admin/houses/braintree?id=" . $sponsorization->id . '&house=' . request()->id }}">
                        <div class="card">
                                <h1>{{ $sponsorization->name }}</h1>
                                <h1>{{ $sponsorization->price }}</h1>
                                <h1>{{ $sponsorization->duration }} ore</h1>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection