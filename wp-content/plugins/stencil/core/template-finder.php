<?php

namespace Stencil\Core;

if ( !defined( 'ABSPATH' ) ) exit;



class Template_Finder {

	protected $css;
	protected $data;
	protected $template;

	private function setting($target, $default) {
		$result = $default;
		if(null !== $check = get_option( 'main_design_'.$target, null )) {
			$result = $check;
		}
		if(is_home() && !is_front_page()) {
			if(true == $check = get_option('page_design_'.$target, false)) {
				$result = $check;
			}
		}
		if(is_archive() || is_tag() || is_tax()) {
			if(true == $check = get_option('archive_design_'.$target, false)) {
				$result = $check;
			}
		}
		if(is_singular() && !is_front_page()) {
			if(true == $check = get_option('single_design_'.$target, false)) {
				$result = $check;
			}
		}
		if(is_page() && !is_front_page()) {
			if(true == $check = get_option('page_design_'.$target, false)) {
				$result = $check;
			}
		}
		if(is_search() && !is_front_page()) {
			if(true == $check = get_option('search_design_'.$target, false)) {
				$result = $check;
			}
		}
		if(function_exists('is_woocommerce')) {
			if(is_shop()) {
				if(true == $check = get_option('shop_design_'.$target, false)) {
					$result = $check;
				}
			}
			if(is_product()) {
				if(true == $check = get_option('product_design_'.$target, false)) {
					$result = $check;
				}
			}
		}
		if(is_singular() || is_page() && !is_front_page()) {
			if(true == $check = rwmb_meta('design_'.$target)) {
				$result = $check;
			}
		}
		return $result;
	}

	public function find($template, $design) {

	}


	private function library() {
		$this->template = Template::instance();
	}

	/******************************
	*
	*******************************/
	private static $instance;
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->library();
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

