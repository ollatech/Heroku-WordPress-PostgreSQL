<?php
namespace Stencil\App\Options;

if (!defined('ABSPATH'))
	exit; 


use Stencil\Core\Base\Option_Layout;



class Layout extends Option_Layout {

	protected $name = 'global_layout';
	protected $title = 'Global';
	protected $description = '';
	protected $icon = '';
	protected $group = 'layout';
	protected $prefix = 'main';

	public function controls() {
 
        $options = [];
        $options = array_merge($options, $this->template()->option('main', 'global', 'Layout'));
        $options = array_merge($options, $this->template()->option('header', 'global', 'Header'));
        $options = array_merge($options, $this->template()->option('footer', 'global', 'Footer'));
        $options = array_merge($options, $this->template()->option('content', 'global', 'Content'));
        $options = array_merge($options, $this->template()->option('collection', 'global', 'Collection'));
        $options = array_merge($options, $this->template()->option('item', 'global', 'Item'));
      
        return $options;
    }
}