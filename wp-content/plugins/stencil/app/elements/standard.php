<?php

namespace Stencil\App\Elements;

if (!defined('ABSPATH'))
	exit; 

use Stencil\Vendors\Html\Element_Model;

class Standard extends Element_Model{
	protected $element = 'header';
	protected $name = 'standard';

}