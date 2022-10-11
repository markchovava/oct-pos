<!-- BEGIN #sidebar -->
<div id="sidebar" class="app-sidebar" >
			<!-- BEGIN scrollbar -->
			<div class="app-sidebar-content" style="overflow-y: scroll;">
				<!-- BEGIN menu -->
				<div class="menu">
					<div class="menu-header">Navigation</div>
					@if( Auth::check() && Auth::user()->role_id <= 4 )
					<div class="menu-item active">
						<a href="{{ route('admin.dashboard') }}" class="menu-link">
							<span class="menu-icon"><i class="bi bi-cpu"></i></span>
							<span class="menu-text">Dashboard</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="{{ route('admin.pos') }}" class="menu-link">
							<span class="menu-icon">
								<i class="bi bi-bag-check"></i>
							</span>
							<span class="menu-text">Point Of Sale</span>
						</a>
					</div>
					@if( Auth::user()->role_id <= 3 )
					<div class="menu-item has-sub">
						<a href="javascript:;" class="menu-link">
							<span class="menu-icon">
								<i class="fas fa-gift"></i>
							</span>
							<span class="menu-text">Products</span>
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="{{ route('admin.product.index') }}" class="menu-link">
									<span class="menu-text">Products</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="{{ route('admin.category.index') }}" class="menu-link">
									<span class="menu-text">Categories</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="{{ route('admin.brand.index') }}" class="menu-link">
									<span class="menu-text">Brand</span>
								</a>
							</div>
							
						</div>
					</div>
					<div class="menu-item has-sub">
						<a href="javascript:;" class="menu-link">
							<span class="menu-icon">
								<i class="fas fa-gift"></i>
							</span>
							<span class="menu-text">Operations</span>
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							@if( Auth::user()->role_id <= 2 )
							<div class="menu-item">
								<a href="{{ route('admin.operation.list') }}" class="menu-link">
									<span class="menu-text">Operation</span>
								</a>
							</div>
							@endif
							<div class="menu-item">
								<a href="{{ route('admin.order.index') }}" class="menu-link">
									<span class="menu-text">Orders</span>
								</a>
							</div>
						</div>
					</div>
					<div class="menu-item has-sub">
						<a href="javascript:;" class="menu-link">
							<span class="menu-icon">
								<i class="fas fa-gift"></i>
							</span>
							<span class="menu-text">Stock</span>
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="{{ route('admin.stock.index') }}" class="menu-link">
									<span class="menu-text">Product Stock</span>
								</a>
							</div>
						</div>
					</div>
					<!-- Order Items -->
					<div class="menu-item has-sub">
						<a href="javascript:;" class="menu-link">
							<span class="menu-icon">
								<i class="fas fa-gift"></i>
							</span>
							<span class="menu-text">Orders</span>
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="{{ route('admin.order.index') }}" class="menu-link">
									<span class="menu-text">All Orders</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="{{ route('admin.order.daily') }}" class="menu-link">
									<span class="menu-text">Daily Orders</span>
								</a>
							</div>
						</div>
					</div>	
					@endif
					@if( Auth::user()->role_id <= 2 )
					<!-- Users -->
					<div class="menu-item has-sub">
						<a href="#" class="menu-link">
							<span class="menu-icon">
								<i class="fas fa-gift"></i>
							</span>
							<span class="menu-text">Users</span>
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="{{ route('admin.user.index') }}" class="menu-link">
									<span class="menu-text">User List</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="{{ route('admin.operation.index') }}" class="menu-link">
									<span class="menu-text">Operators</span>
								</a>
							</div>
						</div>
					</div>
					<!-- Sales -->
					<div class="menu-item has-sub">
						<a href="javascript:;" class="menu-link">
							<span class="menu-icon">
								<i class="fas fa-gift"></i>
							</span>
							<span class="menu-text">Sales</span>
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="{{ route('admin.sale.index') }}" class="menu-link">
									<span class="menu-text">All Sales </span>
								</a>
							</div>
							<div class="menu-item">
								<a href="{{ route('admin.sale.daily') }}" class="menu-link">
									<span class="menu-text">Daily Sales</span>
								</a>
							</div>
						</div>
					</div>
					<div class="menu-item has-sub">
						<a href="javascript:;" class="menu-link">
							<span class="menu-icon">
								<i class="fas fa-gift"></i>
							</span>
							<span class="menu-text">Pricing</span>
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="{{ route('admin.price.index') }}" class="menu-link">
									<span class="menu-text">Price List</span>
								</a>
							</div>
						</div>
					</div>					
					<div class="menu-item has-sub">
						<a href="javascript:;" class="menu-link">
							<span class="menu-icon">
								<i class="bi bi-gear"></i>
							</span>
							<span class="menu-text">Settings</span>
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="{{ route('admin.info.index') }}" class="menu-link">
									<span class="menu-text">Company / Branch</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="{{ route('admin.role.index') }}" class="menu-link">
									<span class="menu-text">Roles</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="{{ route('admin.tax.edit') }}" class="menu-link">
									<span class="menu-text">Tax</span>
								</a>
							</div>
						</div>
					</div>
					@endif
					@endif
					
					
				</div>
				<!-- END menu -->
				<div class="p-3 px-4 mt-auto">
					<a href="javascript:;" class="btn d-block btn-outline-theme">
						<i class="fa fa-code-branch me-2 ms-n2 opacity-5"></i> Help & Support
					</a>
				</div>
			</div>
			<!-- END scrollbar -->
		</div>
		<!-- END #sidebar -->