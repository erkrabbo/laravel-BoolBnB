@extends('layouts.app')

@section('content')
    <main>

        <div class="container">
            <form action="{{ route('houses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="Poster">Immagine di copertina</label>
                    {{-- <input class="form-control" type="file" name="Poster" value="{{ old('Poster') }}"> --}}
                    <input class="form-control" type="file" id="Poster" name="Poster" accept="image/*">
                </div>
                @error('Poster')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label class="form-label" for="house_images">Immagini secondarie</label>
                    <input class="form-control" type="file" id="house_images" name="house_images[]" accept="image/*" multiple>
                </div>
                @error('house_images')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label class="form-label" for="Title">Titolo</label>
                    <input class="form-control" type="text" name="Title" value="{{ old('Title') }}">

                </div>
                @error('Title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                
                <fieldset>
                    <legend>Servizi</legend>
                    @foreach ($services as $service)
                        <input type="checkbox" name="services[]" id="service-{{ $service->id }}" value="{{ $service->id }}"
                            @if (in_array($service->id, old('services', []))) checked @endif>
                        <label class="me-4" for="service-{{ $service->id }}">{{ $service->name }}</label>
                    @endforeach
                    @error('Service')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </fieldset>


                <div class="mb-3">
                    <label class="form-label" for="Content">Descrizione</label>
                    <input class="form-control" type="text" name="Content" value="{{ old('Content') }}">
                </div>
                @error('Content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label class="form-label" for="Night_price">Prezzo / notte</label>
                    <input class="form-control" type="number" name="Night_price" value="{{ old('Night_price') }}">
                </div>
                @error('Night_price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label class="form-label" for="N_of_rooms">Numero di stanze</label>
                    <input class="form-control" type="number" name="N_of_rooms" value="{{ old('N_of_rooms') }}">
                </div>
                @error('N_of_rooms')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label class="form-label" for="N_of_beds">Numero di letti</label>
                    <input class="form-control" type="number" name="N_of_beds" value="{{ old('N_of_beds') }}">
                </div>
                @error('N_of_beds')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label class="form-label" for="N_of_baths">Numero di bagni</label>
                    <input class="form-control" type="number" name="N_of_baths" value="{{ old('N_of_baths') }}">
                </div>
                @error('N_of_baths')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label class="form-label" for="Mq">Mq</label>
                    <input class="form-control" type="number" name="Mq" value="{{ old('Mq') }}">
                </div>
                @error('Mq')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label class="form-label" for="Available_from">Disponibile dal</label>
                    <input class="form-control" type="date" name="Available_from" value="{{ old('Available_from') }}">
                </div>
                @error('Available_from')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label class="form-label" for="Available_to">Disponibile al</label>
                    <input class="form-control" type="date" name="Available_to" value="{{ old('Available_to') }}">
                </div>
                @error('Available_to')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label class="form-label" for="Address">Indirizzo</label>
                    <input class="form-control" type="text" name="Address" value="{{ old('Address') }}">
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

                <button type="submit">Pubblica casa</button>

            </form>
        </div>
    </main>
@endsection
