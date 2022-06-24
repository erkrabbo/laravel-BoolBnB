@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifica il tuo indirizzo email</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{-- {{ __('A fresh verification link has been sent to your email address.') }} --}}
                            Un nuovo link di verifica è stato inviato nel tuo indirizzo email
                        </div>
                    @endif

                    {{-- {{ __('Before proceeding, please check your email for a verification link.') }} --}}
                    Prima di procedere, controlla la tua email per il link di verifica
                    {{-- {{ __('If you did not receive the email') }} --}}
                    Se non ricevi la mail,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Clicca qui per richiederne un'altra</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
