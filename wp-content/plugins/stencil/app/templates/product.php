<?php

namespace Stencil\App\Templates;



class Product extends \Stencil_Template_Base {
	protected $name = 'product';
	protected $designs= [
		'standard' => [
			'storage' => 'file',
			'template' => 'product/standard.php',
			'helpers' => [
				
			],
			'controls' => [

			]
		]
	];

	public function controls() {

	}

	public function render() {

	}
}