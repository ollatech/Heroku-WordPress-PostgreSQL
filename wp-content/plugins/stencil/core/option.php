<?php

namespace Stencil\Core;

if ( !defined( 'ABSPATH' ) ) exit;


class Option   {

	
	protected $options;

	public function get_options() {
		return $this->options;
	}
	

	public function init_option_groups() {
		$option_groups  = apply_filters('stencil/option_group', []);
		$groups = [];
		foreach ($option_groups as $option_group) {
			$groups[$option_group->name()] = $option_group;
		}
		return $groups;
	}

	public function init_options() {
		$options  = apply_filters('stencil/option', []);
		$sections = [];
		foreach ($options as $option) {
			$sections[$option->group()][$option->name()] = $option;
		}
		return $sections;
	}

	private function compose_options() {
		add_action( 'after_setup_theme', function() {
			$options = $this->init_options();
			$groups = $this->init_option_groups();
			$result = [];
			foreach ($groups as $name => $class) {
				if(isset($options[$name]) && is_array($options[$name])) {
					foreach ($options[$name] as $optname => $optclass) {
						$class->add_option($optname, $optclass);
					}
				}
				$result[$name] = $class;
			}
			$this->options = $result;
		});
	}

	public function add($class) {
		add_filter('stencil/option', function ($collections) use ($class) {
			$collections[] = new $class;
			return $collections;
		}, 10, 2);
	}

	public function add_group($class) {
		  add_filter('stencil/option_group', function ($collections) use ($class) {
                    $collections[] = new $class;
                  return $collections;
              }, 10, 2);
	}

	

	private static $instance;
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->includes();
			self::$instance->compose_options();
		}
		return self::$instance;
	}
	public function __clone() {
		_doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'stencil'), '1.6');
	}

	public function __wakeup() {
		_doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'stencil'), '1.6');
	}
	public function includes() {
		
	}
	protected function require_file( $file ) {
		if ( file_exists( $file ) ) {
			require_once $file;
			return true;
		}
		return false;
	}
}

