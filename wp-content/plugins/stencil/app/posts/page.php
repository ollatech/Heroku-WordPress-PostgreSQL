<?php
namespace Stencil\App\Posts;
if (!defined('ABSPATH'))
	exit; 

use Stencil\Core\Base\Post_Base;

class Page extends Post_Base {

	protected $extend = true;
	protected $capability = 'page';
	protected $name = 'page';
	protected $title = 'Page';
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