<?php

namespace Stencil\Core;

if ( !defined( 'ABSPATH' ) ) exit;


class Css {



	public function make_column($column = 1, $grid = 12, $args = []) {
		$x = $grid%$column;
		if($x == 0) {
			$y = $grid/$column;
			$class = ' col-md-'.$y;
		} else {
			$class = ' col-md-12';
		}
		return [
			'_column' => $class
		];
	}

	/******************************
	*
	*******************************/
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

