<!-- BEGIN #header -->
<div id="header" class="app-header">
	<!-- BEGIN desktop-toggler -->
	<div class="desktop-toggler">
		<button type="button" class="menu-toggler" data-toggle-class="app-sidebar-collapsed" data-dismiss-class="app-sidebar-toggled" data-toggle-target=".app">
			<span class="bar"></span>
			<span class="bar"></span>
			<span class="bar"></span>
		</button>
	</div>
	<!-- BEGIN desktop-toggler -->
	
	<!-- BEGIN mobile-toggler -->
	<div class="mobile-toggler">
		<button type="button" class="menu-toggler" data-toggle-class="app-sidebar-mobile-toggled" data-toggle-target=".app">
			<span class="bar"></span>
			<span class="bar"></span>
			<span class="bar"></span>
		</button>
	</div>
	<!-- END mobile-toggler -->
	
	<!-- BEGIN brand -->
	<div class="brand">
		<a href="index.html" class="brand-logo">
			<span class="brand-img">
				<span class="brand-img-text text-theme">O</span>
			</span>
			<span class="brand-text">OCT POS</span>
		</a>
	</div>
	<!-- END brand -->
	
	<!-- BEGIN menu -->
	<div class="menu">
		<div class="menu-item dropdown">
			<a href="#" data-toggle-class="app-header-menu-search-toggled" data-toggle-target=".app" class="menu-link">
				<div class="menu-icon"><i class="bi bi-search nav-icon"></i></div>
			</a>
		</div>
		<div class="menu-item dropdown dropdown-mobile-full">
			<a href="#" data-bs-toggle="dropdown" data-bs-display="static" class="menu-link">
				<div class="menu-icon"><i class="bi bi-grid-3x3-gap nav-icon"></i></div>
			</a>
			<div class="dropdown-menu fade dropdown-menu-end w-300px text-center p-0 mt-1">
				<div class="row row-grid gx-0">
					
					<div class="col-4">
						<a href="{{ route('admin.pos') }}" target="_blank" class="dropdown-item text-decoration-none p-3 bg-none">
							<div><i class="bi bi-hdd-network h2 opacity-5 d-block my-1"></i></div>
							<div class="fw-500 fs-10px text-white">POS SYSTEM</div>
						</a>
					</div>
					<div class="col-4">
						<a href="{{ route('admin.profile.view') }}" class="dropdown-item text-decoration-none p-3 bg-none">
							<div class="position-relative">
								<i class="bi bi-circle-fill position-absolute text-theme top-0 mt-n2 me-n2 fs-6px d-block text-center w-100"></i>
								<i class="bi bi-sliders h2 opacity-5 d-block my-1"></i>
							</div>
							<div class="fw-500 fs-10px text-white">Profile</div>
						</a>
					</div>
					<div class="col-4">
						<a href="{{ route('admin.info.index') }}" class="dropdown-item text-decoration-none p-3 bg-none">
							<div><i class="bi bi-terminal h2 opacity-5 d-block my-1"></i></div>
							<div class="fw-500 fs-10px text-white">HELPER</div>
						</a>
					</div>
				</div>

			</div>
		</div>
		<div class="menu-item dropdown dropdown-mobile-full">
			<a href="{{ route('admin.user.status') }}" class="menu-link user__active">
				<div class="menu-icon"><i class="bi bi-bell nav-icon"></i></div>
				<input type="hidden" class="user__status" name="user_status" 
				value="{{ isset($operation_status->status) ? $operation_status->status : '' }}">
				@if(isset($operation_status->status))
					@if( intval($operation_status->status) == 1 )
						<div class="menu-badge bg-theme"></div>
					@endif
				@endif
			</a>
		</div>
		<div class="menu-item dropdown dropdown-mobile-full">
			<a href="#" data-bs-toggle="dropdown" data-bs-display="static" class="menu-link">
				<div class="menu-img online">
					<img src="{{ (!empty(auth()->user()->image)) ? url('storage/images/users/' . auth()->user()->image) : url('storage/images/users/no_image.jpg') }}" 
					alt="Profile" height="60" style="height:60px; aspect-ratio:5/4; object-fit:cover;" />
				</div>
				<div class="menu-text d-sm-block d-none">{{ auth()->user()->name }}</div>
			</a>
			<div class="dropdown-menu dropdown-menu-end me-lg-3 fs-11px mt-1">
				<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.profile.view') }}">PROFILE <i class="bi bi-person-circle ms-auto text-theme fs-16px my-n1"></i></a>
				<a class="dropdown-item d-flex align-items-center" href="{{ route('admin.profile.password') }}">PASSWORD <i class="bi bi-gear ms-auto text-theme fs-16px my-n1"></i></a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">LOGOUT <i class="bi bi-toggle-off ms-auto text-theme fs-16px my-n1"></i></a>
			</div>
		</div>
	</div>
	<!-- END menu -->
	
	<!-- BEGIN menu-search -->
	<form class="menu-search" method="POST" name="header_search_form">
		<div class="menu-search-container">
			<div class="menu-search-icon"><i class="bi bi-search"></i></div>
			<div class="menu-search-input">
				<input type="text" class="form-control form-control-lg" placeholder="Search menu..." />
			</div>
			<div class="menu-search-icon">
				<a href="#" data-toggle-class="app-header-menu-search-toggled" data-toggle-target=".app"><i class="bi bi-x-lg"></i></a>
			</div>
		</div>
	</form>
	<!-- END menu-search -->
</div>
<!-- END #header -->