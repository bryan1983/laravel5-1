@extends('layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2>{{ trans('tickets.form.create.title') }}</h2>
                @include('partials/errors')
                {!! Form::open(['route' => 'tickets.store', 'method' => 'POST']) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Titulo') !!}
                    {!! Form::textarea('title', null, [
                        'rows'  => '4',
                        'class' => 'form-control',
                        'placeholder' => 'Dinos que tutorial quieres que desarrollemos para Laravel'
                    ]) !!}

                </div>
                <p>
                    <button type="submit" class="btn btn-primary">{{ trans('tickets.form.create.submit') }}</button>
                </p>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection