<section class="ux-section ">
	<div class="container">
		<div class="row">
		<div class="col-md-3">
				<?php echo Stencil_Render()->widget('sidebar-left'); ?>
			</div>
			<div class="col-md-6">
				{{{children}}}
			</div>
			<div class="col-md-3">
				<?php echo Stencil_Render()->widget('sidebar-right'); ?>
			</div>
		</div>
	</div>
</section>