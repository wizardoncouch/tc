@extends('admin.layouts.pages.logged')
@section('page')
<div class="row">
	<div class="col-xl-7 col-xs-12">
		<div class="cardbox">
			<div class="cardbox-heading">
				<small class="float-right text-danger">* Required fields</small>
			</div>
			<div class="cardbox-body">
				@if($mode == 'approve')
				<form class="form-validate" id="admin-user-approve" name="form" method="POST" action="{{route('admin.user.update')}}" novalidate>
					@csrf
					<input type="hidden" name="id" value="{{$user->id}}" />
					<input type="hidden" name="approve" value="{{true}}" />
					<div class="form-group row">
						<label for="email" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-10">
							<input type="text" readonly class="form-control-plaintext" id="email" value="{{$user->email}}">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Roles <span class="text-danger">*</span></label>
						<div class="col-sm-10">
							<select class="form-control" id="roles" name="roles" multiple="multiple" required="">
								@foreach($roles as $role)
								<option value="{{$role->id}}" {{ (collect(old('roles', $user->roles->pluck('id')->toArray()))->contains($role->id)) ? 'selected':'' }}>{{ucwords($role->name)}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="cardbox-body">
						<div class="clearfix">
							<div class="float-right">
								<button class="btn btn-primary" id="admin-user-approve-submit-button" type="submit">Approve</button>
							</div>
							<div class="float-right mr-3">
								<a class="btn btn-danger" href="{{ route('admin.register.deny') }}" onclick="event.preventDefault();var conf=confirm('Are you sure you want to deny {{$user->name}}?'); if(conf){document.getElementById('deny-form-{{$user->id}}').submit();}else{return false;}">
									Deny
								</a>
							</div>
						</div>
					</div>
				</form>
				<form id="deny-form-{{$user->id}}" action="{{ route('admin.register.deny') }}" method="POST" style="display: none;">
					@csrf
					<input type="hidden" value="{{$user->id}}" name="id"/>
				</form>
				@else
				<form class="form-validate" id="admin-user-edit" name="form" method="POST" action="{{route('admin.user.update')}}" novalidate>
					@csrf
					<input type="hidden" name="id" value="{{$user->id}}" />
					<div class="form-group">
						<label>Name <span class="text-danger">*</span></label>
						<input class="form-control" type="text" placeholder="John Doe" name="name" value="{{old('name', $user->name)}}" required autofocus>
					</div>
					<div class="form-group">
						<label>Email <span class="text-danger">*</span></label>
						<input class="form-control" type="email" placeholder="email@example.com" value="{{old('email', $user->email)}}" name="email" required>
					</div>
					<div class="form-group">
						<label>Roles <span class="text-danger">*</span></label>
						<select class="form-control" id="roles" name="roles" multiple="multiple" required="">
							@foreach($roles as $role)
							<option value="{{$role->id}}" {{ (collect(old('roles', $user->roles->pluck('id')->toArray()))->contains($role->id)) ? 'selected':'' }}>{{ucwords($role->name)}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<div class="custom-control custom-checkbox">
                    		<input class="custom-control-input" id="active" name="active" value="1" type="checkbox" {{$user->active ? 'checked': ''}}>
                    		<label class="custom-control-label" for="active">Active</label>
                        </div>
					</div>
				</div>
				<div class="cardbox-body">
					<div class="clearfix">
						<div class="float-right">
							<button class="btn btn-primary" id="admin-user-create-submit-button" type="submit">Update</button>
						</div>
					</div>
				</div>
			</form>
			@endif
		</div>
		<!-- END panel-->
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