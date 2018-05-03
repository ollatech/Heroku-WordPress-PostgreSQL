<?php

class Stencil_Layout {

	protected $settings = [];

	private function location() {
		$location = '';
		if(is_home()) {
			$location = 'home';
		}
		if(is_archive() || is_tag() || is_tax()) {
			$location = 'archive';
		}
		if(is_page()) {
			$location = 'page';
		}

		if(is_singular()) {
			$location = 'single';

		}

		if(is_search()) {
			$location = 'search';
		}
		return $location;
	}

	private function config() {
		$config = [];
		$config['header'] = get_option( 'main_design_header', null );
		$config['footer'] = get_option( 'main_design_footer', null );
		$config['cover'] = get_option( 'main_design_cover', null );
		$config['main'] = get_option( 'main_design_main', null );
		

		if(is_home() || is_front_page() || is_archive() || is_tag() || is_tax()) {
			if(true == $option = get_option('archive_design_header', false)) {
				$config['header'] = $option;
			}
			if(true == $option = get_option('archive_design_footer', false)) {
				$config['footer'] = $option;
			}
			if(true == $option = get_option('archive_design_cover', false)) {
				$config['cover'] = $option;
			}
			if(true == $option = get_option('archive_design_main', false)) {
				$config['main'] = $option;
			}
		}

		if(is_singular()) {
			if(true == $option = get_option('post_design_header', false)) {
				$config['header'] = $option;
			}
			if(true == $option = get_option('post_design_footer', false)) {
				$config['footer'] = $option;
			}
			if(true == $option = get_option('post_design_cover', false)) {
				$config['cover'] = $option;
			}
			if(true == $option = get_option('post_design_main', false)) {
				$config['main'] = $option;
			}
		}

		if(is_page()) {
			if(true == $option = get_option('page_design_header', false)) {
				$config['header'] = $option;
			}
			if(true == $option = get_option('page_design_footer', false)) {
				$config['footer'] = $option;
			}
			if(true == $option = get_option('page_design_cover', false)) {
				$config['cover'] = $option;
			}
			if(true == $option = get_option('page_design_main', false)) {
				$config['main'] = $option;
			}
		}

		if(is_search()) {
			if(true == $option = get_option('search_design_header', false)) {
				$config['header'] = $option;
			}
			if(true == $option = get_option('search_design_footer', false)) {
				$config['footer'] = $option;
			}
			if(true == $option = get_option('search_design_cover', false)) {
				$config['cover'] = $option;
			}
			if(true == $option = get_option('search_design_main', false)) {
				$config['main'] = $option;
			}
		}

		if ( null !== $post_type = get_post_type()) {


		}

		if(is_singular() || is_page()) {
			if(true == $option = rwmb_meta('design_header')) {
				$config['header'] = $option;
			}
			if(true == $option = rwmb_meta('design_footer')) {
				$config['footer'] = $option;
			}
			if(true == $option = rwmb_meta('design_cover')) {
				$config['cover'] = $option;
			}
			if(true == $option = rwmb_meta('design_main')) {
				$config['main'] = $option;
			}
		}

		return $config;
	}

	public function header() {
		get_template_part( 'layouts/header/header', $this->config()['header']); 
	}

	public function footer() {
		get_template_part( 'layouts/footer/footer', $this->config()['footer']); 
	}

	public function home() {
		get_template_part( 'layouts/archive/archive', $this->config()['main']); 
	}

	public function search() {
		get_template_part( 'layouts/seach/search', $this->config()['main']); 
	}


	public function archive() {
		
		get_template_part( 'layouts/archive/archive', $this->config()['main']); 
	}

	public function page() {
		get_template_part( 'layouts/cover/cover', $this->config()['cover']); 
		get_template_part( 'layouts/page/page', $this->config()['main']); 
	}

	public function single() {
		get_template_part( 'layouts/cover/cover', $this->config()['cover']); 
		get_template_part( 'layouts/single/single', $this->config()['main']); 
	}


	public function woocommerce() {
		get_template_part( 'layouts/cover/cover', $this->config()['cover']); 
		get_template_part( 'layouts/woocommerce/woocommerce', $this->config()['main']); 

	}



	public function leftside() {

	}

	public function rightside() {

	}

	public function modal() {

	}



	//instance
	private static $instance;
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
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

