@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <h1 class="text-center">Modifica questa casa</h1>
                <form method="POST" action="{{ route('houses.update', $house->id) }}" class="mb-3" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="Title" class="form-label"><h4>Titolo</h4></label>
                        <input type="text" name="Title" class="form-control" id="Title" value="{{ old('Title', $house->Title) }}">
                    </div>
                    @error('Title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Content" class="form-label"><h4>Descrizione</h4></label>
                        <input type="text" name="Content" class="form-control" id="Content" value="{{ old('Content', $house->Content) }}">
                    </div>
                    @error('Content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Poster" class="form-label"><h4>Immagine di profilo</h4></label>
                        <input class="form-control" type="file" id="Poster" name="Poster" accept="image/*" value="{{ old('Poster', $house->Poster) }}">
                    </div>
                    <img class="img-fluid" src="{{ Storage::exists($house->Poster) ? asset('storage/' . $house->Poster) : $house->Poster }}" alt="">
                    @error('Poster')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                    <div class="mb-3">
                        <label for="N_of_rooms" class="form-label"><h4>Numero di stanze</h4></label>
                        <input class="form-control" type="number" id="N_of_rooms" name="N_of_rooms" value="{{ old('N_of_rooms', $house->N_of_rooms) }}">
                    </div>
                    @error('N_of_rooms')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="N_of_beds" class="form-label"><h4>Numero di letti</h4></label>
                        <input class="form-control" type="number" id="N_of_beds" name="N_of_beds" value="{{ old('N_of_beds', $house->N_of_beds) }}">
                    </div>
                    @error('N_of_beds')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="N_of_baths" class="form-label"><h4>Numero di bagni</h4></label>
                        <input class="form-control" type="number" id="N_of_baths" name="N_of_baths" value="{{ old('N_of_baths', $house->N_of_baths) }}">
                    </div>
                    @error('N_of_baths')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Mq" class="form-label"><h4>Grandezza in {{ __('Mq') }}</h4></label>
                        <input class="form-control" type="number" id="Mq" name="Mq" value="{{ old('N_of_rooms', $house->N_of_rooms) }}">
                    </div>
                    @error('Mq')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Night_price" class="form-label"><h4>Prezzo per notte</h4></label>
                        <input type="number" name="Night_price" class="form-control" id="Night_price" value="{{ old('Night_price', $house->id) }}">
                    </div>
                    @error('Night_price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    {{-- <label for="service_id" class="form-label"><h4>{{ __('service') }}</h4></label>
                    <select name="service_id" id="service" class="form-control">
                        <option value="">Select service</option>
                        @foreach ($services as $service)
                        <option value="{{ $service->id }}" @if ($service->id == old('service_id', $house->service->id)) selected @endif>{{ $service->name }}</option>
                        @endforeach
                    </select>
                    @error('service_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror --}}

                    <div class="mb-3">
                        <label for="Available_from" class="form-label"><h4>Disponibile da</h4></label>
                        <input type="date" name="Available_from" class="form-control" id="Available_from" value="{{ old('Available_from', $house->Available_from) }}">
                    </div>
                    @error('Available_from')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Available_to" class="form-label"><h4>Disponibile fino a</h4></label>
                        <input type="date" name="Available_to" class="form-control" id="Available_to" value="{{ old('Available_to', $house->Available_to) }}">
                    </div>
                    @error('Available_to')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Address" class="form-label"><h4>Indirizzo</h4></label>
                        <input type="text" name="Address" class="form-control" id="Address" value="{{ old('Address', $house->Address) }}">
                    </div>
                    @error('Address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3 form-check">
                        <label class="form-check-label" for="Visible">Visibile</label>
                        <input class="form-check-input" type="checkbox" id="Visible" name="Visible" checked value=1>
                    </div>
                    @error('Visible')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn btn-primary">Modifica</button>
                </form>
                <div class="text-center my-4">
                    <a class="btn btn-primary" href="{{ url()->previous()}}"><--</a>

                    {{-- @if (Auth::user()->id === $house->user_id)
                        {{-- <button class="btn btn-danger btn-delete">Delete</button>
                    @endif --}}

                    {{-- @if (Auth::user()->id === $house->user_id)
                        <form action="{{ route('houses.destroy', $house->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            <button class="btn btn-danger mt-3" onClick="return confirm('Are you sure to delete this?')">Elimina</button>
                        </form>
                    @endif --}}

                    @if (Auth::user()->id === $house->user_id)
                    <button data-id="{{ $house->id }}"  class="mt-4 mb-2 btn btn-danger btn-delete">Delete</button>
                    @endif


                    <section id="confirmation-overlay" class="overlay d-none">
                        <div class="popup">
                            <h1>Sei sicuro di voler eliminare?</h1>
                            <div class="d-flex justify-content-center">
                                <button id="btn-no" class="btn btn-primary me-3">NO</button>
                                <form method="delete" data-base="{{ route('houses.destroy', '*****') }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">SI</button>
                                </form>
                            </div>
                        </div>
                    </section>
                    
                </div>
            </div>
        </div>
    </div>
</main>
@endsection