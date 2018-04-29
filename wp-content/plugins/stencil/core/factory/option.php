<?php

namespace Stencil\Core\Factory;

if ( !defined( 'ABSPATH' ) ) exit;



class Option {
	
	protected $page;
	protected $shortname;
	protected $section = [];
	protected $options = [];

	public function __construct($page, $shortname, $title = null, $description = null) {
		$this->page = $page;
		$this->shortname = $shortname;
		$this->section['id'] = $shortname;
	}

	public function config($alias, $value) {
		$this->section[$alias] = $value;
		return $this;
	}

	public function set_control($options = []) {
		$this->options += $options;
		return $this;
	}
	public function add_control($id, $option = []) {
		$this->options[$id] = array_merge(
			array(
				'id' => $id,
				'section' => $this->shortname
			), $option
		);
		return $this;
	}

	public function control() {
		$options = $this->options;
		add_filter('option_controls', function ($collections) use ($options) {
			$collections += $options;
			return $collections;
		}, 10, 2);
	}

	public function page() {
		$page = $this->page;
		$section = $this->section;
		add_filter('option_sections', function ($collections) use ($page, $section) {
			$collections[$page][] = $section;
			return $collections;
		}, 10, 2);
	}

	public function save() {
		$this->page();
		$this->control();
	}
}

