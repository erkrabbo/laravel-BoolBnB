@extends('layouts.app')

@section('content')
<div class="container register">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mod_card mt-5">
                <div class="card-header text-center form_title">Registrati</div>

                <div class="card-body mt-3">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row pb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right form_title">Nome *</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control form_textbox @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label for="surname" class="col-md-4 col-form-label text-md-right form_title">Cognome *</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control form_textbox @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" autofocus>

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label for="birthday" class="col-md-4 col-form-label text-md-right form_title">Data di nascita</label>

                            <div class="col-md-6">
                                <input id="birthday" type="date" class="form-control form_textbox @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}" autofocus>

                                @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row pb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right form_title">Indirizzo email *</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control form_textbox @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right form_title">Password *</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control form_textbox @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right form_title">Conferma la password *</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control form_textbox" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <span class="tiny_text">I campi con * sono obbligatori</span>

                        <div class="form-group row pb-3 mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="mod_btn btn_pink fw-bold mt-2">
                                    Registrati
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
