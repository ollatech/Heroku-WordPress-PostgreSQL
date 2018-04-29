<?php

namespace Stencil\App\Elements;

if (!defined('ABSPATH'))
	exit; 

use Stencil\Vendors\Html\Element_Model;

class Single_Standard extends Element_Model{
	protected $element = 'single-layout';
	protected $name = 'single_2column';
	public function structure() {
		return [
			[
				'node' => 'div',
				'attributes' => [
					'classes' => ['row'],
					'data' => [
						'animate' => true
					]
				],
				'children' => [
					[
						'node' => 'div',
						'attributes' => [
							'classes' => ['col-md-9'],
							'data' => [
								'animate' => true
							]
						],
						'children' => [
							[	'element'=> 'wordpress',
								'model' =>'wp_title',
								'node' => 'title',
								'text' => 'test'
							],
							[
								'node' => 'text',
								'text' => 'test'
							]
						]
					],
					[
						'node' => 'div',
						'attributes' => [
							'classes' => ['col-md-3'],
							'data' => [
								'animate' => true
							]
						],
						'children' => [
							
							[
								'node' => 'text',
								'text' => 'test'
							]
						]
					]
				]
			]
		];
	}

}