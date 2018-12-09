@extends('admin.layouts.app')

@section('content')
<div class="page-container bg-blue-grey-900">
	<div class="d-flex align-items-center align-items-center-ie bg-gradient-primary">
		<div class="fw">
			<div class="container container-xs">
				<form class="cardbox cardbox-flat text-white form-validate text-color" id="user-register" action="" method="POST" name="admin_register" novalidate="">
					@csrf
					<div class="cardbox-heading">
						<div class="cardbox-title text-center">Request Access</div>
					</div>
					<div class="cardbox-body">
						<div class="px-5">
							@if (session('status'))
							    <div class="alert alert-success">
							        {{ session('status') }}
							    </div>
							@endif
							<div class="form-group">
								<input class="form-control form-control-inverse {{ $errors->has('name') ? ' error' : '' }}" value="{{ old('name', 'Alex Culango') }}" type="text" name="name" placeholder="name" required>
								@if ($errors->has('name'))
                                    <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
                                @endif
							</div>
							<div class="form-group">
								<input class="form-control form-control-inverse {{ $errors->has('email') ? ' error' : '' }}" value="{{ old('email', 'alex.culango@gmail.com') }}" type="email" name="email" placeholder="email" required autofocus>
								@if ($errors->has('email'))
                                    <label id="email-error" class="error" for="email">{{ $errors->first('email') }}</label>
                                @endif
							</div>
							<div class="text-center my-4">
								<button class="btn btn-lg btn-gradient btn-oval btn-info btn-block" id="submit-button" type="submit">Request Access</button>
							</div>
						</div>
					</div>
					<div class="cardbox-footer text-center text-sm"><span class="mr-2">Already have an account?</span><a class="text-inherit" href="{{route('admin.login.show')}}"><strong>Login</strong></a></div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
