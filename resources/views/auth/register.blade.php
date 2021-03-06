@extends('layout')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('auth.labels.register') }}</div>
				<div class="panel-body">
					@include('partials/errors')

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('validation.attributes.first_name') }}</label>
							<div class="col-md-6">
								{!! Form::text('first_name', null, ['class' => 'form-control']) !!}
								<!-- <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}"> -->
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('validation.attributes.last_name') }}</label>
							<div class="col-md-6">
								{!! Form::text('last_name', null, ['class' => 'form-control']) !!}
								<!-- <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}"> -->
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('validation.attributes.email') }}</label>
							<div class="col-md-6">
								{!! Form::text('email', null, ['class' => 'form-control', 'type' => 'email']) !!}
								<!-- <input type="email" class="form-control" name="email" value="{{ old('email') }}"> -->
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('validation.attributes.password') }}</label>
							<div class="col-md-6">
								{!! Form::password('password', ['class' => 'form-control']) !!}
								<!-- <input type="password" class="form-control" name="password"> -->
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('validation.attributes.confirm_password') }}</label>
							<div class="col-md-6">
								{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
								<!-- <input type="password" class="form-control" name="password_confirmation"> -->
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									{{ trans('validation.attributes.register') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
