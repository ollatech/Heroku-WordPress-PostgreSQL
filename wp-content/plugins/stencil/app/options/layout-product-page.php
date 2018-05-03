<?php
namespace Stencil\App\Options;

if (!defined('ABSPATH'))
	exit; 

use Stencil\Core\Base\Option_Layout;

class Layout_Product_Page extends Option_Layout{
	protected $name = 'product_page_layout';
	protected $title = 'Product Page';
	protected $description = '';
	protected $icon = '';
	protected $group = 'layout';
	protected $prefix = 'product';

	public function controls() {
        $options = [];
        $options = array_merge($options, $this->template()->option('main', 'product', 'Layout'));
        $options = array_merge($options, $this->template()->option('header', 'product', 'Header'));
        $options = array_merge($options, $this->template()->option('footer', 'product', 'Footer'));
        $options = array_merge($options, $this->template()->option('content', 'product', 'Content'));
       
      
        return $options;
    }
}