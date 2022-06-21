@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <h1 class="text-center">Edit this house</h1>
                <form method="POST" action="{{ route('houses.store') }}" class="mb-3" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <div class="mb-3">
                        <label for="Title" class="form-label"><h4>{{ __('Title') }}</h4></label>
                        <input type="text" name="Title" class="form-control" id="Title" value="{{ old('Title') }}">
                    </div>
                    @error('Title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Poster" class="form-label"><h4>{{ __('Poster') }}</h4></label>
                        <input class="form-control" type="file" id="Poster" name="Poster" accept="image/*">
                    </div>
                    {{-- <img class="img-fluid" src="{{ Storage::exists($house->Poster) ? asset('storage/' . $house->Poster) : $house->Poster }}" alt=""> --}}
                    @error('Poster')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror


                    <div class="mb-3">
                        <label for="N_of_rooms" class="form-label"><h4>{{ __('N_of_rooms') }}</h4></label>
                        <input class="form-control" type="number" id="N_of_rooms" name="N_of_rooms" value="{{ old('N_of_rooms') }}">
                    </div>
                    @error('N_of_rooms')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="N_of_beds" class="form-label"><h4>{{ __('N_of_beds') }}</h4></label>
                        <input class="form-control" type="number" id="N_of_beds" name="N_of_beds" value="{{ old('N_of_beds') }}">
                    </div>
                    @error('N_of_beds')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="N_of_baths" class="form-label"><h4>{{ __('N_of_baths') }}</h4></label>
                        <input class="form-control" type="number" id="N_of_baths" name="N_of_baths" value="{{ old('N_of_baths') }}">
                    </div>
                    @error('N_of_baths')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Mq" class="form-label"><h4>{{ __('Mq') }}</h4></label>
                        <input class="form-control" type="number" id="Mq" name="Mq" value="{{ old('N_of_rooms') }}">
                    </div>
                    @error('Mq')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Night_price" class="form-label"><h4>{{ __('Night_price') }}</h4></label>
                        <input type="number" name="Night_price" class="form-control" id="Night_price" value="{{ old('Night_price') }}">
                    </div>
                    @error('Night_price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    {{--<label for="service_id" class="form-label"><h4>{{ __('service') }}</h4></label>
                    <select name="service_id" id="service" class="form-control">
                        <option value="">Select service</option>
                        @foreach ($services as $service)
                        <option value="{{ $service->id }}" @if ($service->id == old('service_id', $house->service->id)) selected @endif>{{ $service->name }}</option>
                        @endforeach
                    </select>
                    @error('service_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror--}}

                    <div class="mb-3">
                        <label for="Available_from" class="form-label"><h4>{{ __('Available_from') }}</h4></label>
                        <input type="date" name="Available_from" class="form-control" id="Available_from" value="{{ old('Available_from') }}">
                    </div>
                    @error('Available_from')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Available_to" class="form-label"><h4>{{ __('Available_to') }}</h4></label>
                        <input type="date" name="Available_to" class="form-control" id="Available_to" value="{{ old('Available_to') }}">
                    </div>
                    @error('Available_to')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Address" class="form-label"><h4>{{ __('Address') }}</h4></label>
                        <input type="text" name="Address" class="form-control" id="Address" value="{{ old('Address') }}">
                    </div>
                    @error('Address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Visible" class="form-label"><h4>{{ __('Visible') }}</h4></label>
                        <div class="text-center">
                            Yes
                            <input type="checkbox" name="Visible" class="form-control" id="Visible" value="1">
                        </div>
                    </div>
                    @error('Visible')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <div class="text-center my-4">
                    <a class="btn btn-primary" href="{{ url()->previous()}}">Back</a>
                    {{-- @if (Auth::user()->id === $house->user_id)
                        <button class="btn btn-danger btn-delete">Delete</button>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
{{-- @extends('layouts.app')

@section('content')
<h1>create</h1>
    <div class="container">
        <form action="{{route('houses.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3 col-4">
            <label for="Poster" class="form-label">Carica una immagine</label>
            <input class="form-control" type="file" id="Poster" name="Poster" accept="image/*">
        </div>
        @error('Poster')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

            </div>
            @error('Title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label class="form-label" for="Content">Descrizione</label>
                <input class="form-control" type="text" name="Content" value="{{ old('Content') }}">
            </div>
            @error('Content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        <div class="mb-3">
            <label class="form-label" for="Title">Content</label>
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

        <button type="submit">Pubblica casa</button>

        </form>
    </div>
@endsection --}}
