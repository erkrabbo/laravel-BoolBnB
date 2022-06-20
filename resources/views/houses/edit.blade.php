@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <h1 class="text-center">Edit this house</h1>
                <form method="POST" action="{{ route('houses.update', $house->id) }}" class="mb-3" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="Title" class="form-label"><h4>{{ __('Title') }}</h4></label>
                        <input type="text" name="Title" class="form-control" id="Title" value="{{ old('Title', $house->Title) }}">
                    </div>
                    @error('Title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Poster" class="form-label"><h4>{{ __('Poster') }}</h4></label>
                        <input class="form-control" type="file" id="Poster" name="Poster" accept="image/*">
                    </div>
                    <img src="{{ asset('storage/' . $house->Poster) }}" alt="" class="img-fluid">
                    @error('Poster')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="N_of_rooms" class="form-label"><h4>{{ __('N_of_rooms') }}</h4></label>
                        <input class="form-control" type="number" id="N_of_rooms" name="N_of_rooms" value="{{ old('N_of_rooms', $house->N_of_rooms) }}">
                    </div>
                    @error('N_of_rooms')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="N_of_beds" class="form-label"><h4>{{ __('N_of_beds') }}</h4></label>
                        <input class="form-control" type="number" id="N_of_beds" name="N_of_beds" value="{{ old('N_of_beds', $house->N_of_beds) }}">
                    </div>
                    @error('N_of_beds')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="N_of_baths" class="form-label"><h4>{{ __('N_of_baths') }}</h4></label>
                        <input class="form-control" type="number" id="N_of_baths" name="N_of_baths" value="{{ old('N_of_baths', $house->N_of_baths) }}">
                    </div>
                    @error('N_of_baths')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Mq" class="form-label"><h4>{{ __('Mq') }}</h4></label>
                        <input class="form-control" type="number" id="Mq" name="Mq" value="{{ old('N_of_rooms', $house->N_of_rooms) }}">
                    </div>
                    @error('Mq')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Night_price" class="form-label"><h4>{{ __('Night_price') }}</h4></label>
                        <input type="number" name="Night_price" class="form-control" id="Night_price" value="{{ old('Night_price', $house->id) }}">
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
                        <input type="date" name="Available_from" class="form-control" id="Available_from" value="{{ old('Available_from', $house->Available_from) }}">
                    </div>
                    @error('Available_from')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Available_to" class="form-label"><h4>{{ __('Available_to') }}</h4></label>
                        <input type="date" name="Available_to" class="form-control" id="Available_to" value="{{ old('Available_to', $house->Available_to) }}">
                    </div>
                    @error('Available_to')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Address" class="form-label"><h4>{{ __('Address') }}</h4></label>
                        <input type="text" name="Address" class="form-control" id="Address" value="{{ old('Address', $house->Address) }}">
                    </div>
                    @error('Address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="mb-3">
                        <label for="Visible" class="form-label"><h4>{{ __('Visible') }}</h4></label>
                        <div class="text-center">
                            Yes
                            <input type="radio"  @if ($house->visible === 1 ? true : false) @endif name="Visible" class="form-control" id="Visible" value="{{ old('Visible', $house->Visible) }}">
                        </div>
                        
                        <div class="text-center">
                            No
                            <input type="radio" @if ($house->visible !== 1 ? true : false) @endif name="Visible" class="form-control" id="Visible" value="{{ old('Visible', $house->Visible) }}">
                        </div>
                    </div>
                    @error('Visible')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <div class="text-center my-4">
                    <a class="btn btn-primary" href="{{ url()->previous()}}">Back</a>
                    @if (Auth::user()->id === $house->user_id)
                        <button class="btn btn-danger btn-delete">Delete</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection