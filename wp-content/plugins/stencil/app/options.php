<?php

namespace Stencil\App;


final class Options {

	protected $namespace = '\\Stencil\\App\\Options';
    protected $options = array(
        'common'
    );
 
    public function includes() {
        foreach ( $this->options as $option ) {
            $this->require_file( STL_PATH . "app/options/$option.php" );
        }
    }
    public function run() {
        foreach ( $this->options as $option ) {
            $class = str_replace("-", "_",$option);
            $class = ucwords(str_replace("_", " ",$class));
            $class = str_replace( " ", "_", $class );
            $class = $this->namespace.'\\'.$class;
            if(class_exists( $class )) {
                add_filter('stencil/option', function ($collections) use ($option, $class) {
                    $collections[$option] = new $class;
                  return $collections;
              }, 10, 2);
            };
        }
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
