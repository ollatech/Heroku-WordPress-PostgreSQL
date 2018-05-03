<?php

namespace Stencil\Modules\Elementor\Widgets;


use Stencil\Core\Template;
use Stencil\Core\Data;
use Stencil\Core\Render;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if (!defined('ABSPATH'))
    exit; 


class Collection extends Widget_Base {


    public function get_name() {
        return 'stencil-collection';
    }

    public function get_title() {
        return __('Collection', 'stencil');
    }

    public function get_icon() {
        return 'eicon-collection';
    }
    public function get_categories() {
        return array('stencil-blocks');
    }

    

    protected function _register_controls() {
        $data = Data::instance();
        $template = Template::instance();
        $this->start_controls_section(
            'section_posts_carousel',
            [
                'label' => __('Query', 'stencil'),
            ]
        );
        $this->add_control(
            'post_type',
            [
                'label' => __('Post Type', 'stencil'),
                'type' => Controls_Manager::SELECT,
                'options' => $data->posttypes(),
                'multiple' => true,
                'label_block' => true
            ]
        );
        $this->add_control(
            'tax_query',
            [
                'label' => __( 'Tax Query', 'plugin-domain' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'taxonomy',
                        'label' => __( 'Taxonomy', 'plugin-domain' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'field',
                        'label' => __( 'Field', 'plugin-domain' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'terms',
                        'label' => __( 'Terms', 'plugin-domain' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'operator',
                        'label' => __( 'Operator', 'plugin-domain' ),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            'IN' => 'IN',
                            'NOT IN' => 'NOT IN'
                        ],
                        'label_block' => true,
                    ]
                    
                ]
            ]
        );
        $this->add_control(
            'meta_query',
            [
                'label' => __( 'Meta Query', 'plugin-domain' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'key',
                        'label' => __( 'Key', 'plugin-domain' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'value',
                        'label' => __( 'Value', 'plugin-domain' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'compare',
                        'label' => __( 'Operator', 'plugin-domain' ),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            'IN' => 'IN',
                            'NOT IN' => 'NOT IN'
                        ],
                        'label_block' => true,
                    ]
                    
                ],
                'title_field' => '{{{ key }}}',
            ]
        );
        $this->add_control(
            'order',
            [
                'label' => __('Order', 'stencil'),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'ASC' => __('Ascending', 'stencil'),
                    'DESC' => __('Descending', 'stencil'),
                ),
                'default' => 'DESC',
            ]
        );
        $this->add_control(
            'posts_per_page',
            [
                'label'   => __( 'Max Posts', 'stencil' ),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 10,
                'step'    => 1
            ]
        );
        $this->add_control(
            'column',
            [
                'label'   => __( 'Columns', 'stencil' ),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 10,
                'step'    => 1
            ]
        );

        $this->add_control(
            'collection_template',
            [
                'label' => __('Template', 'stencil'),
                'type' => Controls_Manager::SELECT,
                'options' => $template->list('collection'),
                'multiple' => true,
                'label_block' => true
            ]
        );

        $this->add_control(
            'item_template',
            [
                'label' => __('Item Template', 'stencil'),
                'type' => Controls_Manager::SELECT,
                'options' => $template->list('item'),
                'multiple' => true,
                'label_block' => true
            ]
        );
    }

 
    protected function render() {

        $settings = $this->get_settings_for_display();
        $template = '';
        $query_args = [];
        $query_list = ['post_type',  'order'];
        foreach ($settings as $key => $setting) {
            if(in_array($key, $query_list)) {
                $query_args[$key] = $setting;
            }
            if($key === 'posts_per_page') {
                $query_args[$key] = $setting;
            }
        }
        echo  Stencil_Render()->collection($query_args, $settings);
    }
}