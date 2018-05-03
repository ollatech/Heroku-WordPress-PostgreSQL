<?php

namespace Stencil\App\Options;

if (!defined('ABSPATH'))
	exit; 

use Stencil\Core\Base\Option_Base;

class Common extends Option_Base{
	protected $name = 'common';
	protected $title = 'Common';
	protected $description = '';
	protected $icon = '';
	protected $group = 'general';

	public function controls() {
		return [
			[
				'type' => 'file_input',
				'name' => 'Logo',
				'id'   => 'site_logo'
			],
			[
				'name'    => 'WYSIWYG / Rich Text Editor',
				'id'      => 'site_about',
				'type'    => 'wysiwyg',
				'raw'     => false,
				'options' => [
					'textarea_rows' => 4,
					'teeny'         => true,
				]
			]
		];
	}
}