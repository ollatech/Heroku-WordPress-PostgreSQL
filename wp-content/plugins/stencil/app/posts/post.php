<?php
namespace Stencil\App\Posts;
if (!defined('ABSPATH'))
	exit; 

use Stencil\Core\Base\Post_Base;

class Post extends Post_Base {
	protected $extend = true;
	protected $capability = 'post';
	protected $name = 'post';
	protected $title = 'Post';
	protected $description = '';
	protected $icon = '';

	public function taxonomies() {
		return [
			
		];
	}
	public function metaboxes() {
		return [
			
		];
	}
}