@extends('admin.layouts.pages.logged')
@section('page')
<div class="row">
	<div class="col-xl-7 col-xs-12">
		<form class="form-validate" id="admin-user-create" name="form" method="POST" action="{{route('admin.user.store')}}" novalidate>
			@csrf
			<div class="cardbox">
				<div class="cardbox-heading">
					<small class="float-right text-danger">* Required fields</small>
				</div>
				<div class="cardbox-body">
					<div class="form-group">
						<label>Name <span class="text-danger">*</span></label>
						<input class="form-control {{ $errors->has('name') ? ' error' : '' }}" type="text" placeholder="John Doe" name="name" value="{{old('name')}}" required autofocus>
						@if ($errors->has('name'))
                            <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
                        @endif
					</div>
					<div class="form-group">
						<label>Email <span class="text-danger">*</span></label>
						<input class="form-control  {{ $errors->has('email') ? ' error' : '' }}" type="email" placeholder="email@example.com" value="{{old('email')}}" name="email" required>
						@if ($errors->has('email'))
                            <label id="email-error" class="error" for="email">{{ $errors->first('email') }}</label>
                        @endif
					</div>
					<div class="form-group">
						<label>Roles <span class="text-danger">*</span></label>
						<select class="form-control" id="roles" name="roles" multiple="multiple" required="">
							@foreach($roles as $role)
								<option value="{{$role->id}}" {{ (collect(old('roles'))->contains($role->id)) ? 'selected':'' }}>{{ucwords($role->name)}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="cardbox-body">
					<div class="clearfix">
						<div class="float-right">
							<button class="btn btn-primary btn-gradient" id="admin-user-create-submit-button" type="submit">Save</button>
						</div>
					</div>
				</div>
			</div>
			<!-- END panel-->
		</form>
	</div>
</div>

@endsection
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js" defer></script>
<script src="{{ asset('js/admin/user.js') }}" defer></script>
@endsection