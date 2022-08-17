@php
$route = url()->current();
@endphp

<!-- ================== BEGIN core-css ================== -->
<link href="{{ asset('assets/hud/assets/css/vendor.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/hud/assets/css/app.min.css') }}" rel="stylesheet" />
<!-- ================== END core-css ================== -->

<link href="{{ asset('assets/custom/css/calculator.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/custom/css/custom.css') }}" rel="stylesheet" />

@if( $route == route('admin.dashboard') )
<!-- ================== BEGIN dashboard-css ================== -->
<link href="{{ asset('assets/hud/assets/plugins/jvectormap-next/jquery-jvectormap.css') }}" rel="stylesheet" />
<!-- ================== END page-css ================== -->
@endif

