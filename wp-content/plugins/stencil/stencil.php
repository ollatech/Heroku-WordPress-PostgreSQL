<?php
namespace Stencil;

define( 'STL_VERSION', '1.0.0' );
define( 'STL_PATH', plugin_dir_path( __FILE__ ) );
define( 'STL_ELEMENTOR_PATH', plugin_dir_path( __FILE__ ).'elementor/' );
define( 'STL_URL', plugin_dir_url( __FILE__ ) );
define( 'STL_ASSET_URL', plugin_dir_url( __FILE__ ).'assets/' );


if (!defined('ABSPATH'))
	exit;

final class Stencil {

	private static $instance;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->loader();
			self::$instance->assets();
			self::$instance->core();
			self::$instance->app();
			self::$instance->modules();
		}
		return self::$instance;
	}
	public function __clone() {
		_doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'stencil'), '1.6');
	}

	public function __wakeup() {
		_doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'stencil'), '1.6');
	}

	private function loader() {
		require_once STL_PATH . 'assets.php';
		require_once STL_PATH . 'autoloader.php';
		require_once STL_PATH . 'vendors/loader.php';
		require_once STL_PATH . 'core/loader.php';
		require_once STL_PATH . 'app/loader.php';
		require_once STL_PATH . 'modules/loader.php';
		\Stencil\Autoloader::run();
		\Stencil\Vendors\Loader::instance();
		\Stencil\Core\Loader::instance();
		\Stencil\App\Loader::instance();
		\Stencil\Modules\Loader::instance();
	}

	private function assets() {
		\Stencil\Assets::instance();
	}


	private function core() {
		\Stencil\Core\Admin::instance();
		\Stencil\Core\Option::instance();
		\Stencil\Core\Option_Admin::instance();
		\Stencil\Core\Element::instance();
		\Stencil\Core\Element_Admin::instance();
		\Stencil\Core\Posttype::instance();
		\Stencil\Core\Field::instance();
		\Stencil\Core\Template::instance();
	}

	private function app() {
		\Stencil\App\Elements::instance();
        \Stencil\App\Posts::instance();
        \Stencil\App\Options::instance();
        \Stencil\App\Option_Groups::instance();
	}

	private function modules() {
		\Stencil\Modules\Elementor\Elementor::instance();
	}
}



function stl_core() {
	return Stencil::instance();
}

stl_core();
