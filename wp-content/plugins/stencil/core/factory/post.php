<?php

namespace Stencil\Core\Factory;

if ( !defined( 'ABSPATH' ) ) exit;



class Post {

	protected $group = 'posts';
	protected $capability;
	protected $shortname;
	protected $configs = [
		'labels' => array(
			'name' => null,
			'description' => null
		)
	];
	protected $metaboxes = [];
	protected $taxonomies = [];
	protected $controls = [];


	public function __construct($capability, $shortname) {
		$this->shortname = $shortname;
		$this->configs['shortname'] = $shortname;
		$this->configs['capability'] = $capability;

	}

	public function group($group) {
		$this->group = $group;
		return $this;
	}
	public function label($name, $value) {
		$this->configs['labels'][$name] = $value;
		return $this; 
	}

	public function config($name, $value) {
		$this->configs[$name] = $value;
		return $this; 
	}

	public function add_metabox($id, $args) {
		$this->metaboxes[$id] = array_merge(
			array(
				'id' => $id
			), $args
		);
		return $this;
	}

	public function add_taxonomy($id, $args) {
		$this->configs['taxonomies'][] = $id;
		$this->taxonomies[$id] = array_merge(
			array(
				'id' => $id,
				'posttype' => $this->shortname,
				'posttypes' => [$this->shortname]
			), $args
		);
		return $this;
	}

	public function add_control($id, $option) {
		$this->controls[$this->shortname.'_'.$id] = array_merge(
			array(
				'id' => $this->shortname.'_'.$id,
				'section' => $this->shortname
			), $option
		);
		return $this;
	}



	public function save() {

		if($this->group === 'elements') {
			$this->configs['show_in_menu'] ='stencil-elements';
		}
		if($this->group === 'templates') {
			$this->configs['show_in_menu'] ='stencil-templates';
		}
		

		//register options
		$option = new Option($this->group, $this->shortname);
		if(isset($this->configs['labels']['name'])) {
			$option->config('title', $this->configs['labels']['name']);
		}
		if(isset($this->configs['labels']['description'])) {
			$option->config('description', $this->configs['labels']['description']);
		}
		$option->add_control($this->shortname.'_enabled', [
			'id' => $this->shortname.'_enabled',
			'type'  => 'checkbox',
			'label' => 'Enabled?',
			'description' => ''
		]);

		if($this->group === 'posts' || $this->group === 'page') {
			$option->add_control($this->shortname.'_layout_single', [
				'id' => $this->shortname.'_layout_single',
				'type'  => 'checkbox',
				'label' => 'Single Layout',
				'description' => 'Single Layout'
			]);
			$option->add_control($this->shortname.'_layout_archive', [
				'id' => $this->shortname.'_archive_archive',
				'type'  => 'checkbox',
				'label' => 'Archive Layout',
				'description' => 'Archive Layout'
			]);
		}
		$option->set_control($this->controls);
		$option->save();



		$shortname = $this->shortname;
		$configs = $this->configs;
		add_filter('posttypes', function ($collections) use ($shortname, $configs) {
			$collections[$shortname] = $configs;
			return $collections;
		}, 10, 2);

		//register taxonomy
		$taxonomies = $this->taxonomies;
		add_filter('taxonomies', function ($collections) use ($taxonomies) {
			$collections += $taxonomies;
			return $collections;
		}, 10, 2);

		//register metabox
		$metaboxes = $this->metaboxes;
		add_filter('metaboxes', function ($collections) use ($shortname, $metaboxes) {
			$collections[$shortname] = $metaboxes;
			return $collections;
		}, 10, 2);
	}
}

