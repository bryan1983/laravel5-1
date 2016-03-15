@extends('examples.layout')

@section('title')
    Bienvenido a la HOME
@stop

@section('content')
    <h1>Curso Básico de Laravel 5</h1>

    @if (isset($user))
        <p>Bievenido {{ $user }}</p>
    @else
        [Login]
    @endif
@stop


