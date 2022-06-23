@extends('layouts.app')

@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 braintree">
                <form id="form" action="/payment/make">
                    <input id="prova" name="nonce" type="hidden">
                    
                    {{-- @dd($id) --}}

                    {{-- <input type="hidden" value="{{ $sponsorization->id }}"> --}}
                    <div id="dropin-container"></div>
                    <button id="submit-button" class="button button--small button--green">Conferma</button>
                </form>
            </div>
        </div>
@endsection
