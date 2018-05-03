<?php
namespace Stencil\App\Options;

if (!defined('ABSPATH'))
	exit; 

use Stencil\Core\Base\Option_Base;
use Stencil\Core\Layout;


class Typography extends Option_Base{
	protected $name = 'typography';
	protected $title = 'Typography';
	protected $description = '';
	protected $icon = '';
	protected $group = 'general';
	protected $prefix = 'main';

	public function controls() {
		$options = [];
		$options[] = [
			'type' => 'text',
			'name' => 'Font Size',
			'id'   => 'font_size'
		];
		$options[] = [
			'type' => 'text',
			'name' => 'Font Family',
			'id'   => 'font_family'
		];
		$options[] = [
			'type' => 'color',
			'name' => 'Font Color',
			'id'   => 'font_color'
		];
		return $options;
	}
}