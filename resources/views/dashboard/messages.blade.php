@extends('layouts.app')

@section('content')
<div class="container flow">
    <div class="row">
        <div class="col-8 offset-2">
            @foreach ($messages as $message)
                <p>{{ $message->content }}</p>
            @endforeach
        </div>
    </div>
</div>
@endsection