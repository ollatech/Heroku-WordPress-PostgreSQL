<?php

namespace Stencil\Vendors;


if (!defined('ABSPATH'))
    exit;

final class Loader extends \Stencil_Loader {

   
    protected $includes = array(
        'vendors/html/mustache',
        'vendors/html/html',
        'vendors/html/element',
        'vendors/html/element-html',
        'vendors/html/element-model',
        'vendors/bootstrap/menu',
        'vendors/template/mustache'
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
