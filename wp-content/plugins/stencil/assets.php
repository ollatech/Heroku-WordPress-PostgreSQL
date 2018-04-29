<?php
namespace Stencil;


if (!defined('ABSPATH'))
    exit;


final class Assets {

	public function init() {
		add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
		add_action('admin_enqueue_scripts', array($this, 'enqueue_styles'));
	}

	public function enqueue_scripts() {
		wp_register_script(
			'stencil-admin-js',
			STL_ASSET_URL . 'js/stencil.min.js',
			[
				'jquery',
			],
			STL_VERSION,
			true
		);
		wp_localize_script(
			'stencil-admin-app',
			'stencil',
			[
				'home_url' => home_url()
			]
		);
		wp_enqueue_script( 'stencil-admin-js' );
	}


	public function enqueue_styles() {
		wp_register_style(
			'stencil-admin-css',
			STL_ASSET_URL . 'css/stencil-wrapper.min.css',
			[
				
			],
			STL_VERSION
		);
		wp_enqueue_style( 'stencil-admin-css' );
	}


    private static $instance;

    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
            self::$instance->init();
        }
        return self::$instance;
    }
    public function __clone() {
        _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'stencil'), '1.6');
    }

    public function __wakeup() {
        _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'stencil'), '1.6');
    }
}


