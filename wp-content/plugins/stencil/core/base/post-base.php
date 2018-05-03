<?php
namespace Stencil\Core\Base;



class Post_Base {

	protected $element = false;
	protected $extend = false;
	protected $capability;
	protected $name;
	protected $title;
	protected $description;
	protected $icon;

	public function is_element() {
		return $this->element;
	}

	public function is_extend() {
		return $this->extend;
	}
	public function capability() {
		return $this->capability;
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

	public function args() {
		$args = [];
		$args['label'] = __( $this->title , 'stencil' );
		$args['description'] = __( $this->description , 'stencil' );
		$args['labels'] = [];
		$args['labels']['menu_name'] = __( $this->title , 'stencil' );
		if($this->element) {
			$args['show_in_menu'] ='stencil-elements';
		}
		
		return $args;
	}

	public function taxonomies() {
		return [
		];
	}

	public function metaboxes() {
		return [];
	}
}