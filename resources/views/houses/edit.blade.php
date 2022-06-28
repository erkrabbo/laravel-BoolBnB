@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/createValidation.js') }}" defer></script>
<script src="{{ asset('js/validationFormEdit.js') }}" defer></script>
@section('content')
<main class="validationMain">
    <div class="container edit mt-3">
        <a class="back text-decoration-none mod_btn btn_grey_border my-3" href="{{ url()->previous()}}"><i class="fa-solid fa-arrow-left"></i> Torna indietro</a>
        <h1 class="text-center my-4">Modifica questa casa</h1>
        <form id="form"  class="mt-3 mx-5" method="POST" action="{{ route('houses.update', $house->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label for="Title" class="form-label form_title">Titolo *</label>
                <input type="text" name="Title" class="form-control form_textbox" id="Title" value="{{ old('Title', $house->Title) }}">
                <h2 class="errorText" id="errorTitle"></h2>
            </div>
            @error('Title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-5">
                <label for="Content" class="form-label form_title">Descrizione *</label>
                <input id="Content" type="text" name="Content" class="form-control form_textbox" id="Content" value="{{ old('Content', $house->Content) }}">
                <h2 class="errorText" id="errorContent"></h2>
            </div>
            @error('Content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-5">
                <label for="Poster" class="form-label form_title">Immagine di copertina *</label>
                <input class="form-control form_textbox" type="file" id="Poster" name="Poster" accept="image/*">
                <img class="img-rounded img-fluid mt-3" src="{{ Storage::exists($house->Poster) ? asset('storage/' . $house->Poster) : $house->Poster }}" alt="">
            </div>
            @error('Poster')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div>
                <label class="form-label form_title" for="house_images">Immagini secondarie</label>
                <input class="form-control form_textbox" type="file" id="house_images" name="house_images[]" accept="image/*" multiple>

                {{-- immagini secondarie --}}
                <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 images d-flex flex-wrap">
                    @foreach ($house_images as $house_image)
                        <div class="sec_img_container col mt-3 mb-5 d-flex">
                            <img class="img-fluid img-rounded" src="{{ Storage::exists($house_image->path) ? asset('storage/' . $house_image->path) : $house_image->path }}" alt="{{ $house->Title }}">

                            <button data-image="{{ $house_image->id }}" type="button" class="btn_delete_img" data-bs-toggle="modal" data-bs-target="#imageModal"><i class="fa-solid fa-circle-xmark"></i></button>
                        </div>
                    @endforeach
                </div>
            </div>
            @error('house_images')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <fieldset class="mb-5">
                <legend class="form_title">Servizi</legend>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                    @foreach ($services as $service)
                        <span>
                            <input class="col form-check-input" type="checkbox" name="services[]" id="service-{{ $service->id }}" value="{{ $service->id }}"
                            @if (in_array($service->id, old('services', $house->services->pluck('id')->all() ))) checked @endif>
                            <label class="me-4" for="service-{{ $service->id }}">{{ $service->name }}</label>
                        </span>
                    @endforeach
                </div>
                @error('Service')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </fieldset>

            <div class="mb-5">
                <label for="N_of_rooms" class="form-label form_title">Numero di stanze *</label>
                <input required class="form-control form_textbox" type="number" id="N_of_rooms" name="N_of_rooms" value="{{ old('N_of_rooms', $house->N_of_rooms) }}">
                <h2 class="errorText" id="errorNofRooms"></h2>
            </div>
            @error('N_of_rooms')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-5">
                <label for="N_of_beds" class="form-label form_title">Numero di letti *</label>
                <input class="form-control form_textbox" type="number" id="N_of_beds" name="N_of_beds" value="{{ old('N_of_beds', $house->N_of_beds) }}">
                <h2 class="errorText" id="errorNofBeds"></h2>
            </div>
            @error('N_of_beds')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-5">
                <label for="N_of_baths" class="form-label form_title">Numero di bagni *</label>
                <input class="form-control form_textbox" type="number" id="N_of_baths" name="N_of_baths" value="{{ old('N_of_baths', $house->N_of_baths) }}">
                <h2 class="errorText" id="errorNofBaths"></h2>
            </div>
            @error('N_of_baths')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-5">
                <label for="Mq" class="form-label form_title">Grandezza in {{ __('Mq') }} *</label>
                <input class="form-control form_textbox" type="number" id="Mq" name="Mq" value="{{ old('N_of_rooms', $house->N_of_rooms) }}">
                <h2 class="errorText" id="errorMq"></h2>
            </div>
            @error('Mq')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-5">
                <label for="Night_price" class="form-label form_title">Prezzo per notte *</label>
                <input type="number" name="Night_price" class="form-control form_textbox" id="Night_price" value="{{ old('Night_price', $house->Night_price) }}">
                <h2 class="errorText" id="errorNightPrice"></h2>
            </div>
            @error('Night_price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-5">
                <label for="Available_from" class="form-label form_title">Disponibile dal *</label>
                <input type="date" name="Available_from" class="form-control form_textbox" id="Available_from" value="{{ old('Available_from', $house->Available_from) }}">
                <h2 class="errorText" id="errorAvailableFrom"></h2>
            </div>
            @error('Available_from')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-5">
                <label for="Available_to" class="form-label form_title">Disponibile al *</label>
                <input type="date" name="Available_to" class="form-control form_textbox" id="Available_to" value="{{ old('Available_to', $house->Available_to) }}">
                <h2 class="errorText" id="errorAvailableTo"></h2>
            </div>
            @error('Available_to')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div id="js-address-container" class="relative_ul mb-5">
                <label class="form-label form_title" for="Address">Indirizzo *</label>
                <input autocomplete="off" class="form-control form_textbox" type="text" id="js-address" name="Address" value="{{ old('Address', $house->Address) }}">
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

            <input type="hidden" id="js-lat" name="Lat" value="{{ old('Lat', $house->Lat) }}">
            <input type="hidden" id="js-lng" name="Lng" value="{{ old('Lng', $house->Lng) }}">

            <div class="mb-2 span_container">
                <span class="tiny_text">I campi con * sono obbligatori</span>
            </div>

            <button type="submit" class="mod_btn btn_pink float-end"><i class="fa-solid fa-check"></i> Salva modifiche</button>
        </form>
        <div class="buttons_container my-3">

            @if (Auth::user()->id === $house->user_id)
                <button type="button" class="mod_btn btn_red_border float-start" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-solid fa-trash"></i> Elimina casa
                </button>
            @endif

            <div class="modal fade pt-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Elimina casa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h3 class="text-center">Sei sicuro di voler eliminare? <br>
                                Questa azione è irreversibile</h3>
                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <button type="button" class="mod_btn btn_grey_border" data-bs-dismiss="modal">Annulla</button>
                            <form action="{{ route('houses.destroy', $house->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="mod_btn btn_red">Elimina</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade pt-5" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageModalLabel">Elimina immagine</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h3 class="text-center">Sei sicuro di voler eliminare questa immagine? <br>
                                Questa azione è irreversibile</h3>
                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <button type="button" class="mod_btn btn_grey_border" data-bs-dismiss="modal">Annulla</button>
                            <form id="formDelete" action="{{ route('houses-image.destroy', '*****') }}" method="POST">
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
</main>
@endsection
