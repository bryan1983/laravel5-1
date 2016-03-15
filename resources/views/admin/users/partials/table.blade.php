<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Tipo</th>
        <th>Acciones</th>
    </tr>
    @foreach( $users AS $user)
        <tr data-id="{{ $user->id }}">
            <td>{{ $user->id }}</td>
            <td>{{ $user->full_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->type }}</td>
            <td>
                <a class="btn btn-primary" href="{{ route('admin.users.edit', $user) }}">Editar</a>
                <a class="btn btn-danger btn-delete" href="#">Eliminar</a>
                <!-- <a class="btn btn-danger" href="{{ route('admin.users.destroy', $user) }}">Eliminar</a> -->
                <!-- @include('admin.users.partials.delete') -->
            </td>
        </tr>
    @endforeach
</table>