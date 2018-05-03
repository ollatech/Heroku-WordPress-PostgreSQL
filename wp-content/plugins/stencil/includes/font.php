<?php
//https://gist.github.com/richtabor/b85d317518b6273b4a88448a11ed20d3
class Stencil_Font {

	public function terms($taxonomy, $args = []) {
		$args =  array_merge([

		], $args);
		$terms = get_terms($taxonomy, $args);
		$options = [];
		foreach ($terms as $key => $term) {
			$options[$term->term_id] = $term->name;
		}
		return $options;
	}


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
