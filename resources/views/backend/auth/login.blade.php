@include('backend._layouts.head')

<body class='pace-top'>
	<!-- BEGIN #app -->
	<div id="app" class="app app-full-height app-without-header">
		<!-- BEGIN login -->
		<div class="login">
			<!-- BEGIN login-content -->
			<div class="login-content">
				<form method="POST" action="{{ route('login') }}">
					@csrf
					<h1 class="text-center">Sign In</h1>
					<div class="text-white text-opacity-50 text-center mb-4">
						Please enter the detials below.
					</div>
					<div class="mb-3">
						<label class="form-label">Email Address <span class="text-danger">*</span></label>
						<input type="email" name="email" class="form-control form-control-lg bg-white bg-opacity-5" value="" placeholder="" />
						@error('email')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="mb-3">
						<div class="d-flex">
							<label class="form-label">Password <span class="text-danger">*</span></label>
							<a href="{{ route('password.request') }}" class="ms-auto text-white text-decoration-none text-opacity-50">Forgot password?</a>
						</div>
						<input type="password" name="password" class="form-control form-control-lg bg-white bg-opacity-5" value="" placeholder="" />
						@error('password')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="mb-3">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="remember" value="" id="customCheck1" />
							<label class="form-check-label" for="customCheck1">Remember me</label>
						</div>
					</div>
					<button type="submit" class="btn btn-outline-theme btn-lg d-block w-100 fw-500 mb-3">Sign In</button>
					<div class="text-center text-white text-opacity-50">
						Don't have an account yet? <a href="{{ route('register') }}">Sign up</a>.
					</div>
				</form>
			</div>
			<!-- END login-content -->
		</div>
		<!-- END login -->
		
		<!-- BEGIN btn-scroll-top -->
		<a href="#" data-toggle="scroll-to-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
		<!-- END btn-scroll-top -->
	</div>
	<!-- END #app -->
	
    @include('backend._layouts.js')	
</body>
</html>
