@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Usuario: {{ $user->first_name .' '.$user->last_name }}</div>
                    <div class="panel-body">



                        <!-- Preguntamos por los errores -->
                        @include('admin.users.partials.messages')
                        <!-- Preguntamos por los errores -->

                        {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'PUT']) !!}
                            @include('admin.users.partials.fields')
                            <button type="submit" class="btn btn-info">Actualizar usuario</button>
                        {!! Form::close() !!}

                    </div>
                </div>
                <!-- Preguntamos para eliminar -->
                @include('admin.users.partials.delete')
                <!-- Preguntamos para eliminar -->
            </div>
        </div>
    </div>
@endsection
