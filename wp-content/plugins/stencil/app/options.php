<?php

namespace Stencil\App;

use Stencil\Core\Option;
final class Options extends \Stencil_Loader {

	protected $namespace = '\\Stencil\\App\\Options';
    protected $includes = array(
        'app/options/common',
        'app/options/typography',
        'app/options/layout',
        'app/options/layout-archive',
        'app/options/layout-page',
        'app/options/layout-post',
        'app/options/layout-search',
        'app/options/layout-product',
        'app/options/layout-product-page'
    );
 

    public function init() {
        $option = Option::instance();
        foreach ( $this->includes as $include ) {
            $class = $this->className($include);
            $class = '\\Stencil\\App\\Options\\'.$class;
            if(class_exists( $class )) {
                $option->add($class);
            };
        }
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
