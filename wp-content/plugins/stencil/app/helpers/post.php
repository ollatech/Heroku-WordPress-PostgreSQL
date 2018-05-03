<?php

namespace Stencil\App\Helpers;

class Post {

	public function title($name, $args) {
		$output = '';
		ob_start();
		?>
		<?php the_title(); ?>
		<?php 
		$output .= ob_get_clean();
		return $output;
	}

	public function excerpt($name, $args) {
		$output = '';
		ob_start();
		?>
		
		<?php 
		$output .= ob_get_clean();
		return $output;
	}

	public function content($name, $args) {
		$output = '';
		ob_start();
		?>
		<?php the_content(); ?>
		<?php 
		$output .= ob_get_clean();
		return $output;
	}

	public function link($name, $args) {
		$output = '';
		ob_start();
		?>
		
		<?php 
		$output .= ob_get_clean();
		return $output;
	}

	public function meta($name, $args) {
		$output = '';
		ob_start();
		?>
		
		<?php 
		$output .= ob_get_clean();
		return $output;
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