@extends('backend._layouts.master')

@section('backend.master')

<!-- BEGIN #content -->
<div id="content" class="app-content">
	<!-- BEGIN row -->
	<div class="row">
		
		<!-- BEGIN col-3 -->
		<div class="col-xl-3 col-lg-6">
			<!-- BEGIN card -->
			<div class="card mb-3">
				<!-- BEGIN card-body -->
				<div class="card-body">
					<!-- BEGIN title -->
					<div class="d-flex fw-bold small mb-3">
						<span class="flex-grow-1"><a href="{{ route('admin.pos') }}">POINT OF SALE</a></span>
						<a href="{{ route('admin.pos') }}" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
					</div>
					<!-- END title -->
					<!-- BEGIN stat-lg -->
					<div class="row align-items-center mb-2">
						<div class="col-7">
							<h3 class="mb-0">{{ count($operations) }}</h3>
						</div>
						<div class="col-5">
						</div>
					</div>
					<!-- END stat-lg -->
					<!-- BEGIN stat-sm -->
					<div class="small text-white text-opacity-50 text-truncate">
						<i class="far fa-user fa-fw me-1"></i> {{ count($operations) }} Active at the moment.
					</div>
					<!-- END stat-sm -->
				</div>
				<!-- END card-body -->
				
				<!-- BEGIN card-arrow -->
				<div class="card-arrow">
					<div class="card-arrow-top-left"></div>
					<div class="card-arrow-top-right"></div>
					<div class="card-arrow-bottom-left"></div>
					<div class="card-arrow-bottom-right"></div>
				</div>
				<!-- END card-arrow -->
			</div>
			<!-- END card -->
		</div>
		<!-- END col-3 -->
		
		<!-- BEGIN col-3 -->
		<div class="col-xl-3 col-lg-6">
			<!-- BEGIN card -->
			<div class="card mb-3">
				<!-- BEGIN card-body -->
				<div class="card-body">
					<!-- BEGIN title -->
					<div class="d-flex fw-bold small mb-3">
						<span class="flex-grow-1"><a href="{{ route('admin.sale.index') }}">USD DAILY SALES</a></span>
						<a href="{{ route('admin.sale.index') }}" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
					</div>
					<!-- END title -->
					<!-- BEGIN stat-lg -->
					<div class="row align-items-center mb-2">
						<div class="col-7">
							@php
								$usd_calculate = (int)$usd_sales /100;
								$usd_decimal = number_format($usd_calculate, 2, '.', '');
							@endphp
							<h3 class="mb-0">${{ $usd_decimal }}</h3>
						</div>
						<div class="col-5">
							
						</div>
					</div>
					<!-- END stat-lg -->
					<!-- BEGIN stat-sm -->
					<div class="small text-white text-opacity-50 text-truncate">
						<i class="fa fa-chevron-up fa-fw me-1"></i> ${{ $usd_decimal }} today.<br />
					</div>
					<!-- END stat-sm -->
				</div>
				<!-- END card-body -->
				
				<!-- BEGIN card-arrow -->
				<div class="card-arrow">
					<div class="card-arrow-top-left"></div>
					<div class="card-arrow-top-right"></div>
					<div class="card-arrow-bottom-left"></div>
					<div class="card-arrow-bottom-right"></div>
				</div>
				<!-- END card-arrow -->
			</div>
			<!-- END card -->
		</div>
		<!-- END col-3 -->

		<!-- BEGIN col-3 -->
		<div class="col-xl-3 col-lg-6">
			<!-- BEGIN card -->
			<div class="card mb-3">
				<!-- BEGIN card-body -->
				<div class="card-body">
					<!-- BEGIN title -->
					<div class="d-flex fw-bold small mb-3">
						<span class="flex-grow-1"><a href="{{ route('admin.sale.index') }}">ZWL DAILY SALES</a></span>
						<a href="{{ route('admin.sale.index') }}" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
					</div>
					<!-- END title -->
					<!-- BEGIN stat-lg -->
					<div class="row align-items-center mb-2">
						<div class="col-7">
							@php
								$zwl_calculate = (int)$zwl_sales /100;
								$zwl_decimal = number_format($zwl_calculate, 2, '.', '');
							@endphp
							<h3 class="mb-0">${{ $zwl_decimal }}</h3>
						</div>
						<div class="col-5">
							
						</div>
					</div>
					<!-- END stat-lg -->
					<!-- BEGIN stat-sm -->
					<div class="small text-white text-opacity-50 text-truncate">
						<i class="fa fa-chevron-up fa-fw me-1"></i> ${{ $zwl_decimal }} today.<br />
					</div>
					<!-- END stat-sm -->
				</div>
				<!-- END card-body -->
				
				<!-- BEGIN card-arrow -->
				<div class="card-arrow">
					<div class="card-arrow-top-left"></div>
					<div class="card-arrow-top-right"></div>
					<div class="card-arrow-bottom-left"></div>
					<div class="card-arrow-bottom-right"></div>
				</div>
				<!-- END card-arrow -->
			</div>
			<!-- END card -->
		</div>
		<!-- END col-3 -->
		
		<!-- BEGIN col-3 -->
		<div class="col-xl-3 col-lg-6">
			<!-- BEGIN card -->
			<div class="card mb-3">
				<!-- BEGIN card-body -->
				<div class="card-body">
					<!-- BEGIN title -->
					<div class="d-flex fw-bold small mb-3">
						<span class="flex-grow-1"><a href="{{ route('admin.stock.index') }}">STOCK</a></span>
						<a href="{{ route('admin.stock.index') }}" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
					</div>
					<!-- END title -->
					<!-- BEGIN stat-lg -->
					<div class="row align-items-center mb-2">
						<div class="col-7">
							<h3 class="mb-0">{{ $stock }}</h3>
						</div>
						<div class="col-5">
							
						</div>
					</div>
					<!-- END stat-lg -->
					<!-- BEGIN stat-sm -->
					<div class="small text-white text-opacity-50 text-truncate">
						<i class="fas fa-lg fa-fw me-2 fa-info"></i> {{ $stock }} is the current stock.
					</div>
					<!-- END stat-sm -->
				</div>
				<!-- END card-body -->
				
				<!-- BEGIN card-arrow -->
				<div class="card-arrow">
					<div class="card-arrow-top-left"></div>
					<div class="card-arrow-top-right"></div>
					<div class="card-arrow-bottom-left"></div>
					<div class="card-arrow-bottom-right"></div>
				</div>
				<!-- END card-arrow -->
			</div>
			<!-- END card -->
		</div>
		<!-- END col-3 -->
		
		<!-- BEGIN col-3 -->
		<div class="col-xl-3 col-lg-6">
			<!-- BEGIN card -->
			<div class="card mb-3">
				<!-- BEGIN card-body -->
				<div class="card-body">
					<!-- BEGIN title -->
					<div class="d-flex fw-bold small mb-3">
						<span class="flex-grow-1"><a href="{{ route('admin.product.index') }}"> PRODUCTS </a></span>
						<a href="{{ route('admin.product.index') }}" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
					</div>
					<!-- END title -->
					<!-- BEGIN stat-lg -->
					<div class="row align-items-center mb-2">
						<div class="col-7">
							<h3 class="mb-0">{{ count($products) }}</h3>
						</div>
						<div class="col-5">
						</div>
					</div>
					<!-- END stat-lg -->
					<!-- BEGIN stat-sm -->
					<div class="small text-white text-opacity-50 text-truncate">
						<i class="fa fa-chevron-up fa-fw me-1"></i> {{ count($products) }} product types in store.<br />
					</div>
					<!-- END stat-sm -->
				</div>
				<!-- END card-body -->
				
				<!-- BEGIN card-arrow -->
				<div class="card-arrow">
					<div class="card-arrow-top-left"></div>
					<div class="card-arrow-top-right"></div>
					<div class="card-arrow-bottom-left"></div>
					<div class="card-arrow-bottom-right"></div>
				</div>
				<!-- END card-arrow -->
			</div>
			<!-- END card -->
		</div>
		<!-- END col-3 -->

		<!-- BEGIN col-3 -->
		<div class="col-xl-3 col-lg-6">
			<!-- BEGIN card -->
			<div class="card mb-3">
				<!-- BEGIN card-body -->
				<div class="card-body">
					<!-- BEGIN title -->
					<div class="d-flex fw-bold small mb-3">
						<span class="flex-grow-1"> <a href="{{ route('admin.order.index') }}">ORDERS </a></span>
						<a href="{{ route('admin.order.index') }}" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
					</div>
					<!-- END title -->
					<!-- BEGIN stat-lg -->
					<div class="row align-items-center mb-2">
						<div class="col-7">
							<h3 class="mb-0">{{ count($orders) }}</h3>
						</div>
						<div class="col-5">
							
						</div>
					</div>
					<!-- END stat-lg -->
					<!-- BEGIN stat-sm -->
					<div class="small text-white text-opacity-50 text-truncate">
						<i class="fa fa-chevron-up fa-fw me-1"></i> {{ count($orders) }} more than last week. <br />
					</div>
					<!-- END stat-sm -->
				</div>
				<!-- END card-body -->
				
				<!-- BEGIN card-arrow -->
				<div class="card-arrow">
					<div class="card-arrow-top-left"></div>
					<div class="card-arrow-top-right"></div>
					<div class="card-arrow-bottom-left"></div>
					<div class="card-arrow-bottom-right"></div>
				</div>
				<!-- END card-arrow -->
			</div>
			<!-- END card -->
		</div>
		<!-- END col-3 -->
		

		
	</div>
	<!-- END row -->
</div>
<!-- END #content -->

@endsection
