@extends('admin.layouts.app')

@section('content')
<div class="page-container bg-blue-grey-900">
	<div class="d-flex align-items-center align-items-center-ie bg-gradient-primary">
		<div class="fw">
			<div class="container container-xs">
				<form class="cardbox cardbox-flat text-white form-validate text-color" id="user-login" action="" method="POST" name="admin_login" novalidate="">
					@csrf
					<div class="cardbox-heading">
						<div class="cardbox-title text-center">Admin Login</div>
					</div>
					<div class="cardbox-body">
						<div class="px-5">
							<div class="form-group">
								<input class="form-control form-control-inverse {{ $errors->has('email') ? ' error' : '' }}" value="{{ old('email', 'alex.culango@gmail.com') }}" type="email" name="email" placeholder="email" required autofocus>
								@if ($errors->has('email'))
                                    <label id="email-error" class="error" for="email">{{ $errors->first('email') }}</label>
                                @endif
							</div>
							<div class="form-group">
								<input class="form-control form-control-inverse {{ $errors->has('password') ? ' error' : '' }}" value="p4ssw0rd" type="password" name="password" placeholder="password" required>
								@if ($errors->has('password'))
                                    <label id="password-error" class="error" for="password">{{ $errors->first('password') }}</label>
                                @endif
							</div>
							<div class="form-group mt-4">
								<div class="custom-control custom-checkbox mb-0">
									<input class="custom-control-input" name="remember" type="checkbox" checked>
									<label class="custom-control-label" for="remember">Remember me</label>
								</div>
							</div>
							<div class="text-center my-4">
								<button class="btn btn-lg btn-gradient btn-oval btn-info btn-block" id="submit-button" type="submit">Authenticate</button>
							</div>
						</div>
						<div class="text-center"><small><a class="text-inherit" href="recover.html">Forgot password?</a></small></div>
					</div>
					<div class="cardbox-footer text-center text-sm"><span class="mr-2">No account yet?</span><a class="text-inherit" href="{{route('admin.register.show')}}"><strong>Request Access</strong></a></div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
