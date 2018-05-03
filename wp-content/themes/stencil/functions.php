<?php

define( 'STL_THEME_VER', '1.0.0' );
define( 'STL_THEME', get_template_directory() .'/' );
define( 'STL_THEME_ASSET', get_template_directory_uri().'/assets/' );

function stencil_dev() {
	if(get_option('site_mode') === 'prod') {
		return false;
	}
	return true;
}

add_filter( 'body_class', 'stl_body_class' );
function stl_body_class( $classes ) {
	$classes[] = 'ux';
	if ( is_page_template( 'page-example.php' ) ) {
		$classes[] = 'example';
	}
	return $classes;
}


class Stencil_Theme	{

	protected $includes = [
		'layouts/loader',
		'woocommerce/functions'
	];

	public function loader() {
		Stencil_Layout_Loader::instance();
	}



	public function init() {
		add_action('plugins_loaded', array($this, 'load_textdomain'));
		add_action('wp_enqueue_scripts', array($this, 'assets'));
		register_activation_hook( __FILE__, array($this, 'activate') );
		register_deactivation_hook(__FILE__, array($this, 'deactivate') );
	} 


	public function assets() {
		wp_register_script( 'stencil_vendor', STL_THEME_ASSET.'js/stencil.vendor.js', array('jquery'), STL_THEME_VER, true);
		wp_register_script( 'stencil', STL_THEME_ASSET.'js/stencil.min.js', array('stencil_vendor'), STL_THEME_VER, true);
		wp_register_style( 'stencil_vendor', STL_THEME_ASSET.'css/stencil.vendor.css');
		wp_register_style( 'stencil', STL_THEME_ASSET.'css/stencil.min.css', array('stencil_vendor'),  STL_THEME_VER, false );
	}

	public function activate() {
		
	}

	public function deactivate() {

	}

	public function load_textdomain() {
		load_plugin_textdomain( 'stencil', FALSE, basename( dirname( __FILE__ ) ).'/assets/langs/' );
	}

	


    protected function includes() {
        foreach ( $this->includes as $include ) {
            $this->require_file( STL_THEME . "$include.php" );
        }
    }
    protected function require_file( $file ) {
        if ( file_exists( $file ) ) {
            require_once $file;
            return true;
        }
        return false;
    }
	private static $instance;
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->includes();
			self::$instance->loader();
			self::$instance->init();
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
$STL = Stencil_Theme::instance();
