<?php

namespace Stencil\Core;

if ( !defined( 'ABSPATH' ) ) exit;

class View {

	public function logo($default = null, $link = true) {
		if(null === $logo_img = get_option('site_logo')) {
			$logo_img = $default;
		}
		if(!$logo_img) {
			$logo_img = get_stylesheet_directory_uri().'/assets/img/logo.png';
		}
		?>
		<a class="logo navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php echo $logo_img; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
		</a>
		<?php
	}

	public function menu($location, $configs = []) {
		wp_nav_menu(array_merge([
			'theme_location'  => $location, 
			'container'       => 'div',
			'container_id'    => 'main_navbar',
			'container_class' => 'navbar-collapse offcanvas-collapse',
			'menu_id'         => false,
			'menu_class'      => 'nav navbar-nav mr-auto',
			'depth'           => 4,
			'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
			'walker'          => new \WP_Bootstrap_Navwalker()
		], $configs));
	}

	public function widget($name) {
		if(is_active_sidebar( Stencil_Data()->location().$name )) {
			$name = Stencil_Data()->location().$name;
		}
		
		?>
		<?php if ( is_active_sidebar( $name ) ) : ?>
			<div class="widget-area sidebar">
				<?php dynamic_sidebar( $name ); ?>
			</div>
		<?php endif; ?>

		<?php
	}

	public function pagination($pages = '', $range = 2) 
	{  
		$showitems = ($range * 2) + 1;  
		global $paged;
		if(empty($paged)) $paged = 1;
		if($pages == '')
		{
			global $wp_query; 
			$pages = $wp_query->max_num_pages;
			
			if(!$pages)
				$pages = 1;		 
		}   
		
		if(1 != $pages)
		{
			echo '<nav aria-label="Page navigation" role="navigation">';
			echo '<span class="sr-only">Page navigation</span>';
			echo '<ul class="pagination justify-content-center ft-wpbs">';
			
			echo '<li class="page-item disabled hidden-md-down d-none d-lg-block"><span class="page-link">Page '.$paged.' of '.$pages.'</span></li>';
			
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) 
				echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link(1).'" aria-label="First Page">&laquo;<span class="hidden-sm-down d-none d-md-block"> First</span></a></li>';
			
			if($paged > 1 && $showitems < $pages) 
				echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($paged - 1).'" aria-label="Previous Page">&lsaquo;<span class="hidden-sm-down d-none d-md-block"> Previous</span></a></li>';
			
			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
					echo ($paged == $i)? '<li class="page-item active"><span class="page-link"><span class="sr-only">Current Page </span>'.$i.'</span></li>' : '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($i).'"><span class="sr-only">Page </span>'.$i.'</a></li>';
			}
			
			if ($paged < $pages && $showitems < $pages) 
				echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($paged + 1).'" aria-label="Next Page"><span class="hidden-sm-down d-none d-md-block">Next </span>&rsaquo;</a></li>';  
			
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) 
				echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($pages).'" aria-label="Last Page"><span class="hidden-sm-down d-none d-md-block">Last </span>&raquo;</a></li>';
			
			echo '</ul>';
			echo '</nav>';
        //echo '<div class="pagination-info mb-5 text-center">[ <span class="text-muted">Page</span> '.$paged.' <span class="text-muted">of</span> '.$pages.' ]</div>';	 	
		}
	}

	
	public function breadcrumb($custom_home_icon = false, $custom_post_types = false) {
		wp_reset_query();
		global $post;
		
		$is_custom_post = $custom_post_types ? is_singular( $custom_post_types ) : false;
		
		if (!is_front_page() && !is_home()) {
			echo '<ul>';
			echo '<li><a href="';
			echo get_option('home');
			echo '">';
			if( $custom_home_icon )
				echo $custom_home_icon;
			else
				bloginfo('name');
			echo "</a></li>";
			if ( has_category() ) {
				echo '<li class="active"><a href="'.esc_url( get_permalink( get_page( get_the_category($post->ID) ) ) ).'">';
				the_category(', ');
				echo '</a></li>';
			}
			if ( is_category() || is_single() || $is_custom_post ) {
				if ( is_category() )
					echo '<li class="active"><a href="'.esc_url( get_permalink( get_page( get_the_category($post->ID) ) ) ).'">'.get_the_category($post->ID)[0]->name.'</a></li>';
				if ( $is_custom_post ) {
					echo '<li class="active"><a href="'.get_option('home').'/'.get_post_type_object( get_post_type($post) )->name.'">'.get_post_type_object( get_post_type($post) )->label.'</a></li>';
					if ( $post->post_parent ) {
						$home = get_page(get_option('page_on_front'));
						for ($i = count($post->ancestors)-1; $i >= 0; $i--) {
							if (($home->ID) != ($post->ancestors[$i])) {
								echo '<li><a href="';
								echo get_permalink($post->ancestors[$i]); 
								echo '">';
								echo get_the_title($post->ancestors[$i]);
								echo "</a></li>";
							}
						}
					}
				}
				if ( is_single() )
					echo '<li class="active">'.get_the_title($post->ID).'</li>';
			} elseif ( is_page() && $post->post_parent ) {
				$home = get_page(get_option('page_on_front'));
				for ($i = count($post->ancestors)-1; $i >= 0; $i--) {
					if (($home->ID) != ($post->ancestors[$i])) {
						echo '<li><a href="';
						echo get_permalink($post->ancestors[$i]); 
						echo '">';
						echo get_the_title($post->ancestors[$i]);
						echo "</a></li>";
					}
				}
				echo '<li class="active">'.get_the_title($post->ID).'</li>';
			} elseif (is_page()) {
				echo '<li class="active">'.get_the_title($post->ID).'</li>';
			} elseif (is_404()) {
				echo '<li class="active">404</li>';
			}
			echo '</ul>';
		}
	}

	public function copyright() {

	}


	

	private static $instance;
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	public function __clone() {
		_doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'stencil'), '1.6');
	}

	public function __wakeup() {
		_doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'stencil'), '1.6');
	}
}