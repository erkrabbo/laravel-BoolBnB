@extends('layouts.app')

@section('content')
<div class="my_houses">
    <h1 class="text-center my-4">Messaggi ricevuti</h1>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                @foreach ($messages as $message)
                    <h4>Messaggio inviato da: <a href="mailto:{{ $message->sender_mail }}">{{ $message->sender_mail }}</a></h4>
                    <h5>Nome: {{ $message->name }} {{ $message->surname }}</h5>
                    <p>{{ $message->content }}</p>
                        <form action="{{ route('messages.destroy', $message->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            <button class="btn btn-danger text-white">Elimina</button>
                        </form>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection