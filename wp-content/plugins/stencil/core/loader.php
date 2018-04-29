<?php

namespace Stencil\Core;


if (!defined('ABSPATH'))
    exit;

final class Loader {

    protected $namespace = 'Stencil\\Core';
    protected $apps = array(
        'base/option-group-base',
        'base/option-base',
        'base/field-base',
        'base/post-base',
        'factory/option-page',
        'factory/option',
        'factory/post',
        'posttype',
        'field',
        'element',
        'element-admin',
        'option',
        'option-admin',
        'template'
    );
    
    private static $instance;

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


    protected function includes() {
        foreach ( $this->apps as $app ) {
            $this->require_file( STL_PATH . "core/$app.php" );
        }
    }

    protected function require_file( $file ) {
        if ( file_exists( $file ) ) {
            require_once $file;
            return true;
        }
        return false;
    }
}
