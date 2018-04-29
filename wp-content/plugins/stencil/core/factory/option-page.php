<?php

namespace Stencil\Core\Factory;

if ( !defined( 'ABSPATH' ) ) exit;

class Option_Page {

	protected $pages = [];
	public function add_page($id, $option = []) {
		$this->pages[$id] = array_merge(
			array(
				'id' => $id
			), $option
		);
		return $this;
	}

	public function save() {
		$pages = $this->pages;
		add_filter('option_pages', function ($collections) use ($pages) {
			$collections += $pages;
			return $collections;
		}, 10, 2);
	}
}

