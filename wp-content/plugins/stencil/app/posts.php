<?php

namespace Stencil\App;

use Stencil\Core\Posttype;

final class Posts extends \Stencil_Loader {

	protected $namespace = '\\Stencil\\App\\Posts';
    protected $includes = array(
        'app/posts/post',
        'app/posts/page',
        'app/posts/portfolio',
        'app/posts/slideshow',
        'app/posts/carousel'
    ); 


    public function init() {
        $posttype = Posttype::instance();
        foreach ( $this->includes as $include ) {
            $class = $this->className($include);
            $class = $this->namespace.'\\'.$class;
            if(class_exists( $class )) {
                $posttype->add(new $class);
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
