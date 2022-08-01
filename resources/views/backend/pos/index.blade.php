@include('backend._layouts.head')

<style>
    .app-content-full-height.app-without-header .app-content {
        height: 93vh !important;
    }
</style>

<body class='pace-top'>
    <div id="app" class="app">
        @include('backend._layouts.header')
    </div>
	<!-- BEGIN #app -->
	<form method="post" action="{{ route('admin.pos.process') }}" id="app" class="app app-content-full-height app-without-sidebar app-without-header">
		@csrf
		<!-- BEGIN #content -->
		<div id="content" class="app-content p-1 ps-xl-4 pe-xl-4 pt-xl-3 pb-xl-3">
			<!-- BEGIN pos -->
			<div class="pos card" id="pos">
				<div class="pos-container card-body">     
                    <!-- BEGIN pos-menu -->
                    <div class="pos-menu">
                        <!-- BEGIN logo -->
                        <div class="logo">
                            <a href="index.html">
                               
                                <div class="logo-text"><span class="h1">OCT</span>POS</div>
                            </a>
                        </div>
                        <!-- END logo -->
                        <!-- BEGIN nav-container -->
                        <div class="nav-container">
                            <div data-scrollbar="true" data-height="100%" data-skip-mobile="true">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{ route('admin.pos') }}">
                                            <div class="card">
                                                <div class="card-body">
													<i class="fa fa-fw fa-shopping-cart" aria-hidden="true"></i>
													Point Of Sale
                                                </div>
                                                <div class="card-arrow">
                                                    <div class="card-arrow-top-left"></div>
                                                    <div class="card-arrow-top-right"></div>
                                                    <div class="card-arrow-bottom-left"></div>
                                                    <div class="card-arrow-bottom-right"></div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                            <div class="card">
                                                <div class="card-body">
													<i class="fa fa-fw fa-tachometer" aria-hidden="true"></i> Dashboard
                                                </div>
                                                <div class="card-arrow">
                                                    <div class="card-arrow-top-left"></div>
                                                    <div class="card-arrow-top-right"></div>
                                                    <div class="card-arrow-bottom-left"></div>
                                                    <div class="card-arrow-bottom-right"></div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.product.index') }}">
                                            <div class="card">
                                                <div class="card-body">
                                                    <i class="fa fa-fw fa-tag"></i> Products
                                                </div>
                                                <div class="card-arrow">
                                                    <div class="card-arrow-top-left"></div>
                                                    <div class="card-arrow-top-right"></div>
                                                    <div class="card-arrow-bottom-left"></div>
                                                    <div class="card-arrow-bottom-right"></div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-filter="pizza">
                                            <div class="card">
                                                <div class="card-body">
													<i class="fa fa-fw fa-balance-scale" aria-hidden="true"></i> Stock
                                                </div>
                                                <div class="card-arrow">
                                                    <div class="card-arrow-top-left"></div>
                                                    <div class="card-arrow-top-right"></div>
                                                    <div class="card-arrow-bottom-left"></div>
                                                    <div class="card-arrow-bottom-right"></div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-filter="drinks">
                                            <div class="card">
                                                <div class="card-body">
													<i class="fa fa-fw fa-handshake" aria-hidden="true"></i>Sales
                                                </div>
                                                <div class="card-arrow">
                                                    <div class="card-arrow-top-left"></div>
                                                    <div class="card-arrow-top-right"></div>
                                                    <div class="card-arrow-bottom-left"></div>
                                                    <div class="card-arrow-bottom-right"></div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-filter="desserts">
                                            <div class="card">
                                                <div class="card-body">
													<i class="fa fa-users" aria-hidden="true"></i>Customers
                                                </div>
                                                <div class="card-arrow">
                                                    <div class="card-arrow-top-left"></div>
                                                    <div class="card-arrow-top-right"></div>
                                                    <div class="card-arrow-bottom-left"></div>
                                                    <div class="card-arrow-bottom-right"></div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-filter="snacks">
                                            <div class="card">
                                                <div class="card-body">
													<i class="fa fa-fw fa-filter" aria-hidden="true"></i> Operations
                                                </div>
                                                <div class="card-arrow">
                                                    <div class="card-arrow-top-left"></div>
                                                    <div class="card-arrow-top-right"></div>
                                                    <div class="card-arrow-bottom-left"></div>
                                                    <div class="card-arrow-bottom-right"></div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- END nav-container -->
                    </div>
                    <!-- END pos-menu -->
                
                    <!-- BEGIN pos-content -->
                    <div class="pos-content">
                        <div class="pos-content-container h-100 p-4" data-scrollbar="true" data-height="100%">
							
                            <div class="row gx-4">
                                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 pb-4">
                                    <!-- BEGIN card -->
                                    <div class="card h-100">
                                        <div class="card-body h-100 p-1">
											<table class="table table-hover mb-0">
												<thead>
													<tr>
														<th style="width: 5%;"scope="col">#</th>
														<th style="width: 20%;" scope="col">Name</th>
														<th style="width: 20%;" scope="col">Barcode</th>
														<th style="width: 18%;" scope="col">Price</th>
														<th style="width: 18%;" scope="col">Quantity</th>
														<th style="width: 18%;" scope="col">Total</th>
													</tr>
												</thead>
												<tbody class="product__insertArea">
													<tr class="product__row display__none">
														<th scope="row">
															<span class="remove__btn">
																<i class="fas fa-lg fa-fw me-2 fa-times icon__danger"></i>
															</span>
														</th>
														<td class="product__nameArea">
															<span class="name__text"></span>
															<input type="hidden" class="name__value">
															<input type="hidden" class="product__idValue">
														</td>
														<td class="product__barcodeArea">
															<span class="barcode__text"></span>
															<input type="hidden" class="barcode__value">
														</td>
														<td class="product__priceArea">
															$<span class="price__text"></span>
															<input type="hidden" class="price__value">
															<input type="hidden" class="usd__value">
															<input type="hidden" class="zwl__value">
														</td>
														<td>
															<input style="width:80%;" min="0" value="0"
															class="form-control form-control-sm quantity__value">
														</td>
														<td class="product__totalArea">
															$<span class="product__totalText"></span>
															<input type="hidden" class="product__totalValue">
														</td>
													</tr>
												</tbody>
											</table>
                                        </div>
                                        <div class="card-arrow">
                                            <div class="card-arrow-top-left"></div>
                                            <div class="card-arrow-top-right"></div>
                                            <div class="card-arrow-bottom-left"></div>
                                            <div class="card-arrow-bottom-right"></div>
                                        </div>
                                    </div>
                                    <!-- END card -->
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- END pos-content -->

					<!-- BEGIN pos-sidebar -->
					<div class="pos-sidebar" id="pos-sidebar">
						<div class="h-100 d-flex flex-column p-0">
							<!-- BEGIN pos-sidebar-header -->
							<div class="pos-sidebar-header">
								<div class="back-btn">
									<button type="button" data-toggle-class="pos-mobile-sidebar-toggled" data-toggle-target="#pos" class="btn">
										<i class="bi bi-chevron-left"></i>
									</button>
								</div>
								<div class="title">Choose Currency</div>
								<div class="order currency">
									<label for="usd__currency" class="usd__currency">
										<input type="radio" name="currency" value="USD" id="usd__currency"> USD &nbsp;
									</label>
									<label for="zwl__currency" class="zwl__currency">
										<input type="radio" name="currency" value="ZWL" id="zwl__currency"> ZWL
									</label>
								</div>
							</div>
							<!-- END pos-sidebar-header -->
						
							<!-- BEGIN pos-sidebar-nav -->
							<div class="pos-sidebar-nav">
								<ul class="nav nav-tabs nav-fill">
									<li class="nav-item">
										<a class="nav-link active" href="#" data-bs-toggle="tab" data-bs-target="#orderHistoryTab">Barcode</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#" data-bs-toggle="tab" data-bs-target="#newOrderTab">Name Search</a>
									</li>
								</ul>
							</div>
							<!-- END pos-sidebar-nav -->
						
							<!-- BEGIN pos-sidebar-body -->
							<div class="pos-sidebar-body tab-content" data-scrollbar="true" data-height="100%">
								<!-- BEGIN #orderHistoryTab -->
								<div class="tab-pane fade h-100 show active" id="orderHistoryTab">
									<!-- BEGIN pos-order -->
									<div class="pos-order barcode__searchArea">
										<div class="input-group flex-nowrap">
                                            <input type="text" class="form-control" name="barcode" id="barcode__insert" autofocus
																							placeholder="Product Barcode">
                                            <span id="barcode__search" href="{{ route('admin.pos.searchbybarcode') }}" 
																		class="input-group-text btn barcode__search">
                                                <i class="fas fa-lg fa-fw me-2 fa-check"></i>
                                            </span>
                                        </div>
									</div>
									<!-- END pos-order -->
									<ul class="product__results display__none">
									</ul>
								</div>
								<!-- END #orderHistoryTab -->
								<!-- BEGIN #newOrderTab -->
								<div class="tab-pane fade h-100 " id="newOrderTab">
									<!-- BEGIN pos-order -->
									<div class="pos-order product__search">
                                        <div class="input-group flex-nowrap">
                                            <input type="text" class="form-control product__name" 
												placeholder="Product Name">
                                            <span id="search__btn" href="{{ route('admin.pos.searchbyname') }}" class="input-group-text btn search__btn">
                                                <i class="fas fa-lg fa-fw me-2 fa-search"></i>
                                            </span>
                                        </div>
									</div>
									<!-- END pos-order -->
									<ul class="product__results display__none">
									</ul>
								</div>
								<!-- END #orderHistoryTab -->
							</div>
							<!-- END pos-sidebar-body -->
						
							<!-- BEGIN pos-sidebar-footer -->
							<div class="pos-sidebar-footer">
								<div class="d-flex align-items-center mb-2">
									<div>Subtotal</div>
									<div class="flex-1 text-end h6 mb-0">
										$<span class="subtotal__text"></span>
										<input type="hidden" name="subtotal" class="subtotal__value">
										
									</div>
								</div>
								<div class="d-flex align-items-center mb-2">
									<div>Taxes (15%)</div>
									<div class="flex-1 text-end h6 mb-0">
										<span class="tax__text"></span>
										<input type="hidden" name="tax" class="tax__value">
									</div>
								</div>
								<hr />
								<div class="d-flex align-items-center mb-2">
									<div>Total</div>
									<div class="flex-1 text-end h4 mb-0">
										$<span class="grandtotal__text"></span>
										<input type="hidden" name="grandtotal" class="grandtotal__value">
									</div>
								</div>
								<div class="mt-3">
									<div class="btn-group d-flex">
										<a href="javascript:;" class="reset__amount btn btn-outline-default rounded-0 w-80px">
											<i class="bi bi-bell fa-lg"></i><br />
											<span class="small">Reset</span>
										</a>
										<a href="#" class="btn btn-outline-default rounded-0 w-80px">
											<i class="bi bi-receipt fa-fw fa-lg"></i><br />
											<span class="small">Bill</span>
										</a>
										<button type="submit" class="btn btn-outline-theme rounded-0 w-150px">
											<i class="bi bi-send-check fa-lg"></i><br />
											<span class="small">Submit Order</span>
										</button>
									</div>
								</div>
							</div>
							<!-- END pos-sidebar-footer -->
						</div>
					</div>
					<!-- END pos-sidebar -->
				</div>
				<div class="card-arrow">
					<div class="card-arrow-top-left"></div>
					<div class="card-arrow-top-right"></div>
					<div class="card-arrow-bottom-left"></div>
					<div class="card-arrow-bottom-right"></div>
				</div>
			</div>
			<!-- END pos -->
			
			<!-- BEGIN pos-mobile-sidebar-toggler -->
			<a href="#" class="pos-mobile-sidebar-toggler" data-toggle-class="pos-mobile-sidebar-toggled" data-toggle-target="#pos">
				<i class="bi bi-bag"></i>
				<span class="badge">5</span>
			</a>
			<!-- END pos-mobile-sidebar-toggler -->
		</div>
		<!-- END #content -->
		
		<!-- BEGIN btn-scroll-top -->
		<a href="#" data-toggle="scroll-to-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
		<!-- END btn-scroll-top -->
	</form>
	<!-- END #app -->
	
	<!-- BEGIN #modalPosItem -->
	<div class="modal modal-pos fade" id="modalPosItem">
		<div class="modal-dialog modal-lg">
			<div class="modal-content border-0">
				<div class="card">
					<div class="card-body p-0">
						<a href="#" data-bs-dismiss="modal" class="btn-close position-absolute top-0 end-0 m-4"></a>
						<div class="modal-pos-product">
							<div class="modal-pos-product-img">
								<div class="img" style="background-image: url(../assets/img/pos/product-1.jpg)"></div>
							</div>
							<div class="modal-pos-product-info">
								<div class="h4 mb-2">Grill Chicken Chop</div>
								<div class="text-white text-opacity-50 mb-2">
									chicken, egg, mushroom, salad
								</div>
								<div class="h4 mb-3">$10.99</div>
								<div class="d-flex mb-3">
									<a href="#" class="btn btn-outline-theme"><i class="fa fa-minus"></i></a>
									<input type="text" class="form-control w-50px fw-bold mx-2 bg-white bg-opacity-25 border-0 text-center" name="qty" value="1" />
									<a href="#" class="btn btn-outline-theme"><i class="fa fa-plus"></i></a>
								</div>
								<hr class="mx-n4" />
								<div class="mb-2">
									<div class="fw-bold">Size:</div>
									<div class="option-list">
										<div class="option">
											<input type="radio" id="size3" name="size" class="option-input" checked />
											<label class="option-label" for="size3">
												<span class="option-text">Small</span>
												<span class="option-price">+0.00</span>
											</label>
										</div>
										<div class="option">
											<input type="radio" id="size1" name="size" class="option-input" />
											<label class="option-label" for="size1">
												<span class="option-text">Large</span>
												<span class="option-price">+3.00</span>
											</label>
										</div>
										<div class="option">
											<input type="radio" id="size2" name="size" class="option-input" />
											<label class="option-label" for="size2">
												<span class="option-text">Medium</span>
												<span class="option-price">+1.50</span>
											</label>
										</div>
									</div>
								</div>
								<div class="mb-2">
									<div class="fw-bold">Add On:</div>
									<div class="option-list">
										<div class="option">
											<input type="checkbox" name="addon[sos]" value="true" class="option-input" id="addon1" />
											<label class="option-label" for="addon1">
												<span class="option-text">More BBQ sos</span>
												<span class="option-price">+0.00</span>
											</label>
										</div>
										<div class="option">
											<input type="checkbox" name="addon[ff]" value="true" class="option-input" id="addon2" />
											<label class="option-label" for="addon2">
												<span class="option-text">Extra french fries</span>
												<span class="option-price">+1.00</span>
											</label>
										</div>
										<div class="option">
											<input type="checkbox" name="addon[ms]" value="true" class="option-input" id="addon3" />
											<label class="option-label" for="addon3">
												<span class="option-text">Mushroom soup</span>
												<span class="option-price">+3.50</span>
											</label>
										</div>
										<div class="option">
											<input type="checkbox" name="addon[ms]" value="true" class="option-input" id="addon4" />
											<label class="option-label" for="addon4">
												<span class="option-text">Lemon Juice (set)</span>
												<span class="option-price">+2.50</span>
											</label>
										</div>
									</div>
								</div>
								<hr class="mx-n4" />
								<div class="row">
									<div class="col-4">
										<a href="#" class="btn btn-default h4 mb-0 d-block rounded-0 py-3" data-bs-dismiss="modal">Cancel</a>
									</div>
									<div class="col-8">
										<a href="#" class="btn btn-success d-flex justify-content-center align-items-center rounded-0 py-3 h4 m-0">Add to cart <i class="bi bi-plus fa-2x ms-2 my-n3"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-arrow">
						<div class="card-arrow-top-left"></div>
						<div class="card-arrow-top-right"></div>
						<div class="card-arrow-bottom-left"></div>
						<div class="card-arrow-bottom-right"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END #modalPosItem -->
	
    @include('backend._layouts.js')	

</body>
</html>
