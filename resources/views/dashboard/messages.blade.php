@extends('layouts.app')

@section('content')
<main>
    <div class="my_houses">
        <h1 class="text-center my-4">Messaggi ricevuti</h1>
        <div class="container">
            <div class="row">
                <div class="col-6 offset-3">
                    @foreach ($messages as $message)
                        <div class="mb-3 card_grey p-3 overflow">
                            <h4>Messaggio inviato da: <a href="mailto:{{ $message->sender_mail }}">{{ $message->sender_mail }}</a></h4>
                            <h5>Nome: {{ $message->name }} {{ $message->surname }}</h5>
                            <p>{{ $message->content }}</p>
    
                            <button data-image="{{ $message->id }}" type="button" class="btn_delete_img btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#imageModal">Elimina messaggio</button>
    
                            <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="imageModalLabel">Elimina messaggio</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h3 class="text-center">Sei sicuro di voler eliminare? <br>
                                                Questa azione è irreversibile</h3>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-between">
                                            <button type="button" class="mod_btn btn_grey_border" data-bs-dismiss="modal">Annulla</button>
                                            <form id="formDelete" action="{{ route('messages.destroy', '*****') }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="mod_btn btn_red">Elimina</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
@endsection