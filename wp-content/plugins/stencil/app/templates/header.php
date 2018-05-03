<?php

namespace Stencil\App\Templates;



class Header extends \Stencil_Template_Base {
	protected $name = 'header';
	protected $designs= [
		'standard' => [
			'storage' => 'file',
			'template' => 'header/standard.php',
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