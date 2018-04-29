<?php

namespace Stencil\Core;

if ( !defined( 'ABSPATH' ) ) exit;


class Element_Admin {


	public function admin() {
		add_action( 'admin_menu', array($this, 'menu'), 16);
	}

	public function menu() {
		add_menu_page( 'Elements', 'Elements', 'manage_options', 'stencil-elements', array($this, 'view'), 'dashicons-admin-generic' );
		add_menu_page( 'Templates', 'Templates', 'manage_options', 'stencil-templates', array($this, 'view'), 'dashicons-admin-generic' );
	}

	public function view() {


	}

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

