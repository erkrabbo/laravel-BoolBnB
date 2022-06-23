{{-- filtro per vedere solo le case sponsorizzate o non? --}}
@extends('layouts.app')

@section('content')

<h1 class="text-center my-5 text-uppercase">Le mie case</h1>

<table class="table table-hover mt-5">
    <thead>
        <tr>
        <th class="text-center" scope="col">Titolo</th>
        {{-- <th class="text-center" scope="col">Descrizione</th> --}}
        <th class="text-center" scope="col">Servizi</th>
        <th class="text-center" scope="col">Sponsorizza la casa</th>
        <th class="text-center" scope="col">Disponibile da</th>
        <th class="text-center" scope="col">Disponibile fino a</th>
        <th class="text-center" scope="col">Indirizzo</th>
        <th class="text-center" scope="col" colspan="3">Azioni</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($houses as $house)
            <tr>
                <td class="text-center">{{ $house->Title }}</td>
                {{-- <td class="text-center">{{ $house->Content }}</td> --}}
                <td class="text-center" >{{ $house->services->pluck('name')->join(', ') }}</td>
                <td class="text-center" >
                    <a class="btn btn-primary text-white" href="{{ route('houses.sponsorization', [
                        'id' => $house->id
                    ]) }}">Sponsorizza</a>
                </td>
                <td class="text-center">{{ date('d/m/Y', strtotime($house->Available_from)) }}</td>
                <td class="text-center">{{ date('d/m/Y', strtotime($house->Available_to)) }}</td>
                <td class="text-center">{{ $house->Address }}</td>
                <td>
                    <a class="btn btn-primary text-white" href="{{ route('houses.show', $house->id) }}">Guarda</a>
                </td>
                <td>
                    @if(Auth::User()->id === $house->user_id)
                        <a class="btn btn-secondary text-white" href="{{ route('houses.edit', $house->id) }}">Modifica l'inserzione</a>
                    @endif
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger text-white ms-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Elimina
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Elimina casa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                <div class="modal-body">
                                    <h3>Sei sicuro di voler eliminare? Questa azione è irreversibile</h3>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">No</button>
                                    @if (Auth::user()->id === $house->user_id)
                                    <form action="{{ route('houses.destroy', $house->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        <button class="btn btn-danger text-white">Elimina</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection