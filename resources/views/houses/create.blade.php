@extends('layouts.app')
@section('scripts')
<script src="{{ asset('js/createValidation.js') }}" defer></script>
<script src="{{ asset('js/validationForm.js') }}" defer></script>
@endsection
@section('content')
    <main>
        <div class="container create mt-3">
            <h1 class="text-center mt-3">Crea nuova casa</h1>
            <a class="back text-decoration-none mod_btn btn_grey_border my-3" href="{{ url()->previous()}}">Torna indietro</a>
            <form class="mt-3 mx-5" action="{{ route('houses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-5">
                    <label class="form-label form_title" for="Title">Titolo *</label>
                    <input class="form-control form_textbox" type="text" name="Title" value="{{ old('Title') }}">
                </div>
                @error('Title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-5">
                    <label class="form-label form_title" for="Content">Descrizione *</label>
                    <input class="form-control form_textbox" type="text" name="Content" value="{{ old('Content') }}">
                </div>
                @error('Content')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-5">
                    <label class="form-label form_title" for="Poster">Immagine di copertina *</label>
                    <input class="form-control" type="file" id="Poster" name="Poster" accept="image/*">
                </div>
                @error('Poster')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-5">
                    <label class="form-label form_title" for="house_images">Immagini secondarie</label>
                    <input class="form-control" type="file" id="house_images" name="house_images[]" accept="image/*" multiple>
                </div>
                @error('house_images')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <fieldset class="mb-5">
                    <legend class="form_title">Servizi</legend>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-md-4">
                        @foreach ($services as $service)
                        <span>
                            <input class="col form-check-input" type="checkbox" name="services[]" id="service-{{ $service->id }}" value="{{ $service->id }}"
                                @if (in_array($service->id, old('services', []))) checked @endif>
                            <label class="me-4" for="service-{{ $service->id }}">{{ $service->name }}</label>
                        </span>
                        @endforeach
                    </div>
                    @error('Service')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </fieldset>

                <div class="mb-5">
                <label class="form-label form_title" for="N_of_rooms">Numero di stanze *</label>
                    <input class="form-control form_textbox" type="number" name="N_of_rooms" value="{{ old('N_of_rooms') }}">
                </div>
                @error('N_of_rooms')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-5">
                    <label class="form-label form_title" for="N_of_beds">Numero di letti *</label>
                    <input class="form-control form_textbox" type="number" name="N_of_beds" value="{{ old('N_of_beds') }}">
                </div>
                @error('N_of_beds')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-5">
                    <label class="form-label form_title" for="N_of_baths">Numero di bagni *</label>
                    <input class="form-control form_textbox" type="number" name="N_of_baths" value="{{ old('N_of_baths') }}">
                </div>
                @error('N_of_baths')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-5">
                    <label class="form-label form_title" for="Mq">Grandezza in Mq *</label>
                    <input class="form-control form_textbox" type="number" name="Mq" value="{{ old('Mq') }}">
                </div>
                @error('Mq')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-5">
                    <label class="form-label form_title" for="Night_price">Prezzo per notte *</label>
                    <input class="form-control form_textbox" type="number" name="Night_price" value="{{ old('Night_price') }}">
                </div>
                @error('Night_price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-5">
                    <label class="form-label form_title" for="Available_from">Disponibile dal *</label>
                    <input class="form-control form_textbox" type="date" name="Available_from" value="{{ old('Available_from') }}">
                </div>
                @error('Available_from')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-5">
                    <label class="form-label form_title" for="Available_to">Disponibile al *</label>
                    <input class="form-control form_textbox" type="date" name="Available_to" value="{{ old('Available_to') }}">
                </div>
                @error('Available_to')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div id="js-address-container" class="mb-5">
                    <label class="form-label form_title" for="Address">Indirizzo *</label>
                    <input class="form-control form_textbox" type="text" id="js-address" name="Address" value="{{ old('Address') }}">
                </div>
                @error('Address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="mb-5 form-check">
                    <label class="form-check-label" for="Visible">Visibile</label>
                    <input class="form-check-input" type="checkbox" id="Visible" name="Visible" checked value=1>
                </div>
                @error('Visible')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                <input type="hidden" id="js-lat" name="Lat">
                <input type="hidden" id="js-lng" name="Lng">

                <button class="mod_btn btn_pink float-end" type="submit">Pubblica casa</button>

            </form>
            <span class="tiny_text">I campi con * sono obbligatori</span>

            {{--
            <button class="mod_btn btn_pink">bottone di prova</button>
            <button class="mod_btn btn_pink_border">bottone di prova</button>
            <button class="mod_btn btn_grey_border">bottone di prova</button>
            <button class="mod_btn btn_red_border">bottone di prova</button>
            --}}

        </div>
    </main>
@endsection
