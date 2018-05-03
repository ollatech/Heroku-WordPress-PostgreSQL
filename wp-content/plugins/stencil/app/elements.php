<?php

namespace Stencil\App;

use Stencil\Core\Element;

final class Elements extends \Stencil_Loader {

    protected $includes = array(
        'app/elements/standard',
        'app/elements/single-standard',
        'app/elements/wp-title'
    );


    public function init() {
        $element = Element::instance();
        foreach ( $this->includes as $include ) {
            $class = $this->className($include);
            $class = '\\Stencil\\App\\Elements\\'.$class;
            if(class_exists( $class )) {
                $element->add($class);
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
