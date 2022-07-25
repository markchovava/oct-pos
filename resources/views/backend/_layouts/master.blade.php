@include('backend._layouts.head')

<body>
	<!-- BEGIN #app -->
	<div id="app" class="app">
		
        @include('backend._layouts.header')
		
		@include('backend._layouts.sidebar')
			
		<!-- BEGIN mobile-sidebar-backdrop -->
		<button class="app-sidebar-mobile-backdrop" data-toggle-target=".app" data-toggle-class="app-sidebar-mobile-toggled"></button>
		<!-- END mobile-sidebar-backdrop -->
		
		@yield('backend.master')
		
		<!-- BEGIN btn-scroll-top -->
		<a href="#" data-toggle="scroll-to-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
		<!-- END btn-scroll-top -->
	</div>
	<!-- END #app -->
	
	@include('backend._layouts.js')	

</body>
</html>
