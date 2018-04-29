<?php

namespace Stencil\App;


final class Posts {

	protected $namespace = '\\Stencil\\App\\Posts';
    protected $posts = array(
        'portfolio',
        'slideshow',
        'carousel'
    ); 

    public function includes() {
        foreach ( $this->posts as $post ) {
            $this->require_file( STL_PATH . "app/posts/$post.php" );
        }
    }

    public function run() {
        foreach ( $this->posts as $post ) {
            $class = str_replace("-", "_",$post);
            $class = ucwords(str_replace("_", " ",$class));
            $class = str_replace( " ", "_", $class );
            $class = $this->namespace.'\\'.$class;
            if(class_exists( $class )) {
                $this->add_post(new $class);
            };
        }
    }

    public function add_post($class) {
        add_filter('stencil/post', function ($collections) use ($class) {
            $collections[] = $class;
            return $collections;
        }, 10, 2);

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
            self::$instance->run();
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
