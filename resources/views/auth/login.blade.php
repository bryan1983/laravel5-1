@extends('layout')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('auth.labels.login') }}</div>
				<div class="panel-body">
					@include('partials/errors')

					<form class="form-horizontal" role="form" method="POST" action="{{ url('auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('validation.attributes.email') }}</label>
							<div class="col-md-6">
								{!! Form::text('email', null, ['class' => 'form-control', 'type' => 'email'])  !!}
								<!--<input type="email" class="form-control" name="email" value="{{ old('email') }}"> -->
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('validation.attributes.password') }}</label>
							<div class="col-md-6">
								{!! Form::password('password', ['class' => 'form-control']) !!}
								<!--<input type="password" class="form-control" name="password">-->
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> {{ trans('validation.attributes.remember')  }}
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">{{ trans('validation.attributes.submit') }}</button>

								<a class="btn btn-link" href="{{ url('/password/email') }}">{{ trans('validation.attributes.forgot') }}</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
