<?php

namespace Stencil\App;

use Stencil\Core\Widget;

final class Widgets extends \Stencil_Loader {

    protected $includes = array(
        'app/widgets/carousel',
        'app/widgets/collection'
    );

    public function init() {
        $widget = Widget::instance();
        foreach ( $this->includes as $include ) {
            $class = $this->className($include);
            $class = '\\Stencil\\App\\Widgets\\'.$class;

            if(class_exists( $class )) {
                $widget->add($class);
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
