<?php

namespace Stencil\App\Helpers;

class View {

	public function logo($name, $args) {
		if(null === $logo_img = get_option('site_logo')) {
			$logo_img = $default;
		}
		if(!$logo_img) {
			$logo_img = get_stylesheet_directory_uri().'/assets/img/logo.png';
		}
		$output = '';
		ob_start();
		?>
		<a class="logo navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php echo $logo_img; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
		</a>
		<?php 
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