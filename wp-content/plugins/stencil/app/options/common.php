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