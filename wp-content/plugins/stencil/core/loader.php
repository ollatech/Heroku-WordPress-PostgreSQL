<?php

namespace Stencil\Core;


if (!defined('ABSPATH'))
    exit;

final class Loader extends \Stencil_Loader {

    protected $apps = array(
        'core/base/option-group-base',
        'core/base/option-base',
        'core/base/field-base',
        'core/base/post-base',
        'core/posttype',
        'core/field',
        'core/element',
        'core/element-admin',
        'core/option',
        'core/option-admin',
        'core/template',
        'core/template-finder',
        'core/template-helper',
        'core/layout',
        'core/data',
        'core/render',
        'core/css',
        'core/widget',
        'core/view'
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
