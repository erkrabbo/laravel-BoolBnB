@extends('layouts.app')

@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 braintree">
                <form id="form" action="/payment/make">
                    <input id="prova" name="nonce" type="hidden">  
                    <input name="price" type="hidden" value="{{ $id }}">
                    <div id="dropin-container"></div>
                    <button id="submit-button" class="button button--small button--green mb-3">Conferma</button>
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('success') !!}</li>
                            </ul>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="">
                            <h3 class="text-danger">{{ $errors->first() }}</h3>
                        </div>
                    @endif
                </form>
            </div>
        </div>
@endsection
