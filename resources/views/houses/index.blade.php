@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
        @foreach ($houses as $house)
            <div class="col">
                <div class="card">
                    <p>{{ $house->Title }}</p>
                    <p>{{ $house->Night_price }}</p>
                    <p>{{ $house->Address }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
