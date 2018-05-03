<?php

namespace Stencil\App;

use Stencil\Core\Option;
final class Option_Groups extends \Stencil_Loader {

	protected $namespace = '\\Stencil\\App\\Optiongroups';
    protected $includes = array(
        'app/optiongroups/general',
        'app/optiongroups/layout'
    );

    public function init() {
        $option = Option::instance();
        foreach ( $this->includes as $include ) {
            $class = $this->className($include);
            $class = $this->namespace.'\\'.$class;
            if(class_exists( $class )) {
                $option->add_group($class);
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
