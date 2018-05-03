<?php

class Stencil_Layout_Loader	{

	protected $includes = [
		'register'
	];


	public function init() {
	
	
	} 

    protected function includes() {
        foreach ( $this->includes as $include ) {
            $this->require_file( STL_THEME . "layouts/$include.php" );
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
