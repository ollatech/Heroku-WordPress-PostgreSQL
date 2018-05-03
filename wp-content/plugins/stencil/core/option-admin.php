<?php

namespace Stencil\Core;

if ( !defined( 'ABSPATH' ) ) exit;

class Option_Admin {

	public function admin() {
		add_action('admin_enqueue_scripts', array($this, 'enqueue'));
		add_action( 'admin_menu', array($this, 'menu'), 16);
	}



	public function menu() {
		add_menu_page( 'Controls', 'Controls', 'manage_options', 'stencil-general', array($this, 'view'), 'dashicons-admin-generic' );
		$option = Option::instance();
		$pages = $option->get_options();
		foreach ($pages as $name => $option) {
			add_submenu_page(
				'stencil-general', 
				$option->title(), 
				$option->title(), 
				'manage_options', 
				'stencil-'.sanitize_key($name), 
				array($option, 'render'),
				0
			);
		}
	}

	public function enqueue() {
		

		wp_enqueue_style( 'rwmb', RWMB_CSS_URL . 'style.css', array(), RWMB_VER );
		if ( is_rtl() ) {
			wp_enqueue_style( 'rwmb-rtl', RWMB_CSS_URL . 'style-rtl.css', array(), RWMB_VER );
		}

			wp_enqueue_script( 'rwmb', RWMB_JS_URL . 'script.js', array( 'jquery' ), RWMB_VER, true );
		


	}
	public function view() {}

	private static $instance;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->includes();
			self::$instance->admin();
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

