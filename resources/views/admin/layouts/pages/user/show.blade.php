@extends('admin.layouts.pages.logged')
@section('page')
<div class="row">
	<div class="col-xl-7 col-xs-12">
			<div class="cardbox">
				<div class="cardbox-heading">
					<span class="float-right">
						<a class="text-info mx-2" href="{{route('admin.user.edit', $user->id)}}">
							<i class="fas fa-pen"></i>
						</a>
						<!-- <a class="text-danger mx-2" href="javascript:void(0);">Delete</a> -->
					</small>
				</div>
				<div class="cardbox-body">
					<form class="form">
						@csrf
						<div class="form-group row">
							<label for="name" class="col-sm-2 col-form-label">Name:</label>
							<div class="col-sm-10">
								<input type="text" readonly class="form-control-plaintext" id="name" value="{{$user->name}}">
							</div>
						</div>
						<div class="form-group row">
							<label for="email" class="col-sm-2 col-form-label">Email:</label>
							<div class="col-sm-10">
								<input type="text" readonly class="form-control-plaintext" id="email" value="{{$user->email}}">
							</div>
						</div>
						<div class="form-group row">
							<label for="email" class="col-sm-2 col-form-label">Roles:</label>
							<div class="col-sm-10">
								@foreach($user->roles as $role)
									<span class="badge badge-secondary badge-pill p-2">{{$role->name}}</span>
								@endforeach
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- END panel-->
	</div>
</div>

@endsection
