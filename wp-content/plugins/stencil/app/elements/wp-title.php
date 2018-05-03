<?php

namespace Stencil\App\Elements;

if (!defined('ABSPATH'))
	exit; 

use Stencil\Vendors\Html\Element_Model;

class Wp_Title extends Element_Model{
	protected $element = 'wordpress';
	protected $name = 'wp_title';
	public function structure() {
		return [];
	}

	public function render_html($values = []) {
		$output = '';
		ob_start();
		echo the_content();
		$output .= ob_get_clean();
		return $output;
	}
}