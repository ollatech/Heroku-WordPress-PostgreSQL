<?php

namespace Stencil\Core;

if ( !defined( 'ABSPATH' ) ) exit;


class Widget {

	protected $widgets;

	private function widgets() {
		return apply_filters('stencil/widget', []);
	}
	public function add($class) {
		add_filter('stencil/widget', function ($collections) use ($class) {
			$class2 = new $class;
			$collections[$class2->name()] = $class;
			return $collections;
		}, 10, 2);
	}

	public function list() {
		return $this->widgets();
	}

	public function has($name) {
		if(isset($this->widgets()[$name])) {
			return true;
		}
		return false;
	}

	public function get($name) {
		if(isset($this->widgets[$name])) {
			return new $this->widgets[$name];
		}
		return false;
	}

	public function register() {
		add_action( 'after_setup_theme', function() {
			$this->widgets = $this->widgets();
		});
	}


	/******************************
	*
	*******************************/
	private static $instance;
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->register();
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

