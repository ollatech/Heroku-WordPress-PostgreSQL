<?php

class Stencil_Widget_Base {

	protected $name;
	protected $title;
	protected $description;
	protected $icon;
	protected $data;
	protected $template;



	public function name() {
		return $this->name;
	}
	
	public function title() {
		return $this->title;
	}

	public function description() {
		return $this->description;
	}

	public function icon() {
		return $this->icon;
	}

	public function render() {
		
	}

	public function set_controls($controls) {
		$this->controls = $controls;
	}

	public function set_template($template) {
		$this->template = $template;
	}

	public function set_data($data) {
		$this->data = $data;
	}

	public function get_template() {
		return '';
	}
}