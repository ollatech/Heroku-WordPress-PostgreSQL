<?php

namespace Stencil\Core;

if ( !defined( 'ABSPATH' ) ) exit;

use \Stencil_Mustache;


class Template extends \Stencil_Loader {

	protected $engine;
	protected $locations;
	protected $templates = [];
	protected $designs = [];
	protected $helpers = [];

	public function get_templates() {
		
		return $this->templates;
	}

	public function get_template($template) {
		if(isset($this->templates[$template])) {
			return $this->templates[$template];
		}
		return null;
	}

	public function add_template($class) {
		add_filter('stencil/template', function ($collections) use ($class) {
			$class2 = new $class;
			$collections[$class2->name()] = $class2;
			return $collections;
		}, 10, 2);
	}

	public function get_designs() {

	}

	public function get_design($template, $design) {
		if(null !== $tpl = $this->get_template($template)) {
			if($tpl->has_design($design)) {
				return $tpl->get_design($design);
			}
		}
	}

	public function add_design(string $template, $args = []) {
		$args = array_merge([
			'storage' => 'file',
			'template' => null,
			'controls' => [],
			'configs' => []
		],$args);
		add_filter('stencil/template_design', function ($collections) use ($template, $args) {

			if(!isset($collections[$template])) {
				$collections[$template] = [];
			}
			if(is_array($args) && isset($args['id'])) {
				$collections[$template][$args['id']] = $args;
			}
			return $collections;
		}, 10, 2);
	}

	public function add_helper($name, $callable) {
		add_filter('stencil/template_helper', function ($collections) use ($name, $callable) {
			$collections[$name] = $callable;
			return $collections;
		}, 10, 2);
	}


	public function list($template) {
		if(null !== $tpl = $this->get_template($template)) {
			$designs =  $tpl->designs();
			$options = [];
			foreach ($designs as $key => $design) {
				$options[$key] = $design['template'];
			}
			return $options;
		}
		return [];
	}
	public function option($template, $name = null, $title = null) {
		$id = $template.'_'.$name;
		$options = [];
        $options[] = [
            'name'            => $title ?? ucfirst($name),
            'id'              => $id,
            'type'            => 'select',
            'options'         => $this->list($template),
            'multiple'        => false,
            'select_all_none' => true
        ];
        if(null !== $option = get_option($id)) {
        	if(null !== $design = $this->get_design($template, $option)) {
        		if(isset($design['controls']) && is_array($design['controls'])) {
        			foreach ($design['controls'] as $key => $opt) {
        				 $options[] = array_merge($opt, [
        				 	'id' => $id.'_'.$opt['id']
        				 ]);
        			}
        		}
        	}
        }
        return $options;
	}

	public function find($shortag, $args = []) {
		if($shortag) {
			$tpl = explode('/', $shortag);
			if(count($tpl) == 2) {
				$template = $tpl[0];
				$design = $tpl[1];
				return $this->load_template($template, $design, $args);
			} else {
				throw new \Exception(__( "Something wrong: ".$shortag, "stencil" ), 404);
			}
		} else {
			throw new \Exception(__( "Something wrong: ".$shortag, "stencil" ), 404);
		}
	}

	public function load_template($template, $design, $args = []) {
		if(null !== $tpl = $this->get_template($template)) {
			if(!$tpl->has_design($design)) {
				throw new \Exception(__( "Design doesn't exist: ".$template.'/'.$design, "stencil" ), 404);
			}
			$result = [
				'config' => [],
				'template' => ''
			];
			if(null !== $config = $tpl->load_config($design, $args)) {
				$result['config'] = $config;
			}
			if(null !== $content = $tpl->load_design($design, $args)) {
				$result['template'] = $content;
			}  else {
				
			}
			if(null !== $result) {
				return $result;
			} 
			
		} else {
			throw new \Exception(__( "Templatea part doesn't exist: ".$template.'/'.$design, "stencil" ), 404);
		}
	}

	public function render($template, $data = []) {
		$output = '';
		ob_start();
		echo $this->engine->render($template, $data);
		$output .= ob_get_clean();
		return $output;
	}



	private function register() {
		add_action( 'after_setup_theme', function() {
			//register helper
			$helpers = apply_filters('stencil/template_helper', []);
			foreach ($helpers as $name => $helper) {
				$this->engine->add_helper($name, $helper);
			}

			//register theme
			$templates = apply_filters('stencil/template', []);
			$designs = apply_filters('stencil/template_design', []);
			$result = [];
			foreach ($templates as $key => $template) {
				if(isset($designs[$key]) && is_array($designs[$key])) {
					foreach ($designs[$key] as $name => $design) {
						$template->add_design($name, $design);
					}
				}
				$result[$key] = $template;
			}
			$this->templates = $result;
	
		});
	}

	private function library() {
		$this->engine = new Stencil_Mustache();
	}

	public function test() {

	}

	private static $instance;
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->library();
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