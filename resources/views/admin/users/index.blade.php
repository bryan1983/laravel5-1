@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Usuarios</div>
                    @if(Session::has('message'))

                        <p class="alert alert-success">{{ Session::get('message') }}</p>

                    @endif

                    <div class="panel-body">
                        {!! Form::model(Request::all(),['route' => 'admin.users.index', 'method' => 'GET', 'class' => 'navbar-form navbar-left pull-right', 'role' => 'search']) !!}
                            <div class="form-group">
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre de usuario']) !!}
                                {!! Form::select('type', config('options.types'), null, ['class' => 'form-control']) !!}
                            </div>
                            <button class="btn btn-default" type="submit">Buscar</button>
                        {!! Form::close() !!}
                        <p><a class="btn btn-primary" href="{{ route('admin.users.create') }}" role="button">Crear usuario</a></p>
                        <p>Hay {{ $users->lastPage() }} páginas</p>
                        @include('admin.users.partials.table')
                        {!! $users->appends(Request::only(['name', 'type']))->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::open(['route' => ['admin.users.destroy', ':USER_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
    {!! Form::close() !!}

@endsection

@section('scripts')
<script>
    $(function(){

      $('.btn-delete').on('click', function(e){
        e.preventDefault();

        var row = $(this).parents('tr');
        var id = row.data('id');
        var form = $('#form-delete');
        var url = form.attr('action').replace(':USER_ID', id);
        var data = form.serialize();

        row.fadeOut();

        $.post(url, data, function(result){
            alert(result.message);
        }).fail(function(){
          alert("El usuario no fue eliminado");
          row.show();
        });

      });
    });
</script>
@endsection