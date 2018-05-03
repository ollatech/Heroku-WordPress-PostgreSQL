<?php
namespace Stencil\App\Options;

if (!defined('ABSPATH'))
	exit; 

use Stencil\Core\Base\Option_Layout;
class Layout_Post extends Option_Layout{


	protected $name = 'post_layout';
	protected $title = 'Post';
	protected $description = '';
	protected $icon = '';
	protected $group = 'layout';
	protected $prefix = 'post';

	public function controls() {
        $options = [];
        $options = array_merge($options, $this->template()->option('main', 'post', 'Layout'));
        $options = array_merge($options, $this->template()->option('header', 'post', 'Header'));
        $options = array_merge($options, $this->template()->option('footer', 'post', 'Footer'));
        $options = array_merge($options, $this->template()->option('content', 'post', 'Content'));
       
      
        return $options;
    }
}