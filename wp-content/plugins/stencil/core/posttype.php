<?php

namespace Stencil\Core;

if ( !defined( 'ABSPATH' ) ) exit;
use Stencil\Core\Base\Post_Base;
use Stencil\Core\Template;


class Posttype {

	public function create_post($post) {
		if(!$post->is_extend()) {
			add_action('init', function () use ($post) {
				$args = array_merge(array(

					'labels'                => array(
						'archives'              => __( 'Item Archives', 'stencil' ),
						'attributes'            => __( 'Item Attributes', 'stencil' ),
						'parent_item_colon'     => __( 'Parent Item:', 'stencil' ),
						'all_items'             => __( 'All Items', 'stencil' ),
						'add_new_item'          => __( 'Add New Item', 'stencil' ),
						'add_new'               => __( 'Add New', 'stencil' ),
						'new_item'              => __( 'New Item', 'stencil' ),
						'edit_item'             => __( 'Edit Item', 'stencil' ),
						'update_item'           => __( 'Update Item', 'stencil' ),
						'view_item'             => __( 'View Item', 'stencil' ),
						'view_items'            => __( 'View Items', 'stencil' ),
						'search_items'          => __( 'Search Item', 'stencil' ),
						'not_found'             => __( 'Not found', 'stencil' ),
						'not_found_in_trash'    => __( 'Not found in Trash', 'stencil' ),
						'featured_image'        => __( 'Featured Image', 'stencil' ),
						'set_featured_image'    => __( 'Set featured image', 'stencil' ),
						'remove_featured_image' => __( 'Remove featured image', 'stencil' ),
						'use_featured_image'    => __( 'Use as featured image', 'stencil' ),
						'insert_into_item'      => __( 'Insert into item', 'stencil' ),
						'uploaded_to_this_item' => __( 'Uploaded to this item', 'stencil' ),
						'items_list'            => __( 'Items list', 'stencil' ),
						'items_list_navigation' => __( 'Items list navigation', 'stencil' ),
						'filter_items_list'     => __( 'Filter items list', 'stencil' ),
					),
					'supports' => array(
						'title'
					),
					'taxonomies'            => [],
					'hierarchical'          => false,
					'public'                => true,
					'show_ui'               => true,
					'show_in_menu'          => true,
					'menu_position'         => 5,
					'show_in_admin_bar'     => true,
					'show_in_nav_menus'     => true,
					'can_export'            => true,
					'has_archive'           => true,
					'exclude_from_search'   => false,
					'publicly_queryable'    => true,
					'capability_type'       => 'post',

				), $post->args());
				register_post_type( $post->name(), $args );
			}, 10);
		}
		
		foreach ($post->taxonomies() as $taxonomy) {
			add_action('init', function () use ($post, $taxonomy) {
				$args = array_merge(array(
					'labels'                     => array(
						'all_items'                  => __( 'All Items', 'stencil' ),
						'parent_item'                => __( 'Parent Item', 'stencil' ),
						'parent_item_colon'          => __( 'Parent Item:', 'stencil' ),
						'new_item_name'              => __( 'New Item Name', 'stencil' ),
						'add_new_item'               => __( 'Add New Item', 'stencil' ),
						'edit_item'                  => __( 'Edit Item', 'stencil' ),
						'update_item'                => __( 'Update Item', 'stencil' ),
						'view_item'                  => __( 'View Item', 'stencil' ),
						'separate_items_with_commas' => __( 'Separate items with commas', 'stencil' ),
						'add_or_remove_items'        => __( 'Add or remove items', 'stencil' ),
						'choose_from_most_used'      => __( 'Choose from the most used', 'stencil' ),
						'popular_items'              => __( 'Popular Items', 'stencil' ),
						'search_items'               => __( 'Search Items', 'stencil' ),
						'not_found'                  => __( 'Not Found', 'stencil' ),
						'no_terms'                   => __( 'No items', 'stencil' ),
						'items_list'                 => __( 'Items list', 'stencil' ),
						'items_list_navigation'      => __( 'Items list navigation', 'stencil' ),
					),
					'hierarchical'               => true,
					'public'                     => true,
					'show_ui'                    => true,
					'show_admin_column'          => true,
					'show_in_nav_menus'          => true,
					'show_tagcloud'              => true,
				), $taxonomy['args']);
				register_taxonomy( $taxonomy['name'], array($post->name()), $args);
			}, 0);
		}
		add_filter( 'rwmb_meta_boxes', function($meta_boxes) use ($post) {
			
			$meta_boxes[] = array(
				'id'         => $post->name().'_metabox',
				'title'      => 'Meta Data',
				'post_types' => array($post->name()),
				'context'    => 'normal',
				'priority'   => 'high',
				'fields' => $post->metaboxes()
			);

			if(!$post->is_element()) {
				$template = Template::instance();
				$options = [];
				$options = array_merge($options, $template->option('main', 'main', 'Layout'));
				$options = array_merge($options, $template->option('header', 'main', 'Header'));
				$options = array_merge($options, $template->option('footer', 'main', 'Footer'));
				$options = array_merge($options, $template->option('content', 'main', 'Content'));

				$meta_boxes[] = array(
					'id'         => $post->name().'_layout',
					'title'      => 'Layout Setting',
					'post_types' => array($post->name()),
					'context'    => 'side',
					'priority'   => 'low',
					'fields' => $options
				);
			}
			return $meta_boxes;
		});
	}

	public function add($class) {
		add_filter('stencil/post', function ($collections) use ($class) {
			$collections[] = $class;
			return $collections;
		}, 10, 2);
	}

	public function register() {
		add_action( 'after_setup_theme', function() {
			$posts  = apply_filters('stencil/post', []);
			foreach ($posts as $post) {
				$this->create_post($post);
			}
		});
		
	}

	private static $instance;

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->register();
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

