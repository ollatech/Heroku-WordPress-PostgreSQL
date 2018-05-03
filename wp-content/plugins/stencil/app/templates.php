<?php

namespace Stencil\App;

use Stencil\Core\Template;

final class Templates extends \Stencil_Loader {

    protected $includes = array(
        'app/templates/main',
        'app/templates/header',
        'app/templates/footer',
        'app/templates/content',
        'app/templates/collection',
        'app/templates/item',
        'app/templates/block',
        'app/templates/shop',
        'app/templates/product',
        'app/templates/cover'
    );

    public function init() {
        $template = Template::instance();
        foreach ( $this->includes as $include ) {
            $class = $this->className($include);
            $class = '\\Stencil\\App\\Templates\\'.$class;
            if(class_exists($class)) {
                $template->add_template($class);
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
