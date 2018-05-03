<?php

class Stencil_Template_Base  {

	protected $name;
	protected $title;
	protected $description;
	protected $designs;

	public function name() {
		return $this->name;
	}
	
	public function title() {
		return $this->title;
	}

	public function description() {
		return $this->description;
	}
	public function designs() {
		return $this->designs;
	}
	public function add_design($name, $design) {
		$this->designs[$name] = $design;
	}

	public function has_design($design) {
		if(isset($this->designs[$design])) {
			return true;
		}
		return false;
	}

	public function get_design($design) {
		if($this->has_design($design)) {
			return $this->designs[$design];
		}
	}

	public function load_config($design, $args = []) {

	}

	public function load_design($design, $args = []) {
		if($this->has_design($design)) {
			return $this->load_content($this->designs[$design]);
		}
	}

	public function load_content($design) {
		if($design['storage'] === 'file' && $design['template'] !== null) {
			$path = 'templates/'.$design['template'];
			$filepath = locate_template(
				array(
					$path
				)
			);
	
			if(null == $filepath || false == $filepath) {
				if(file_exists(STL_PATH.'/'.$path)) {
					$filepath = STL_PATH.'/'.$path;
				}
			}
			if($filepath) {
				ob_start();
				include $filepath;
				return ob_get_clean();
			}
			return null;
		}
	}
}