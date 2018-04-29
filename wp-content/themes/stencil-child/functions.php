<?php

define( 'STL_GBL_VERSION', '1.0.0' );
define( 'STL_GBL_CORE', basename( dirname( __FILE__ ) ) .'core/' );
define( 'STL_GBL_ASSET', get_stylesheet_directory_uri().'/assets/' );

include_once 'inc/loader.php';

class STL_Theme_Global	{

	public function init() {
		add_action('plugins_loaded', array($this, 'load_textdomain'));
		add_action('wp_enqueue_scripts', array($this, 'assets'));
		register_activation_hook( __FILE__, array($this, 'activate') );
		register_deactivation_hook(__FILE__, array($this, 'deactivate') );
		$this->reset();
		$this->includes();
	} 

	public function reset() {
		
	}

	public function assets() {
		wp_enqueue_script( 'stl_global', STL_GBL_ASSET.'js/app.js',  array('stl_core'), STL_GBL_VERSION, true);
		wp_enqueue_style( 'stl_global', STL_GBL_ASSET.'css/app.css',  array('stl_core'), STL_GBL_VERSION, false);
	}

	public function activate() {
		
	}

	public function deactivate() {
	
	}

	public function load_textdomain() {
		load_plugin_textdomain( 'stencil-child', FALSE, basename( dirname( __FILE__ ) ).'/assets/langs/' );
	}

	

	public function includes() {
		//require_once('vendors/bootstrap.php');
	}
}

$STL = new STL_Theme_Global();
$STL->init();