<?php

namespace Stencil\Core;

if ( !defined( 'ABSPATH' ) ) exit;

class Storage {

	private static $instance;
	protected $namespace = '\\Stencil\\Core\\Storages';
    protected $includes = array(
    	'post'
    );
	
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->includes();
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
        foreach ( $this->includes as $include ) {
            $this->require_file( STL_PATH . "core/storages/$include.php" );
        }
    }
}

