<?php

namespace Stencil\App\Templates;



class Item extends \Stencil_Template_Base {
	
	protected $name = 'item';
	protected $designs= [
		'standard' => [
			'storage' => 'file',
			'template' => 'item/standard.php',
			'helpers' => [
				
			],
			'controls' => [

			]
		],
		'grid' => [
			'storage' => 'file',
			'template' => 'item/grid.php',
			'helpers' => [
				
			],
			'controls' => [

			]
		],
		'list' => [
			'storage' => 'file',
			'template' => 'item/list.php',
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