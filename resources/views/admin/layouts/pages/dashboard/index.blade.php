@extends('admin.layouts.pages.logged')
@section('page')
<div class="row">
	<div class="col-xl-8 col-xs-12">
		<div class="row">
			<div class="col-xl-12">
				<div class="cardbox">
					<div class="cardbox-heading"><strong>Client Subscription Needs Approval</strong></div>
					<table class="table">
						<thead>
							<tr>
								<th>Company</th>
								<th>Domain</th>
								<th>Email</th>
							</tr>
						</thead>
						<tbody>
							@if(count($client_requests) > 0)
								@foreach($client_requests as $client)
								<tr>
									<th scope="row"><a href="javascript:void(0);">{{$client->name}}</a></th>
									<td><strong>{{$client->slug}}</strong>.teamconsole.io</td>
									<td>{{$client->email}}</td>
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
		</div>
		<div class="row">
			<div class="col-xl-12">
				<div class="cardbox">
					<div class="cardbox-heading"><strong>Users Requesting Access</strong></div>
					<table class="table">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							@if(count($user_requests) > 0)
								@foreach($user_requests as $user)
								<tr>
									<td>{{$user->name}}</td>
									<td>{{$user->email}}</td>
									<td align="center">
										<span class="mx-2">
											<a class="text-success" href="{{ route('admin.user.edit', $user->id) }}?mode=approve">
												<i class="fas fa-thumbs-up"></i>
											</a>
										</span>
										<span class="mx-2">
											<a class="text-danger" href="{{ route('admin.register.deny') }}" onclick="event.preventDefault();var conf=confirm('Are you sure you want to deny {{$user->name}}?'); if(conf){document.getElementById('deny-form-{{$user->id}}').submit();}else{return false;}">
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
							@else
								<tr>
									<td colspan="3">No results found.</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-4 col-xs-12">
		&nbsp;
	</div>
</div>
@endsection