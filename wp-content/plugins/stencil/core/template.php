<?php

namespace Stencil\Core;

if ( !defined( 'ABSPATH' ) ) exit;

class Template {

	public function init() {
		add_filter( 'template_include', array($this, 'template'), 99 );
	}

	function template( $template ) {

		$provided_template_array = explode( '/', $template );
		$subfolder = get_post_type();
		$plugin_template = STL_PATH . "core/template/common.php";
		if( file_exists( $plugin_template ) ) {
			//return $plugin_template;
		}
		return $template;
	}
 

	private static $instance;
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->includes();
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
	public function includes() {
		
	}
	protected function require_file( $file ) {
		if ( file_exists( $file ) ) {
			require_once $file;
			return true;
		}
		return false;
	}
}