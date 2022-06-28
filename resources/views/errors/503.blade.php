@extends('errors::minimal')

@section('title', __('Errore 503'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'Servizio non disponibile'))
