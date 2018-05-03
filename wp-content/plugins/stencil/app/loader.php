<?php

namespace Stencil\App;


if (!defined('ABSPATH'))
    exit;

class Loader extends \Stencil_Loader {
	
    protected $includes = array(
        'app/posts',  
        'app/elements',
        'app/option-groups',
        'app/options',
        'app/widgets',
        'app/templates',
        'app/helpers'
    );



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
}
