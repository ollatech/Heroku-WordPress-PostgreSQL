<?php

namespace Stencil\Core;

use Stencil\Core\Base\Field_Base;

final class Field {

    protected $base_fields = [
        'text',
        'checkbox'
    ];

    protected $fields = [];

    public function add_field($name, $class) {
        if($class instanceof Field_Base) {
            $this->fields[$name] = $class;
        } 
    }
    public function render($controls) {
        $output = '';
        foreach ($controls as $control) {
            $output .= $this->render_field($control);
        }
        return $output;
    }

    public function render_field($control) {
        if(!isset($control['type'])) {
            return;
        }
        if(isset($this->fields[$control['type']])) {
            return $this->fields[$control['type']]->render($control);
        } 
    }

    public function register() {
        add_action( 'after_setup_theme', function() {
            $fields  = apply_filters('stencil/field', []);
            foreach ($fields as $field => $instance) {
                $this->add_field($field, $instance);
            }
        });
    }


    private static $instance;

    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
            self::$instance->run();
            self::$instance->includes();
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
    public function run() {
        $this->includes();
    }

    public static function html($type, $field, $field_value) {
        $class = str_replace("-", "_",$type);
        $class = ucwords(str_replace("_", " ",$class));
        $class = str_replace( " ", "_", $class );
        $class = self::$namespace.'\\'.$class;
        if (class_exists($class, false)) {
            return $class::html($type, $field, $field_value);
        }
    }

    public function includes() {
        foreach ( $this->base_fields as $field ) {
            $this->require_file( STL_PATH . "core/fields/$field.php" );
            $class = str_replace("-", "_",$field);
            $class = ucwords(str_replace("_", " ",$class));
            $class = str_replace( " ", "_", $class );
            $class = '\\Stencil\\Core\\Fields\\'.$class;
            if (class_exists($class, false)) {
                $this->add_field($field, new $class);
            }
        }
    }

    protected function require_file( $file ) {
        if ( file_exists( $file ) ) {
            require_once $file;
            return true;
        }
        return false;
    }
}