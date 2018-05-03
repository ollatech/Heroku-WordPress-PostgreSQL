<?php

namespace Stencil\App\Widgets;

use Stencil\Core\Template;
use Stencil\Core\Render;

class Collection extends \Stencil_Widget_Base {
	protected $name = 'collection';

	public function get_template() {
		$template = Template::instance();
		if(false != $content = $template->find($this->template)) {
			return $content;
		} 
	}
	public function render() {
		$render = Render::instance();
		$data = $this->data;
		echo $render->collection_view($data, $this->controls);
	}
}