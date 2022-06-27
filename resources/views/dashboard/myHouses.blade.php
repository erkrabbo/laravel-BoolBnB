{{-- filtro per vedere solo le case sponsorizzate o non? --}}
@extends('layouts.app')

@section('content')
<div class="my_houses">
    <div class="container">
        <h1 class="text-center my-5 text-uppercase">Le mie case</h1>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
            @foreach ($houses as $house)
            <div class="col">
                <div class="card h-100 custom-rounded p-2" ref="card">
                    <h4 class="text-center">Titolo:</h4>
                    <h3 class="text-start text-center">{{ $house->Title}}</h3>
                    <h4 class="text-center">Indirizzo:</h4>
                    <h3 class="text-start text-center">{{ $house->Address}}</h3>
                    <div class="text-center">
                        <a class="btn text-white bkg-yellow mb-2" href="{{ route('houses.sponsorization', [
                        'id' => $house->id
                        ]) }}">Sponsorizza</a>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="text-center">
                            <a class="btn btn-danger text-white bkg_red mb-2" href="{{ route('houses.messages', ['house' => $house]) }}">Messaggi</a>
                        </div>
                       
                        <div class="text-center">
                            <a class="btn btn-primary text-white mb-2" href="{{ route('houses.show', $house->id) }}">Visualizza</a>

                            @if(Auth::User()->id === $house->user_id)
                                <a class="btn btn-secondary text-white mb-2" href="{{ route('houses.edit', $house->id) }}">Modifica l'inserzione</a>
                            @endif

                            <button type="button" class="btn btn-danger text-white mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                        </div>
                    </div>
                </div>
            </div>
                    
            @endforeach
        </div>
    </div>
</div>


{{-- <div style="overflow-x:auto;">
    <table class="table table-hover mt-5">
        <thead>
            <tr>
            <th class="text-center" scope="col">Titolo</th>
            <th class="text-center" scope="col">Indirizzo</th>
            <th class="text-center" scope="col">Sponsorizza la casa</th>
            <th class="text-center" scope="col">Messaggi ricevuti</th>
            <th class="text-center" scope="col" colspan="4">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($houses as $house)
                <tr>
                    <td class="text-center">{{ $house->Title }}</td>
                    <td class="text-center">{{ $house->Address }}</td>
                    <td class="text-center" >
                        <a class="btn btn-primary text-white" href="{{ route('houses.sponsorization', [
                            'id' => $house->id
                        ]) }}">Sponsorizza</a>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-primary text-white" href="{{ route('houses.messages', ['house' => $house]) }}">Messaggi</a>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-primary text-white" href="{{ route('houses.show', $house->id) }}">Visualizza</a>
                    </td>
                    <td class="text-center">
                        @if(Auth::User()->id === $house->user_id)
                            <a class="btn btn-secondary text-white" href="{{ route('houses.edit', $house->id) }}">Modifica l'inserzione</a>
                        @endif
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
</div> --}}

{{-- @foreach ($houses as $house)
<div class="mx-4 boxx">
    <div class="d-flex">
        <div class="d-flex">
            <div class="me-5">
                <div class="text-center"><h4>Titolo</h4>{{ $house->Title }}</div>
            </div>

            <div class="me-5">
                <div class="text-center"><h4>Indirizzo</h4>{{ $house->Address }}</div>
            </div>

            <div class="text-center">
                <h4 class="">Sponsorizza questa casa</h4>
                <a class="btn btn-primary text-white" href="{{ route('houses.sponsorization', [
                    'id' => $house->id
                ]) }}">Sponsorizza</a>
            </div>
            
            <div class="">
                <h4 class="text-center">Altre azioni</h4>
                <div class="d-flex">
                    <div class="">
                        <a class="btn btn-primary text-white" href="{{ route('houses.messages', ['house' => $house]) }}">Messaggi</a>
                    </div>
                    <div class="">
                        <a class="btn btn-primary text-white" href="{{ route('houses.show', $house->id) }}">Visualizza</a>
                    </div>
                    <div class="">
                        @if(Auth::User()->id === $house->user_id)
                            <a class="btn btn-secondary text-white" href="{{ route('houses.edit', $house->id) }}">Modifica l'inserzione</a>
                        @endif
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach --}}


{{-- @foreach ($houses as $house)
    <div class="container-fluid d-flex justify-content-between">
        <div class="row">
            <div class="col-6 text-center"><h4>Titolo:</h4><br> {{ $house->Title }}</div>
            <div class="col-6 text-center"><h4>Indirizzo:</h4><br> {{ $house->Address }}</div>
        </div>
        <div class="row">
            <div class="col-2">
                <a class="btn btn-primary text-white" href="{{ route('houses.sponsorization', [
                    'id' => $house->id
                ]) }}">Sponsorizza</a>
            </div>
            <div class="col-4 d-flex">
                <h4>Altre azioni</h4>
                <div class="">
                    <a class="btn btn-primary text-white" href="{{ route('houses.messages', ['house' => $house]) }}">Messaggi</a>
                </div>
                <div class="">
                    <a class="btn btn-primary text-white" href="{{ route('houses.show', $house->id) }}">Visualizza</a>
                </div>
                <div class="">
                    @if(Auth::User()->id === $house->user_id)
                        <a class="btn btn-secondary text-white" href="{{ route('houses.edit', $house->id) }}">Modifica l'inserzione</a>
                    @endif
                </div>
                <div class="">
                    <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                </div>
            </div>
        </div>
    </div>
@endforeach --}}

@endsection