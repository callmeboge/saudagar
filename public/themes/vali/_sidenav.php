 <!-- Side-Nav-->
 <aside class="main-sidebar hidden-print">
	<section class="sidebar">
		<div class="user-panel">
		<div class="pull-left image">
			<img class="img-circle"
				src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" 
				alt="User Image"></div>
		<div class="pull-left info">
			<p><?= $current_user->display_name ?></p>
			<p class="designation"><?= $current_user->role_name ?></p>
		</div>
		</div>
		
		<!-- Sidebar Menu-->
		<ul class="sidebar-menu">

		<li class="active"><a href="<?= site_url('vali') ?>">
			<i class="fa fa-dashboard"></i>
			<span>Dashboard</span></a>
		</li>
		<li><a href="<?= site_url('users/profile') ?>">
			<i class="fa fa-user"></i>
			<span>User</span></a>
		</li>
		<li><a href="#invoice"><i class="fa fa-usd"></i><span>Invoice</span></a></li>
		<li><a href="#ads"><i class="fa fa-buysellads"></i><span>Ads</span></a></li>
		<li>
			<a href="<?= site_url('/taxonomy/forms') ?>"><i class="fa fa-edit"></i><span>Forms</span></a>
		</li>
		<li><a href="<?= site_url('vali/table') ?>">
			<i class="fa fa-th-list"></i>
			<span>Tables</span></a>
		</li>
		<li><a href="<?= site_url('product')?>">
			<i class="fa fa-cubes"></i>
			<span>Product</span></a>
		</li>

		</ul>
		<div style="color:#ffffff;text-transform:uppercase;font-weight:700;padding:1rem 2rem"><span>Interface</span></div>
	
		<ul class="sidebar-menu">
		<?php
					$this->load->model('product/product_model');
					$list = $this->product_model->productList();
					Menus::addProduct($list);
			echo 	Menus::show();
		?>
		</ul>
	</section>
</aside>