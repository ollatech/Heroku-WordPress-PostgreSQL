<?php

namespace Stencil\App\Posts;

if (!defined('ABSPATH'))
	exit; 

use Stencil\Core\Base\Post_Base;

class Slideshow extends Post_Base {
	protected $capability = 'post';
	protected $name = 'slideshow';
	protected $title = 'Slideshow';
	protected $description = '';
	protected $icon = '';

	public function taxonomies() {
		return [
			[
				'name' => 'slideshow_category',
				'args' => [
				]
			]
		];
	}
	public function metaboxes() {
		return [
			[
				'id' => 'image',
				'type' => 'single_image',
				'name' => __( 'Image', 'stencil' )
			],
			[
				'id' => 'title',
				'type' => 'text',
				'name' => __( 'Title', 'stencil' )
			],
			[
				'id' => 'description',
				'type' => 'textarea',
				'name' => __( 'Description', 'stencil' )
			],
			[
				'id' => 'link_label',
				'type' => 'text',
				'name' => __( 'Link Label', 'stencil' )
			]
		];
	}
}