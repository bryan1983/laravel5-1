<div class="form-group">
    {!! Form::label('first_name', 'Nombre') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Introduzca su Nombre']) !!}
</div>
<div class="form-group">
    {!! Form::label('last_name', 'Apellidos') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Introduzca sus Apellidos']) !!}
</div>
<div class="form-group">
    {!! Form::label('type', 'Tipo de usuario') !!}
    {!! Form::select('type', config('options.types'),null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('email', 'E-mail') !!}
    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Introduzca su E-Mail']) !!}
</div>
<div class="form-group">
    {!! Form::label('password', 'Contraseña') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('password_confirmation', 'Confirma tu contraseña') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>