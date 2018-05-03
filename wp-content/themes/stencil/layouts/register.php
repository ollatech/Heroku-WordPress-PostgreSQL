<?php


use Stencil\Core\Template;

register_nav_menus( array(
	'main_menu'    => __( 'Top Menu', 'stencil' ),
	'footer_menu' => __( 'Footer Menu', 'stencil' ),
) );


function stencil_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Navbar Start', 'stencil' ),
		'id'            => 'navbar-start',
		'description'   => __( '.', 'stencil' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Navbar End', 'stencil' ),
		'id'            => 'navbar-end',
		'description'   => __( '.', 'stencil' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar Left', 'stencil' ),
		'id'            => 'sidebar-left',
		'description'   => __( '.', 'stencil' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar Right', 'stencil' ),
		'id'            => 'sidebar-right',
		'description'   => __( '.', 'stencil' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'stencil' ),
		'id'            => 'sidebar-1',
		'description'   => __( '.', 'stencil' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'stencil' ),
		'id'            => 'footer-1',
		'description'   => __( '.', 'stencil' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'stencil' ),
		'id'            => 'footer-2',
		'description'   => __( '', 'stencil' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 3', 'stencil' ),
		'id'            => 'footer-3',
		'description'   => __( '.', 'stencil' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'stencil' ),
		'id'            => 'footer-4',
		'description'   => __( '.', 'stencil' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'stencil_widgets_init' );

/*
$template = Template::instance();
$template->add('header', 'standard' , 'header/header.php');
$template->add('header', 'v2' , 'header/header-v2.php');
$template->add('header', 'v3' , 'header/header-v3.php');
$template->add('header', 'v4' , 'header/header-v4.php');

$template->add('footer', 'standard' , 'footer/footer.php');
$template->add('footer', 'v2' , 'footer/footer-v2.php');
$template->add('footer', 'v3' , 'footer/footer-v3.php');
$template->add('footer', 'v4' , 'footer/footer-v4.php');

$template->add('cover', 'standard' , 'cover/cover.php');
$template->add('cover', 'image' , 'cover/cover-image.php');
$template->add('cover', 'video' , 'cover/cover-video.php');
$template->add('cover', 'blank' , 'cover/cover-blank.php');


$template->add('layout', 'standard' , 'layout/layout.php');
$template->add('layout', '2column' , 'layout/layout-2column.php');
$template->add('layout', '3column' , 'layout/layout-3column.php');
$template->add('layout', '2column_left' , 'layout/layout-3column_left.php');
$template->add('layout', 'canvas' , 'layout/layout-canvas.php');


$template->add('content', 'post' , 'content/post.php');
$template->add('content', 'page' , 'content/page.php');
$template->add('content', 'v2' , 'content/content-v2.php');
$template->add('content', 'v3' , 'content/content-v3.php');
$template->add('content', 'v4' , 'content/content-v4.php');

$template->add('collection', 'standard' , 'collection/collection.php');
$template->add('collection', 'v2' , 'collection/collection-v2.php');
$template->add('collection', 'v3' , 'collection/collection-v3.php');
$template->add('collection', 'v4' , 'collection/collection-v4.php');

$template->add('loop', 'standard' , 'loop/loop.php');
$template->add('loop', 'v2' , 'loop/loop-v2.php');
$template->add('loop', 'v3' , 'loop/loop-v3.php');
$template->add('loop', 'v4' , 'loop/loop-v4.php');
*/