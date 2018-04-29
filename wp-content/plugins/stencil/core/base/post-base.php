<?php
namespace Stencil\Core\Base;



class Post_Base {

	protected $capability;
	protected $name;
	protected $title;
	protected $description;
	protected $icon;

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
		return [
				'label'                 => __( $this->title , 'stencil' ),
				'description'           => __( $this->description, 'stencil' ),
		];
	}

	public function taxonomies() {
		return [
		];
	}

	public function metaboxes() {
		return [];
	}
}