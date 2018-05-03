<?php
namespace Stencil\App\Options;

if (!defined('ABSPATH'))
	exit; 

use Stencil\Core\Base\Option_Layout;

class Layout_Product extends Option_Layout{
    
	protected $name = 'shop';
	protected $title = 'Shop';
	protected $description = '';
	protected $icon = '';
	protected $group = 'layout';
	protected $prefix = 'shop';

	public function controls() {
     $options = [];
        $options = array_merge($options, $this->template()->option('main', 'shop', 'Layout'));
        $options = array_merge($options, $this->template()->option('header', 'shop', 'Header'));
        $options = array_merge($options, $this->template()->option('footer', 'shop', 'Footer'));
  
        $options = array_merge($options, $this->template()->option('collection', 'shop', 'Collection'));
        $options = array_merge($options, $this->template()->option('item', 'shop', 'Item'));
      
        return $options;
    }
}