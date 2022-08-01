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
						<span class="flex-grow-1">POINT OF SALE</span>
						<a href="{{ route('admin.pos') }}" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
					</div>
					<!-- END title -->
					<!-- BEGIN stat-lg -->
					<div class="row align-items-center mb-2">
						<div class="col-7">
							<h3 class="mb-0">33</h3>
						</div>
						<div class="col-5">
						</div>
					</div>
					<!-- END stat-lg -->
					<!-- BEGIN stat-sm -->
					<div class="small text-white text-opacity-50 text-truncate">
						<i class="far fa-user fa-fw me-1"></i> 33 Active at the moment.
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
						<span class="flex-grow-1">SALES</span>
						<a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
					</div>
					<!-- END title -->
					<!-- BEGIN stat-lg -->
					<div class="row align-items-center mb-2">
						<div class="col-7">
							<h3 class="mb-0">$35.2K</h3>
						</div>
						<div class="col-5">
							<div class="mt-n2" data-render="apexchart" data-type="line" data-title="Visitors" data-height="30"></div>
						</div>
					</div>
					<!-- END stat-lg -->
					<!-- BEGIN stat-sm -->
					<div class="small text-white text-opacity-50 text-truncate">
						<i class="fa fa-chevron-up fa-fw me-1"></i> 20.4% more than last week<br />
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
						<span class="flex-grow-1">STOCK</span>
						<a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
					</div>
					<!-- END title -->
					<!-- BEGIN stat-lg -->
					<div class="row align-items-center mb-2">
						<div class="col-7">
							<h3 class="mb-0">4,490</h3>
						</div>
						<div class="col-5">
							<div class="mt-n3 mb-n2" data-render="apexchart" data-type="pie" data-title="Visitors" data-height="45"></div>
						</div>
					</div>
					<!-- END stat-lg -->
					<!-- BEGIN stat-sm -->
					<div class="small text-white text-opacity-50 text-truncate">
						<i class="fas fa-lg fa-fw me-2 fa-info"></i> 1212 more than last week
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
						<span class="flex-grow-1">PRODUCTS</span>
						<a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
					</div>
					<!-- END title -->
					<!-- BEGIN stat-lg -->
					<div class="row align-items-center mb-2">
						<div class="col-7">
							<h3 class="mb-0">4.5TB</h3>
						</div>
						<div class="col-5">
							<div class="mt-n3 mb-n2" data-render="apexchart" data-type="donut" data-title="Visitors" data-height="45"></div>
						</div>
					</div>
					<!-- END stat-lg -->
					<!-- BEGIN stat-sm -->
					<div class="small text-white text-opacity-50 text-truncate">
						<i class="fa fa-chevron-up fa-fw me-1"></i> 5.3% more than last week<br />
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
						<span class="flex-grow-1">ORDERS</span>
						<a href="{{ route('admin.order.index') }}" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
					</div>
					<!-- END title -->
					<!-- BEGIN stat-lg -->
					<div class="row align-items-center mb-2">
						<div class="col-7">
							<h3 class="mb-0">4.2m</h3>
						</div>
						<div class="col-5">
							<div class="mt-n2" data-render="apexchart" data-type="bar" data-title="Visitors" data-height="30"></div>
						</div>
					</div>
					<!-- END stat-lg -->
					<!-- BEGIN stat-sm -->
					<div class="small text-white text-opacity-50 text-truncate">
						<i class="fa fa-chevron-up fa-fw me-1"></i> 33.3% more than last week<br />
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
						<span class="flex-grow-1">CUSTOMERS</span>
						<a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
					</div>
					<!-- END title -->
					<!-- BEGIN stat-lg -->
					<div class="row align-items-center mb-2">
						<div class="col-7">
							<h3 class="mb-0">$35.2K</h3>
						</div>
						<div class="col-5">
							<div class="mt-n2" data-render="apexchart" data-type="line" data-title="Visitors" data-height="30"></div>
						</div>
					</div>
					<!-- END stat-lg -->
					<!-- BEGIN stat-sm -->
					<div class="small text-white text-opacity-50 text-truncate">
						<i class="fa fa-chevron-up fa-fw me-1"></i> 20.4% more than last week<br />
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
						<span class="flex-grow-1">OPERATIONS</span>
						<a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
					</div>
					<!-- END title -->
					<!-- BEGIN stat-lg -->
					<div class="row align-items-center mb-2">
						<div class="col-7">
							<h3 class="mb-0">4,490</h3>
						</div>
						<div class="col-5">
							<div class="mt-n3 mb-n2" data-render="apexchart" data-type="pie" data-title="Visitors" data-height="45"></div>
						</div>
					</div>
					<!-- END stat-lg -->
					<!-- BEGIN stat-sm -->
					<div class="small text-white text-opacity-50 text-truncate">
						<i class="fa fa-chevron-up fa-fw me-1"></i> 59.5% more than last week<br />
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
						<span class="flex-grow-1">MESSAGES</span>
						<a href="#" data-toggle="card-expand" class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
					</div>
					<!-- END title -->
					<!-- BEGIN stat-lg -->
					<div class="row align-items-center mb-2">
						<div class="col-7">
							<h3 class="mb-0">4.5TB</h3>
						</div>
						<div class="col-5">
							<div class="mt-n3 mb-n2" data-render="apexchart" data-type="donut" data-title="Visitors" data-height="45"></div>
						</div>
					</div>
					<!-- END stat-lg -->
					<!-- BEGIN stat-sm -->
					<div class="small text-white text-opacity-50 text-truncate">
						<i class="fa fa-chevron-up fa-fw me-1"></i> 5.3% more than last week<br />
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
