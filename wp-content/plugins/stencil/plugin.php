<?php

/**
* Plugin Name: Stencil
* Plugin URI: http://www.olla.io/stencil
* Description: Stencil Builder & Editor
* Version: 1.0.0
* Author: olla.io
* Author URI: http://www.olla.io/stencil
* Text Domain: stencil
* Domain Path: /assets/langs/
*/


if (!defined('ABSPATH'))
	exit;

require_once plugin_dir_path( __FILE__ )  . 'classes/loader.php';
require_once plugin_dir_path( __FILE__ )  . 'classes/widget-base.php';
require_once plugin_dir_path( __FILE__ )  . 'classes/template-base.php';


require_once plugin_dir_path( __FILE__ )  . 'stencil.php';
require_once plugin_dir_path( __FILE__ )  . 'mirror.php';
require_once plugin_dir_path( __FILE__ )  . 'register.php';

