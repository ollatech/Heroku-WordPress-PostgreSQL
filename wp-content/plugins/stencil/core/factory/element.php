<?php

namespace Stencil\Core\Factory;

if ( !defined( 'ABSPATH' ) ) exit;



class Element {
	protected $name;
	protected $class;
	protected $models;

	public function __construct($name) {
		$this->name = $name;
	}
	public function setClass($class) {
		$this->class = $class;
	}

	public function addModel($name, $class) {

	}

	public function save() {
		
	}
}

