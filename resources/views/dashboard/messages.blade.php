@extends('layouts.app')

@section('content')
<main>
    <div class="mt-4 ms-4 btn_back">
        <a class="mod_btn btn_grey_border" href="{{ url()->previous()}}"><i class="fa-solid fa-arrow-left"></i> Torna indietro</a>
    </div>
    <h1 class="text-center mb-5">Messaggi ricevuti</h1>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                @foreach ($messages as $message)
                    <div class="mb-3 card_grey p-3 overflow">
                        <h4>Messaggio inviato da: <a href="mailto:{{ $message->sender_mail }}">{{ $message->sender_mail }}</a></h4>
                        <h5 class="mb-3">Nome: {{ $message->name }} {{ $message->surname }}</h5>
                        <p class="mb-0">{{ $message->content }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection