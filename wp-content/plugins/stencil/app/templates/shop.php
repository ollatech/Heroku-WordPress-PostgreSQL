<?php

namespace Stencil\App\Templates;



class Shop extends \Stencil_Template_Base {
	protected $name = 'shop';
	protected $designs= [
		'standard' => [
			'storage' => 'file',
			'template' => 'shop/standard.php',
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