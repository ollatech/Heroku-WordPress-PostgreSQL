<?php

namespace Stencil\Modules\Elementor\Widgets;

use Stencil\Modules\Elementor\Widget;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if (!defined('ABSPATH'))
    exit; 


class Image extends Widget {

    protected $block = 'image';

    public function get_name() {
        return 'stencil-image';
    }

    public function get_title() {
        return __('Image', 'stencil');
    }

    public function get_icon() {
        return 'eicon-image';
    }

    

    protected function _register_controls() {
        $this->start_controls_section(
            'section_image',
            [
                'label' => __( 'Image Box', 'elementor' ),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __( 'Choose Image', 'elementor' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
            ]
        );



        $this->add_control(
            'title_text',
            [
                'label' => __( 'Title & Description', 'elementor' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( 'This is the heading', 'elementor' ),
                'placeholder' => __( 'Enter your title', 'elementor' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label' => __( 'Content', 'elementor' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ),
                'placeholder' => __( 'Enter your description', 'elementor' ),
                'separator' => 'none',
                'rows' => 10,
                'show_label' => false,
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __( 'Link to', 'elementor' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', 'elementor' ),
                'separator' => 'before',
            ]
        );
    }
    protected function render() {

        $settings = $this->get_settings_for_display();
        $has_content = ! empty( $settings['title_text'] ) || ! empty( $settings['description_text'] );

        $title = '';
        if ( ! empty( $settings['title_text'] ) ) {
            $title = $settings['title_text'];
        }

        $link = '';
        if ( ! empty( $settings['link']['url'] ) ) {
            $link = $settings['link']['url'];
        }
        $img_url = '';
        if ( ! empty( $settings['image']['url'] ) ) {
            $img_url = $settings['image']['url'];
        }

        ?>
        <div class="embed">
            <img src="<?php echo $img_url; ?>" class="fullheight" />
            <div class="text">
                <a href="<?php echo $link; ?>" ><?php echo $title; ?></a>
            </div>
        </div>
        <?php 


    }
}