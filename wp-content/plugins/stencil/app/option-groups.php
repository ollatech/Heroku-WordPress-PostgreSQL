<?php

namespace Stencil\App;


final class Option_Groups {

	protected $namespace = '\\Stencil\\App\\Optiongroups';
    protected $option_groups = array(
        'general',
        'import',
        'export'
    );

  



    public function includes() {
        foreach ( $this->option_groups as $option_group ) {
            $this->require_file( STL_PATH . "app/optiongroups/$option_group.php" );
        }
    }

    public function run() {
     
        foreach ( $this->option_groups as $option_group ) {
            $class = str_replace("-", "_",$option_group);
            $class = ucwords(str_replace("_", " ",$class));
            $class = str_replace( " ", "_", $class );
            $class = $this->namespace.'\\'.$class;
            
            if(class_exists( $class )) {
                
                add_filter('stencil/option_group', function ($collections) use ($option_group, $class) {
                    $collections[$option_group] = new $class;
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
