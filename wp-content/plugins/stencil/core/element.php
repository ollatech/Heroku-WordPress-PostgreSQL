<?php

namespace Stencil\Core;

if ( !defined( 'ABSPATH' ) ) exit;

use Stencil\Vendors\Html\Html;
use Stencil\Vendors\Html\Mustache;

class Element {

	private static $instance;
	protected $html;
	protected $namespace = '\\Stencil\\Core\\Elements';
	protected $elements = array(
		'header',
		'footer',
		'category',
		'carousel',
		'single-layout',
		'wordpress'
	);
	
	public function get_elements() {
		return $this->html->get_elements();
	}

	
	public function get_element($element, $model) {
		return $this->html->get_element($element, $model);
	}
	

	public function register() {
		$elements = $this->get_config_elements();
		$html = Html::instance();
		$html->set_template_engine(new Mustache);
		foreach ($elements as $name => $element) {
			$class = $element['class'];
			foreach ($element['models'] as $modelName => $modelClass) {
				
				$class->add_model($modelClass->name(), $modelClass);
			}
			$html->add_element($name, $class);
		}
		$this->html = $html;
	}

	public function default_config_elements() {
		$instances = [];
		foreach ( $this->elements as $element ) {
			$class = str_replace("-", "_",$element);
			$class = ucwords(str_replace("_", " ",$class));
			$class = str_replace( " ", "_", $class );
			$class = $this->namespace.'\\'.$class;
			if(class_exists( $class, false)) {
				$instances[$element]['class'] = new $class;
			};
		}
		return $instances;
	}

	public function default_config_models() {
		
		$models  = apply_filters('stencil/element_model', array());
		$mods = [];
		foreach ($models as $model) {
			$mods[$model->element()][] = $model;
		}
		return $mods;
	}

	public function get_config_elements() {
		$models = $this->default_config_models();
		$default_elements = $this->default_config_elements();
		$elements  = apply_filters('stencil/elements', $default_elements);
		$collections = [];
		foreach ($elements as $name => $element) {
			$collections[$name]['class'] = $element['class'];
			$collections[$name]['models'] = isset($models[$name]) ? $models[$name] : [];
		}
		return $collections;
	}



	public function toHtml($json) {
		return $this->html->jsonToHtml($json);
	}

	public function toJson($html) {
		return $this->html->htmlToJson($html);
	}


	protected function require_file( $file ) {
		if ( file_exists( $file ) ) {
			require_once $file;
			return true;
		}
		return false;
	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->includes();
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
	public function includes() {
		foreach ( $this->elements as $element ) {
			$this->require_file( STL_PATH . "core/elements/$element.php" );
		}
	}
}

