@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Nuevo Usuario</div>
                    <div class="panel-body">

                        <!-- Preguntamos por los errores -->
                        @include('admin.users.partials.messages')
                        <!-- Preguntamos por los errores -->


                        {!! Form::open(['route' => 'admin.users.store', 'method' => 'POST']) !!}
                            @include('admin.users.partials.fields')
                            <button type="submit" class="btn btn-info">Crear usuario</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
