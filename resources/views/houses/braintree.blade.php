@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/braintree.js') }}" defer></script>
@endsection
@section ('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 braintree">
                    <form id="form" action="/payment/make">
                        <input id="prova" name="nonce" type="hidden">
                        <input name="price" type="hidden" value="{{ $id }}">
                        <input type="hidden" name="house" value="{{ $house }}">
                        <div id="dropin-container"></div>
                        <button id="submit-button" class="button button--small button--green mb-3">Conferma</button>
                        @if($errors->any())
                            <div class="">
                                <h3 class="text-danger">{{ $errors->first() }}</h3>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
    </main>
@endsection
