@extends('layouts.app')
@section('scripts')
<script src="{{ asset('js/createValidation.js') }}" defer></script>
<script src="{{ asset('js/validationForm.js') }}" defer></script>
@section('content')
<main>
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <h1 class="text-center mt-3">Modifica questa casa</h1>
                <form id="form" method="POST" action="{{ route('houses.update', $house->id) }}" class="mb-3" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div id="error"></div>
                    
                    <div class="mb-3">
                        <label for="Title" class="form-label"><h4>Titolo*</h4></label>
                        <input type="text" name="Title" class="form-control" id="Title" value="{{ old('Title', $house->Title) }}">
                    </div>
                    @error('Title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Content" class="form-label"><h4>Descrizione*</h4></label>
                        <input type="text" name="Content" class="form-control" id="Content" value="{{ old('Content', $house->Content) }}">
                    </div>
                    @error('Content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Poster" class="form-label"><h4>Immagine di profilo*</h4></label>
                        <input class="form-control" type="file" id="Poster" name="Poster" accept="image/*" value="{{ old('Poster', $house->Poster) }}">
                    </div>
                    <img class="img-fluid mb-3" src="{{ Storage::exists($house->Poster) ? asset('storage/' . $house->Poster) : $house->Poster }}" alt="">
                    @error('Poster')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label class="form-label" for="house_images"><h4>Immagini secondarie</h4></label>
                        <input class="form-control" type="file" id="house_images" name="house_images[]" accept="image/*" multiple>

                        <div class="w-50 h-25 images d-flex flex-wrap">
                            @foreach ($house_images as $house_image)
                                <div>
                                    <img class="img-rounded w-50 h-50 p-1" src="{{ Storage::exists($house_image->path) ? asset('storage/' . $house_image->path) : $house_image->path }}" alt="{{ $house->Title }}">
                                    <button data-image="{{ $house_image->id }}" type="button" class="btn btn-danger ms-3" data-bs-toggle="modal" data-bs-target="#imageModal">&cross;</button>
                                </div>
                             @endforeach
                        </div>

                    </div>
                    @error('house_images')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <fieldset class="mb-3">
                        <h4>Servizi</h4>
                        <div class="d-flex align-items-center flex-wrap block">
                            @foreach ($services as $service)
                            <div>
                                <input type="checkbox" name="services[]" class="me-2" id="service-{{ $service->id }}" value="{{ $service->id }}"
                                @if (in_array($service->id, old('services', $house->services->pluck('id')->all() ))) checked @endif>
                               <label class="me-4" for="service-{{ $service->id }}"><h5>{{ $service->name }}</h5></label>
                            </div>
                            @endforeach
                        </div>
                        @error('Service')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <div class="mb-3">
                        <label for="N_of_rooms" class="form-label"><h4>Numero di stanze*</h4></label>
                        <input class="form-control" type="number" id="N_of_rooms" name="N_of_rooms" value="{{ old('N_of_rooms', $house->N_of_rooms) }}">
                    </div>
                    @error('N_of_rooms')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="N_of_beds" class="form-label"><h4>Numero di letti*</h4></label>
                        <input class="form-control" type="number" id="N_of_beds" name="N_of_beds" value="{{ old('N_of_beds', $house->N_of_beds) }}">
                    </div>
                    @error('N_of_beds')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="N_of_baths" class="form-label"><h4>Numero di bagni*</h4></label>
                        <input class="form-control" type="number" id="N_of_baths" name="N_of_baths" value="{{ old('N_of_baths', $house->N_of_baths) }}">
                    </div>
                    @error('N_of_baths')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Mq" class="form-label"><h4>Grandezza in {{ __('Mq') }}*</h4></label>
                        <input class="form-control" type="number" id="Mq" name="Mq" value="{{ old('N_of_rooms', $house->N_of_rooms) }}">
                    </div>
                    @error('Mq')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Night_price" class="form-label"><h4>Prezzo per notte*</h4></label>
                        <input type="number" name="Night_price" class="form-control" id="Night_price" value="{{ old('Night_price', $house->id) }}">
                    </div>
                    @error('Night_price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Available_from" class="form-label"><h4>Disponibile da*</h4></label>
                        <input type="date" name="Available_from" class="form-control" id="Available_from" value="{{ old('Available_from', $house->Available_from) }}">
                    </div>
                    @error('Available_from')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Available_to" class="form-label"><h4>Disponibile fino a*</h4></label>
                        <input type="date" name="Available_to" class="form-control" id="Available_to" value="{{ old('Available_to', $house->Available_to) }}">
                    </div>
                    @error('Available_to')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div id="js-address-container" class="mb-3">
                        <label class="form-label" for="Address">Indirizzo*</label>
                        <input class="form-control" type="text" id="js-address" name="Address" value="{{ old('Address', $house->Address) }}">
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

                    <input type="hidden" id="js-lat" name="Lat" value="{{ old('Lat', $house->Lat) }}">
                    <input type="hidden" id="js-lng" name="Lng" value="{{ old('Lng', $house->Lng) }}">

                    <div class="center"><button type="submit" class="btn btn-primary white ">Modifica</button></div>
                </form>
                <div class="text-center my-4 d-flex justify-content-center align-items-center buttons">
                    <a class="btn btn-primary" href="{{ url()->previous()}}">Indietro</a>

                    <button type="button" class="btn btn-danger ms-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Elimina
                    </button>
                      
                      <!-- Modal -->
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
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                                @if (Auth::user()->id === $house->user_id)
                                <form action="{{ route('houses.destroy', $house->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    <button class="btn btn-danger">Elimina</button>
                                </form>
                                @endif
                            </div>
                          </div>
                        </div>
                      </div>

                      {{-- <div class="modal-body">
                        <h5>Popover in a modal</h5>
                        <p>This <a href="#" role="button" class="btn btn-secondary" data-bs-toggle="popover" title="Popover title" data-bs-content="Popover body content is set in this attribute.">button</a> triggers a popover on click.</p>
                      </div> --}}

                    {{-- <section id="confirmation-overlay" class="overlay d-none">
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
                    </div>   

                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel">Elimina immagine</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h3>Sei sicuro di voler eliminare? Questa azione è irreversibile</h3>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                                    <form id="formDelete" action="{{ route('houses-image.destroy', '*****') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Elimina</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>   


                </div>
            </div>
        </div>
    </div>
</main>
@endsection