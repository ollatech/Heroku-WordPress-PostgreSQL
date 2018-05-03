<?php

namespace Stencil\App\Templates;



class Cover extends \Stencil_Template_Base {
	protected $name = 'cover';
	protected $designs= [
		'standard' => [
			'storage' => 'file',
			'template' => 'cover/standard.php',
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