<?php

namespace Stencil\App\Templates;



class Content extends \Stencil_Template_Base {
	protected $name = 'content';
	protected $designs= [
		'standard' => [
			'storage' => 'file',
			'template' => 'content/standard.php',
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