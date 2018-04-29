<?php

namespace Stencil\Modules\Elementor\Widgets;

use Stencil\Modules\Elementor\Widget;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if (!defined('ABSPATH'))
    exit; 


class Slider extends Widget {

    protected $block = 'slider';

    public function get_name() {
        return 'stencil-slider';
    }

    public function get_title() {
        return __('Slider', 'stencil');
    }

    public function get_icon() {
        return 'eicon-carousel';
    }

    

    protected function _register_controls() {

        $this->start_controls_section(
            'section_posts_carousel',
            [
                'label' => __('Query', 'stencil'),
            ]
        );


        $this->add_control(
            'tax_query',
            [
                'label' => __('Taxonomies', 'stencil'),
                'type' => Controls_Manager::SELECT2,
                'options' => [],
                'multiple' => true,
                'label_block' => true
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
    }
    protected function render() {

        $settings = $this->get_settings_for_display();
    
        $query_args = [
            'post_type' => 'slideshow'
        ];
        $loop = new \WP_Query($query_args);
        if ($loop->have_posts()) : 
            ?>
            <div class="swiper-container swiper_standard">
                <div class="swiper-wrapper">
                    <?php
                    while ($loop->have_posts()) : $loop->the_post(); 
                        $image = rwmb_meta( 'image', array( 'size' => 'full' ) );
                        $title = rwmb_meta( 'title');
                        $description = rwmb_meta( 'description');
                        $link = rwmb_meta( 'link');
                    ?>
                       <div class="swiper-slide">
                        <div class="embed parallax">
                            <img src="<?php echo $image['full_url']; ?>" class="bg"  />
                            <div class="text bg-white-60">
                                <p class="lead"><?php echo $title; ?></p>
                                <p><?php echo $description; ?></p>
                            </div>
                        </div>
                    </div>

                <?php 
                endwhile; 
                ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <?php wp_reset_postdata(); ?>
        <?php 
    endif;

}
}