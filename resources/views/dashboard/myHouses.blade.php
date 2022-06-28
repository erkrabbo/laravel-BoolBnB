{{-- filtro per vedere solo le case sponsorizzate o non? --}}
@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/validationHouse.js') }}" defer></script>
@endsection

@section('content')

<div class="my_houses">
    <div class="container">
        <h1 class="text-center my-5 text-uppercase">Le mie case</h1>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">

            @foreach ($houses as $house)
                <div class="col">
                    <div class="card h-100 custom-rounded p-2 card_grey d-flex flex-column justify-content-between" ref="card">
                        <div class="mb-2">
                            <h4 class="text-center"><em>Titolo:</em></h4>
                            <h3 class="text-start text-center">{{ $house->Title}}</h3>
                            <h4 class="text-center"><em>Indirizzo:</em></h4>
                            <h3 class="text-start text-center">{{ $house->Address}}</h3>
                        </div>
                        <div>
                            <div class="text-center">
                                <a class="btn text-white bkg-yellow mb-2" href="{{ route('houses.sponsorization', [
                                'id' => $house->id
                                ]) }}">Sponsorizza</a>
                            </div>
                            <div class="d-flex flex-column">
                                <div class="text-center">
                                    <a class="btn btn-danger bkg_red text-white  mb-2" href="{{ route('houses.messages', ['house' => $house]) }}">Messaggi</a>
                                    <a class="btn btn-info text-white mb-2" href="{{ route('houses.views', ['house_id' => $house->id]) }}">Statistiche</a>
                                </div>
    
                                <div class="text-center">
                                    <a class="btn btn-primary text-white mb-2" href="{{ route('houses.show', $house->id) }}">Visualizza</a>
    
                                    @if(Auth::User()->id === $house->user_id)
                                        <a class="btn btn-secondary text-white mb-2" href="{{ route('houses.edit', $house->id) }}">Modifica l'inserzione</a>
                                    @endif
    
                                    <button data-image="{{ $house->id }}" type="button" class="btn_delete_img btn btn-danger text-white mb-2" data-bs-toggle="modal" data-bs-target="#imageModal">Elimina</button>
    
                                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="imageModalLabel">Elimina casa</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h3>Sei sicuro di voler eliminare? <br>
                                                        Questa azione è irreversibile</h3>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-between">
                                                    <button type="button" class="mod_btn btn_grey_border" data-bs-dismiss="modal">Annulla</button>
                                                    <form id="formDelete" action="{{ route('houses.destroy', '*****') }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="mod_btn btn_red">Elimina</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>

@endsection
