<?php


add_filter( 'body_class', 'stl_body_class' );
function stl_body_class( $classes ) {
	$classes[] = 'ux';
    if ( is_page_template( 'page-example.php' ) ) {
        $classes[] = 'example';
    }
    return $classes;
}