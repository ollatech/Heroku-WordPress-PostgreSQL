<?php
namespace Stencil\App\Options;

if (!defined('ABSPATH'))
	exit; 
use Stencil\Core\Base\Option_Layout;
class Layout_Search extends Option_Layout{


	protected $name = 'search_layout';
	protected $title = 'Search';
	protected $description = '';
	protected $icon = '';
	protected $group = 'layout';
	protected $prefix = 'search';

	public function controls() {
       $options = [];
        $options = array_merge($options, $this->template()->option('main', 'search', 'Layout'));
        $options = array_merge($options, $this->template()->option('header', 'search', 'Header'));
        $options = array_merge($options, $this->template()->option('footer', 'search', 'Footer'));
        $options = array_merge($options, $this->template()->option('collection', 'search', 'Collection'));
        $options = array_merge($options, $this->template()->option('item', 'search', 'Item'));
      
        return $options;
    }
}