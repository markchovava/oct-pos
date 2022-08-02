<!-- BEGIN #sidebar -->
<div id="sidebar" class="app-sidebar" >
			<!-- BEGIN scrollbar -->
			<div class="app-sidebar-content" style="overflow-y: scroll;">
				<!-- BEGIN menu -->
				<div class="menu">
					<div class="menu-header">Navigation</div>
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
					<div class="menu-item has-sub">
						<a href="#" class="menu-link">
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
						<a href="#" class="menu-link">
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
								<a href="#" class="menu-link">
									<span class="menu-text">Operators</span>
								</a>
							</div>
						</div>
					</div>
					<div class="menu-item has-sub">
						<a href="#" class="menu-link">
							<span class="menu-icon">
								<i class="fas fa-gift"></i>
							</span>
							<span class="menu-text">Orders</span>
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="#" class="menu-link">
									<span class="menu-text">Inbox</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="email_compose.html" class="menu-link">
									<span class="menu-text">Tst</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="email_detail.html" class="menu-link">
									<span class="menu-text">Detail</span>
								</a>
							</div>
						</div>
					</div>
					<div class="menu-item has-sub">
						<a href="#" class="menu-link">
							<span class="menu-icon">
								<i class="fas fa-gift"></i>
							</span>
							<span class="menu-text">Sales</span>
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="{{ route('admin.sale.index') }}" class="menu-link">
									<span class="menu-text">Sales Report</span>
								</a>
							</div>
						</div>
					</div>
					<div class="menu-item has-sub">
						<a href="#" class="menu-link">
							<span class="menu-icon">
								<i class="bi bi-envelope"></i>
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
						<a href="#" class="menu-link">
							<span class="menu-icon">
								<i class="bi bi-gear"></i>
							</span>
							<span class="menu-text">Settings</span>
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="{{ route('admin.role.index') }}" class="menu-link">
									<span class="menu-text">Roles</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="email_compose.html" class="menu-link">
									<span class="menu-text">Compose</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="email_detail.html" class="menu-link">
									<span class="menu-text">Detail</span>
								</a>
							</div>
						</div>
					</div>
					
					
				</div>
				<!-- END menu -->
				<div class="p-3 px-4 mt-auto">
					<a href="#" class="btn d-block btn-outline-theme">
						<i class="fa fa-code-branch me-2 ms-n2 opacity-5"></i> Help & Support
					</a>
				</div>
			</div>
			<!-- END scrollbar -->
		</div>
		<!-- END #sidebar -->