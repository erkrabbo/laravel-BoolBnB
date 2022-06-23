@extends('layouts.app')

@section('content')
<div class="container login">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mod_card mt-5">
                <div class="card-header text-center form_title">Accedi</div>

                <div class="card-body mt-3">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row pb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right form_title">Indirizzo email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control form_textbox @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right form_title">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control form_textbox @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Ricordami
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="mod_btn btn_grey_border fw-bold">
                                    Accedi
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Hai dimenticato la password?
                                </a>
                                @endif

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
