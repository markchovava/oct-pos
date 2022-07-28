@include('backend._layouts.head')

<body class='pace-top'>
	<!-- BEGIN #app -->
	<div id="app" class="app app-full-height app-without-header">
		<!-- BEGIN register -->
		<div class="register">
			<!-- BEGIN register-content -->
			<div class="register-content">
				<form action="{{ route('register.process') }}" method="POST" name="register_form">
					@csrf
					<h1 class="text-center">Sign Up</h1>
					<p class="text-white text-opacity-50 text-center">One Admin ID is all you need to access all the Admin services.</p>
					<div class="mb-3">
						<label class="form-label">Name <span class="text-danger">*</span></label>
						<input type="text" name="name" class="form-control form-control-lg bg-white bg-opacity-5" placeholder="e.g Rudo Rwedu" value="" />
						@error('name')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="mb-3">
						<label class="form-label">Email Address <span class="text-danger">*</span></label>
						<input type="email" name="email" class="form-control form-control-lg bg-white bg-opacity-5" placeholder="username@address.com" value="" />
					</div>
					<div class="mb-3">
						<label class="form-label">Password <span class="text-danger">*</span></label>
						<input type="password" name="password" class="form-control form-control-lg bg-white bg-opacity-5" value="" />
						@error('password')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="mb-3">
						<label class="form-label">Confirm Password <span class="text-danger">*</span></label>
						<input type="password" name="password_confirmation" class="form-control form-control-lg bg-white bg-opacity-5" value="" />
						@error('password_confirmation')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="mb-3">
						<label class="form-label">Gender <span class="text-danger">*</span></label>
						<select class="form-select form-select-lg bg-white bg-opacity-5" required="required">
							<option value="Female">Female</option>
							<option value="Male">Male</option>
						</select>
					</div>
					<div class="mb-3">
						<label class="form-label">Date of Birth (MM/YY/DD) <span class="text-danger">*</span></label>
						<div class="row gx-2">
							<div class="col-6">
								<select name="month" class="form-select form-select-lg bg-white bg-opacity-5">
									<option value="January">January </option>
									<option value="February">February </option>
									<option value="March">March </option>
									<option value="April">April </option>
									<option value="May">May </option>
									<option value="June">June </option>
									<option value="July">July </option>
									<option value="August">August </option>
									<option value="September">September </option>
									<option value="October">October </option>
									<option value="November">November </option>
									<option value="December">December </option>
								</select>
							</div>
							<div class="col-3">
								<input type="number" name="year" placeholder="YYYY" class="form-control form-control-lg bg-white bg-opacity-5" />
							</div>
							<div class="col-3">
								<input type="number" name="day" min="1" max="31" placeholder="DD" class="form-control form-control-lg bg-white bg-opacity-5" />
							</div>
						</div>
					</div>
					<div class="mb-3">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="customCheck1" required="required"/>
							<label class="form-check-label" for="customCheck1">I have read and agree to the <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</label>
						</div>
					</div>
					<div class="mb-3">
						<button type="submit" class="btn btn-outline-theme btn-lg d-block w-100">Sign Up</button>
					</div>
					<div class="text-white text-opacity-50 text-center">
						Already have an Admin ID? <a href="{{ route('login') }}">Sign In</a>
					</div>
				</form>
			</div>
			<!-- END register-content -->
		</div>
		<!-- END register -->
		
		<!-- BEGIN btn-scroll-top -->
		<a href="#" data-toggle="scroll-to-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
		<!-- END btn-scroll-top -->
	</div>
	<!-- END #app -->
	
    @include('backend._layouts.js')	
</body>
</html>
