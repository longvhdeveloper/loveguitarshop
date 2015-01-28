<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="img/avatar3.png" class="img-circle" alt="User Image" />
			</div>
			<div class="pull-left info">
				<p>Hello, Jane</p>

				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<!-- search form -->
		<form action="#" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control"
					placeholder="Search..." /> <span class="input-group-btn">
					<button type='submit' name='search' id='search-btn'
						class="btn btn-flat">
						<i class="fa fa-search"></i>
					</button>
				</span>
			</div>
		</form>
		<!-- /.search form -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li id="dashboard-menu"><a href="index.html"> <i class="fa fa-dashboard"></i>
					<span>Dashboard</span>
			</a></li>
			<li class="treeview">
				<a href="javascript:void(0)"><i class="fa fa-users"></i><span>User</span>
					<i class="fa pull-right fa-angle-left"></i>
				</a>
				<ul class="treeview-menu">
					<li id="user-menu"><a style="margin-left: 10px;" href="<?php echo base_url() . $module . '/user';?>"> <i class="fa fa-angle-double-right"></i><span>User</span></a></li>
					<li id="level-menu"><a style="margin-left: 10px;" href="<?php echo base_url() . $module . '/level';?>"> <i class="fa fa-angle-double-right"></i><span>Level</span></a></li>
				</ul>
			</li>
            <li id="vendor-menu"><a href="<?php echo base_url(). $module . '/vendor' ?>"> <i class="fa fa-male"></i><span>Vendor</span></a></li>
            <li id="productcategory-menu"><a href="<?php echo base_url(). $module . '/productcategory' ?>"> <i class="fa fa-square"></i><span>Product category</span></a></li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>