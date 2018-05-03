<?php
namespace Stencil\App\Options;

if (!defined('ABSPATH'))
	exit; 

use Stencil\Core\Base\Option_Layout;

class Layout_Archive extends Option_Layout {

	protected $name = 'archive_layout';
	protected $title = 'Archive';
	protected $description = '';
	protected $icon = '';
	protected $group = 'layout';
	protected $prefix = 'archive';

	public function controls() {
       $options = [];
        $options = array_merge($options, $this->template()->option('main', 'archive', 'Layout'));
        $options = array_merge($options, $this->template()->option('header', 'archive', 'Header'));
        $options = array_merge($options, $this->template()->option('footer', 'archive', 'Footer'));
        $options = array_merge($options, $this->template()->option('collection', 'archive', 'Collection'));
        $options = array_merge($options, $this->template()->option('item', 'archive', 'Item'));
      
        return $options;
    }
}