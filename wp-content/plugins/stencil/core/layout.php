<?php

namespace Stencil\Core;


final class Layout {

    protected $template;

    protected $options = [];

    public function get_option($location, $page = false) {
        $segment = 'design_'.$location;
        if($page) {
            $segment = $page.'_'.$segment;
        }
        return  apply_filters('stencil/'.$segment, [
            '' => 'Standard'
        ]);
    }

    public function add_option($location, $args= [], $page = false) {
        $segment = 'design_'.$location;
        if($page) {
            $segment = $page.'_'.$segment;
        }
        add_filter('stencil/'.$segment, function ($collections) use ($args) {
            $collections[$args['name']] = $args['label'];
            return $collections;
        }, 10, 2);
    }

    public function create_setting($location, $prefix = false, $page = false) {
        $segment = 'design_'.$location;
        if($prefix) {
            $segment = $prefix.'_'.$segment;
        }
        $options = [];
        $options[] = [
            'name'            => ucfirst($location),
            'id'              => $segment,
            'type'            => 'select',
            'options'         => $this->template->list($location),
            'multiple'        => false,
            'select_all_none' => true
        ];
        return $options;
    }



    public function layout_data($page) {
        return [
            [
                'name'    => 'Title',
                'id'      => 'cover_title',
                'type'    => 'text'
            ],
            [
                'name'    => 'Text',
                'id'      => 'cover_text',
                'type'    => 'textarea'
            ],
            [
                'id'               => 'cover_image',
                'name'             => 'Background Image',
                'type'             => 'file_input'
            ],
            [
                'name'             => 'Background Video',
                'id'               => 'cover_video',
                'type'             => 'video',
                'max_file_uploads' => 3,
                'force_delete'     => false,
                'max_status'       => true,
            ]
        ];
    }

    public function metaboxes($page, $exclusive = false) {
        $options = [];
        $options += $this->create_setting('main', false, false);
      
        return $options;
    }

    private function template() {
        $this->template  = Template::instance();
    }
    private static $instance;
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
            self::$instance->template();
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