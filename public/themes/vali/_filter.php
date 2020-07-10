<style>
	.filter-sidebar
	{
		right: 0 !important;
		left: inherit;
		background: #eeeeee;

		position: fixed;
		top: 0;
		padding-top: 50px;
		min-height: 100vh;
		width: 230px;
		z-index: 810;
		-webkit-box-shadow: 0px 8px 17px rgba(0, 0, 0, 0.2);
				box-shadow: 0px 8px 17px rgba(0, 0, 0, 0.2);
		-webkit-transition: width 0.3s ease-in-out, -webkit-transform 0.3s ease-in-out;
		transition: width 0.3s ease-in-out, -webkit-transform 0.3s ease-in-out;
		-o-transition: transform 0.3s ease-in-out, width 0.3s ease-in-out;
		transition: transform 0.3s ease-in-out, width 0.3s ease-in-out;
		transition: transform 0.3s ease-in-out, width 0.3s ease-in-out, -webkit-transform 0.3s ease-in-out;

	}
	.content-wrapper
	{
		margin-right: 230px;
	}

	.sidebar-filter
	{
		list-style: none;
		margin: 0;
		padding: 0;
		white-space: nowrap;
		overflow: hidden;
	}

	.sidebar-filter hr{
		border-top: 1px solid #cecece;
	}
</style>
 <!-- filter -->
 <aside class="filter-sidebar hidden-print">
	<section class="sidebar">
			<div class="user-panel">
				<h2>Filter</h2>
			</div>
			<div class="sidebar-filter">
				<div class="col-xs-12">
					<label>Sorot</label>
					<div class="animated-checkbox">
						<label><input type="checkbox" name="feature_property" value="1"><span class="label-text">Feature</span></label>
						<label><input type="checkbox" name="slider_property" value="1"><span class="label-text">Slider</span></label>
					</div>
				</div>
				<div class="clearfix"></div>
				<hr>
				<div class="col-xs-12">
					<label for="">Gambar Latar</label>
					<input type="text" class="form-control input-sm" id="fieldCoverProperty" name="cover" value="" placeholder="../path/to/file">
				</div>
				
				<div class="clearfix"></div>
				<hr>
				<div class="col-xs-12">
				<?php 
					$option = array(
						0 => 'Unpublish',
						1 => 'Publish',
						2 => 'Draf',
					);
					echo 
					form_dropdown('post_status', $option, 0, 'Status', 'class="form-control input-sm"');
					
				?>	
				</div>
				
			</div>
			
	</section>
</aside>