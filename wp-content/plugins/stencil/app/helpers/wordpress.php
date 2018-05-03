<?php

namespace Stencil\App\Helpers;

class Wordpress {

	public function sidebar($name, $args) {
		$output = '';
		ob_start();
		?>
		<?php if ( is_active_sidebar( $name ) ) : ?>
			<div class="widget-area sidebar">
				<?php dynamic_sidebar( $name ); ?>
			</div>
		<?php endif;
		$output .= ob_get_clean();
		return $output;
	}

	public function menu($name, $args){
		$configs = [];
		if(isset($args[$name]) && is_array($args[$name])) {
			$configs = $args[$name];
		}
		$output = '';
		ob_start();
		wp_nav_menu(array_merge([
			'theme_location'  => $name, 
			'container'       => 'div',
			'container_class' => 'navbar-collapse offcanvas-collapse',
			'menu_id'         => false,
			'menu_class'      => 'nav navbar-nav mr-auto',
			'depth'           => 4,
			'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
			'walker'          => new \WP_Bootstrap_Navwalker()
		], $configs));
		$output .= ob_get_clean();
		return $output;
	}

	public function option($name, $args){
		$configs = [];
		if(isset($args[$name]) && is_array($args[$name])) {
			$configs = $args[$name];
		}
		$output = '';
		ob_start();
		echo get_option('site_logo');
		$output .= ob_get_clean();
		return $output;
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