<?php

namespace Stencil\Modules\Elementor\Widgets;


use Stencil\Core\Template;
use Stencil\Core\Data;
use Stencil\Core\Widget;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if (!defined('ABSPATH'))
    exit; 


class Carousel extends Widget_Base {


    public function get_name() {
        return 'stencil-carousel';
    }

    public function get_title() {
        return __('Carousel', 'stencil');
    }

    public function get_icon() {
        return 'eicon-carousel';
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
            'posttype',
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
                'default' => 3,
                'min'     => 1,
                'max'     => 10,
                'step'    => 1
            ]
        );
        $this->add_control(
            'carousel_pagination',
            [
                'label'   => __( 'Carousel Pagination?', 'stencil' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __( 'Show', 'stencil' ),
                'label_off' => __( 'Hide', 'stencil' ),
                'return_value' => 'yes',
            ]
        );
        $this->add_control(
            'carousel_navigation',
            [
                'label'   => __( 'Carousel Navigation?', 'stencil' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => __( 'Show', 'stencil' ),
                'label_off' => __( 'Hide', 'stencil' ),
                'return_value' => 'yes',
            ]
        );
        $this->add_control(
            'carousel_items',
            [
                'label'   => __( 'Carousel Items', 'stencil' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3,
                'min'     => 1,
                'max'     => 10,
                'step'    => 1
            ]
        );
        $this->add_control(
            'carousel_template',
            [
                'label' => __('Template', 'stencil'),
                'type' => Controls_Manager::SELECT,
                'options' => $template->list('carousel'),
                'multiple' => true,
                'label_block' => true
            ]
        );
        $this->add_control(
            'carousel_template_custom',
            [
                'label'       => __( 'Custom Template', 'stencil' ),
                'type'        => Controls_Manager::TEXT
            ]
        );
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $template = '';
        $args = [];
        if(isset($settings['posttype'])) {
            $args['posttype'] = $settings['posttype'];
        }


        if(isset($settings['carousel_template'])) {
            $template = 'carousel/'.$settings['carousel_template'];
        }
        if(isset($settings['carousel_template_custom']) && null != $settings['carousel_template_custom']) {
            $template = $settings['carousel_template_custom'];
        }


        $data = Stencil_Data()->posts($args); 
        $carousel = Stencil_Widget()->get('carousel');
        $carousel->set_controls($settings);
        $carousel->set_data($data);
        $carousel->set_template($template);
        echo $carousel->render();
    }
}