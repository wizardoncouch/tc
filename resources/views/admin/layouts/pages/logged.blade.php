@extends('admin.layouts.app')
@section('content')
<!-- top navbar-->
<header class="header-container">
	<nav>
		<ul class="d-lg-none">
			<li><a class="sidebar-toggler menu-link menu-link-close" href="#"><span><em></em></span></a></li>
		</ul>
		<ul class="d-none d-sm-block">
			<li><a class="covermode-toggler menu-link menu-link-close" href="#"><span><em></em></span></a></li>
		</ul>
		<h2 class="header-title">
			@if(count($breadcrumbs) > 0)
				@foreach($breadcrumbs as $item)
					@if(is_array($item))
						<a href="{{$item['link']}}">{{$item['name']}}</a>
						<i class="fas fa-angle-right"></i>
					@else
						{{$item}}
					@endif
				@endforeach
			@else
				{{$title}}
			@endif
		</h2>
		<ul class="float-right">
			<li><a id="header-search" href="#"><i class="fas fa-search"></i></em></a></li>
			<li class="dropdown"><a class="dropdown-toggle has-badge" href="#" data-toggle="dropdown"><i class="fas fa-user"></i></a>
				<div class="dropdown-menu dropdown-menu-right dropdown-scale">
					<h6 class="dropdown-header text-right">
						@foreach(Auth::user()->roles as $role)
							<span class="badge badge-secondary badge-pill p-2">{{$role->name}}</span>
						@endforeach
					</h6>
					<div class="dropdown-divider" role="presentation"></div>
					<a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Settings</a>
					<div class="dropdown-divider" role="presentation"></div>
					<a class="dropdown-item" href="{{ route('admin.logout.post') }}"
					onclick="event.preventDefault();
					document.getElementById('logout-form').submit();">
					<i class="fas fa-sign-out-alt"></i>
					Logout
				</a>
				<form id="logout-form" action="{{ route('admin.logout.post') }}" method="POST" style="display: none;">
					@csrf
				</form>
			</div>
		</li>
	</ul>
</nav>
</header>
<!-- sidebar-->
<aside class="sidebar-container">
	<div class="brand-header">
		<div class="float-left pt-4 text-muted sidebar-close"><em class="ion-arrow-left-c icon-lg"></em></div><a class="brand-header-logo" href="#">
			<span class="brand-header-logo-text">teamconsole.io</span></a>
		</div>
		<div class="sidebar-content">
			<div class="sidebar-toolbar">
				<div class="sidebar-toolbar-background"></div>
				<div class="sidebar-toolbar-content text-center">
					<a href="#" class="text-light">
						<i class="fas fa-user fa-3x"></i>
					</a>
					<div class="mt-3">
						<div class="lead">{{ Auth::user()->name }}</div>
					</div>
				</div>
			</div>
			<nav class="sidebar-nav">
				<ul>
					<li class="{{ $name == 'dashboard' ? 'active' :''}}">
						<a href="{{route('admin.dashboard.index')}}">
							<span class="float-right nav-label"></span>
							<span class="nav-icon"><em class="fas fa-tachometer-alt fa-sm"></em></span><span>Dashboard</span>
						</a>
					</li>
					<li class="{{ $name == 'clients' || strpos('-'.$name, 'client') > 0 ? 'active' :''}}">
						<a href="{{route('admin.client.index')}}">
							<span class="float-right nav-label"></span>
							<span class="nav-icon"><em class="fas fa-users"></em></span><span>Clients</span>
						</a>
					</li>
					<li class="{{ $name == 'templates' || strpos('-'.$name, 'template') > 0 ? 'active' :''}}">
						<a href="{{route('admin.template.index')}}">
							<span class="float-right nav-label"></span>
							<span class="nav-icon"><em class="fas fa-book"></em></span><span>Templates</span>
						</a>
					</li>
					<li class="{{ $name == 'users' || strpos('-'.$name, 'user') > 0 ? 'active' :''}}">
						<a href="{{route('admin.user.index')}}">
							<span class="float-right nav-label"></span>
							<span class="nav-icon"><em class="fas fa-users-cog"></em></span><span>Users</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</aside>
	<!-- Main section-->
	<main class="main-container">
		<!-- Page content-->
		<section class="section-container">
			<div class="container-fluid">
				@yield('page')
			</div>
		</section>
		<!-- Page footer-->
		<footer class="footer-container">
			<div class="text-center py-3">
				&copy; teamconsole.io {{date('Y')}}
			</div>
		</footer>
	</main>
</div>
<!-- Search template-->
<div class="modal modal-top fade modal-search" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="modal-search-form">
					<form action="#">
						<div class="input-group">
							<div class="input-group-prepend">
								<button class="btn btn-flat" type="button" data-dismiss="modal"><em class="ion-arrow-left-c icon-lg text-muted"></em></button>
							</div>
							<input class="form-control header-input-search" type="text" placeholder="Search..">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Search template-->
@endsection
