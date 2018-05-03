<?php

$args = array_merge([
	'post_type' => $posttype,
	'post_per_page' => 10
], $args);
$query = new WP_Query( $args );
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		$data = Stencil_Data()->extract_post();
		echo Stencil_Template()->load('item'. 'mini', $data);
	}
}
wp_reset_postdata();