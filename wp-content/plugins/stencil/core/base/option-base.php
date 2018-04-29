<?php
namespace Stencil\Core\Base;



class Option_Base {
	protected $group;
	protected $name;
	protected $title;
	protected $description;
	protected $icon;

	public function group() {
		return $this->group;
	}
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

	public function controls() {
		return [];
	}
}