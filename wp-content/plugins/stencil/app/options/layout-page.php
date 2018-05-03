<?php
namespace Stencil\App\Options;

if (!defined('ABSPATH'))
	exit; 

use Stencil\Core\Base\Option_Layout;

class Layout_Page extends Option_Layout{


	protected $name = 'page_layout';
	protected $title = 'Page';
	protected $description = '';
	protected $icon = '';
	protected $group = 'layout';
	protected $prefix = 'page';
    public function controls() {
       $options = [];
        $options = array_merge($options, $this->template()->option('main', 'page', 'Layout'));
        $options = array_merge($options, $this->template()->option('header', 'page', 'Header'));
        $options = array_merge($options, $this->template()->option('footer', 'page', 'Footer'));
        $options = array_merge($options, $this->template()->option('content', 'page', 'Content'));
     
      
        return $options;
    }
}