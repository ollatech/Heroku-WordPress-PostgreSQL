<?php

namespace Stencil\App\Posts;

if (!defined('ABSPATH'))
	exit; 

use Stencil\Core\Base\Post_Base;

class Portfolio extends Post_Base {
	protected $element = true;
	protected $capability = 'post';
	protected $name = 'portfolio';
	protected $title = 'Portfolio';
	protected $description = '';
	protected $icon = '';

	public function taxonomies() {
		return [
			[
				'name' => 'portfolio_category',
				'args' => [
				]
			]
		];
	}
	public function metaboxes() {
		return [
			[
				'id' => 'date',
				'type' => 'text',
				'name' => __( 'Release Date', 'stencil' )
			],
			[
				'id' => 'date2',
				'type' => 'checkbox',
				'name' => __( 'Release Date', 'stencil' )
			]
		];
	}
}