<?php


namespace Stencil\Modules\Elementor;

use Stencil\Block;
use Elementor\Widget_Base;


if (!defined('ABSPATH'))
    exit; 


class Widget extends Widget_Base {

    protected $block = 'test';

    public function get_name() {
        return 'stencil-test';
    }

    public function get_categories() {
        return array('stencil-blocks');
    }

    public function get_script_depends() {
        return [];
    }

    protected function _register_controls() {

        
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        return Block::render($this->block, $settings, null);
    }
}