@extends('admin.layouts.pages.logged')
@section('page')
<div class="row">
	<div class="col-xl-7 col-xs-12">
		<div class="cardbox">
			<div class="cardbox-heading clearfix">
                <a class="btn btn-info btn-sm ml-2 float-right" href="{{ route('admin.user.create') }}">
                    <i class="fas fa-plus text-sm mr-1"></i> Add
                </a>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Roles</th>
						<th>Active</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@if(count($users) > 0)
						@foreach($users as $user)
						<tr>
							<td class="pl-3">
								<a href="{{route('admin.user.show', $user->id)}}">
									{{$user->name}}
								</a>
							</td>
							<td class="pl-3">{{$user->email}}</td>
							<td>
								@foreach($user->roles as $role)
									<span class="ml-1 badge badge-secondary badge-pill p-2">{{ucwords($role->name)}}</span>
								@endforeach
							</td>
							<td><i class="fas fa-check ml-3 {{$user->active ? 'text-primary': 'text-light'}}"></i></td>
							<td>
								<a class="mx-2" href="{{route('admin.user.edit', $user->id)}}">
									<i class="fas fa-pen text-info"></i>
								</a>
								<!-- <i class="fas fa-trash text-warning mx-2"></i> -->
							</td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="3">No results found.</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-xl-5 col-xs-12">
		@if(count($user_requests) > 0)

			<div class="cardbox bg-secondary text-light">
				<div class="cardbox-heading"><strong>Requesting Access</strong></div>
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						@foreach($user_requests as $user)
						<tr>
							<td class="pl-3">{{$user->name}}</td>
							<td class="pl-3">{{$user->email}}</td>
							<td align="center">
								<span class="mx-2">
									<a class="text-info" href="{{ route('admin.user.edit', $user->id) }}?mode=approve">
										<i class="fas fa-thumbs-up"></i>
									</a>
								</span>
								<span class="mx-2">
									<a class="text-warning" href="{{ route('admin.register.deny') }}" onclick="event.preventDefault();var conf=confirm('Are you sure you want to deny {{$user->name}}?'); if(conf){document.getElementById('deny-form-{{$user->id}}').submit();}else{return false;}">
										<i class="fas fa-minus-circle"></i>
									</a>
									<form id="deny-form-{{$user->id}}" action="{{ route('admin.register.deny') }}" method="POST" style="display: none;">
										@csrf
										<input type="hidden" value="{{$user->id}}" name="id"/>
									</form>
								</span>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		@endif
	</div>
</div>
@endsection
