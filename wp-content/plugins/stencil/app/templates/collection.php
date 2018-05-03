<?php

namespace Stencil\App\Templates;



class Collection extends \Stencil_Template_Base {
	
	protected $name = 'collection';
	protected $designs = [
		'standard' => [
			'storage' => 'file',
			'template' => 'collection/standard.php',
			'helpers' => [
				
			],
			'controls' => [
				[
					'id' => 'pagination',
					'type' => 'checkbox',
					'name' => 'Pagination'
				]
			]
		],
		'grid' => [
			'storage' => 'file',
			'template' => 'collection/grid.php',
			'helpers' => [
				
			],
			'controls' => [
				[
					'id' => 'column',
					'type' => 'select',
					'name' => 'Column',
					'options' => [
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'6' => '6',
						'12' => '12'
					]
				],
				[
					'id' => 'pagination',
					'type' => 'checkbox',
					'name' => 'Pagination'
				]
			]
		]
	];

	public function _column($column) {
		$x = 12%$column;
		if($x == 0) {
			$y = 12/$column;
			return 'col-md-'.$y;
		}
		return 'col-md-12';
	}

	public function load_config($design, $args = []) {
		if(null !== $config = parent::load_config($design, $args)) {
			return $config;
		}
		$column = 1;
		if(isset($args['column'])) {
			$column =  $args['column'];
		}
		return [
			'_row' => 'row',
			'_column' => $this->_column($column)
		];
	}

	public function controls() {

	}

	public function render() {

	}
}