
<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group input-slide">
		<div class="input">
			<input type="text" class="form-control" placeholder="What are you looking for?" aria-label="What are you looking for?" aria-describedby="basic-addon1">
		</div>
		<div class="input-group-prepend">
			<i class="fa fa-search"></i>
		</div>
	</div>
</form>