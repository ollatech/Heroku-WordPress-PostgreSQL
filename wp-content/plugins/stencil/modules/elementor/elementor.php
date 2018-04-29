<?php

namespace Stencil\Modules\Elementor;


final class Elementor {

    protected $namespace = '\\Stencil\\Modules\\Elementor';
    protected $widgets = array(
        'slider',
        'carousel',
        'image'
    ); 

 
    public function register() {
        add_action('elementor/init', array($this, 'category'));
        add_action('elementor/widgets/widgets_registered',  array($this, 'widgets'));
    }

    public function category() {
        \Elementor\Plugin::instance()->elements_manager->add_category(
            'stencil-blocks',
            array(
                'title' => __('Stencil Components', 'stencil'),
                'icon' => 'fa fa-plug',
            ),
            1);
    }

    public function widgets($widgets_manager) {
        $this->require_file( STL_PATH . "modules/elementor/widget.php" );
        foreach ( $this->widgets as $content ) {
           $this->require_file( STL_PATH . "modules/elementor/widgets/$content.php" );
            $class = str_replace("-", "_",$content);
            $class = ucwords(str_replace("_", " ",$class));
            $class = str_replace( " ", "_", $class );
            $class = $this->namespace.'\\Widgets\\'.$class;
            if(class_exists( $class, false)) {
                $widgets_manager->register_widget_type(new $class);
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
            self::$instance->register();
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

new Elementor();