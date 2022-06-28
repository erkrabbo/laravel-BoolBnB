@extends('errors::minimal')

@section('title', __('errore 403'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Non puoi accedere alle informazioni delle altre case!'))
