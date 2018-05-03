<?php
namespace Stencil\Core\Base;

use Stencil\Core\Template;

class Option_Layout extends Option_Base {

	protected function template() {
		return Template::instance();
	}
	
}