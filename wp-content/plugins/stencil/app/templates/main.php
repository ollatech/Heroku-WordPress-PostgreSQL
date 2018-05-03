<?php

namespace Stencil\App\Templates;


class Main extends \Stencil_Template_Base {
	protected $name = 'main';
	protected $designs= [
		'standard' => [
			'storage' => 'file',
			'template' => 'main/standard.php',
			'helpers' => [
				
			],
			'controls' => [

			]
		],
		'2column' => [
			'storage' => 'file',
			'template' => 'main/2column.php',
			'helpers' => [
				
			],
			'controls' => [

			]
		],
		'3column' => [
			'storage' => 'file',
			'template' => 'main/3column.php',
			'helpers' => [
				
			],
			'controls' => [

			]
		],
		'2column_left' => [
			'storage' => 'file',
			'template' => 'main/2column_left.php',
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