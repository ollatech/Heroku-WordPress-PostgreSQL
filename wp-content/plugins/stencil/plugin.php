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

define( 'STL_VERSION', '1.0.0' );
define( 'STL_PATH', plugin_dir_path( __FILE__ ) );
define( 'STL_ELEMENTOR_PATH', plugin_dir_path( __FILE__ ).'elementor/' );
define( 'STL_URL', plugin_dir_url( __FILE__ ) );
define( 'STL_ASSET_URL', plugin_dir_url( __FILE__ ).'assets/' );



require_once STL_PATH . 'stencil.php';