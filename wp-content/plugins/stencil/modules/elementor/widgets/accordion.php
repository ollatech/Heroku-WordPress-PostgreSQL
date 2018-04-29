<?php
/*
Widget Name: Test
Description: Display a list of custom HTML content as a carousel.
Author: Stencil
Author URI: https://www.olla.io/stencil
*/

namespace Stencil\Modules\Elementor\Widgets;

use Stencil\Modules\Elementor\Widget;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if (!defined('ABSPATH'))
    exit; 


class Accordion extends Widget {

    protected $block = 'accordion';

    public function get_name() {
        return 'stencil-accordion';
    }

    public function get_title() {
        return __('Accordion', 'stencil');
    }

    public function get_icon() {
        return 'eicon-carousel';
    }

    

    protected function _register_controls() {

     

    }

}