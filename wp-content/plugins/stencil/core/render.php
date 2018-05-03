<?php

namespace Stencil\Core;

if ( !defined( 'ABSPATH' ) ) exit;

use Stencil\Core\Template;
use Stencil\Core\Data;
use Stencil\Core\css;

class Render {

	protected $css;
	protected $data;
	protected $template;

	private function setting($target, $default) {
		$result = $default;
		if(null !== $check = get_option( 'global_'.$target, null )) {
			$result = $check;
		}
		if(is_home() && !is_front_page()) {
			if(true == $check = get_option('page_'.$target, false)) {
				$result = $check;
			}
		}
		if(is_archive() || is_tag() || is_tax()) {
			if(true == $check = get_option('archive_'.$target, false)) {
				$result = $check;
			}
		}
		if(is_singular() && !is_front_page()) {
			if(true == $check = get_option('post_'.$target, false)) {
				$result = $check;
			}
		}
		if(is_page() && !is_front_page()) {
			if(true == $check = get_option('page_'.$target, false)) {
				$result = $check;
			}
		}
		if(is_search() && !is_front_page()) {
			if(true == $check = get_option('search_'.$target, false)) {
				$result = $check;
			}
		}
		if(function_exists('is_woocommerce')) {
			if(is_shop()) {
				if(true == $check = get_option('shop_'.$target, false)) {
					$result = $check;
				}
			}
			if(is_product()) {
				if(true == $check = get_option('product_'.$target, false)) {
					$result = $check;
				}
			}
		}
		if(is_singular() || is_page() && !is_front_page()) {
			if(true == $check = rwmb_meta('main_'.$target)) {
				$result = $check;
			}
		}
		return $result;
	}

	public function header() {
		$arg_design = $this->setting('header', 'standard');
		$design = $this->template->find('header/'.$arg_design);
		$data = array_merge($design['config'], [

		]);
		return $this->template->render($design['template'], $data);
	}
	public function footer() {

		$arg_design = $this->setting('footer', 'standard');
		$design = $this->template->find('footer/'.$arg_design);
		$data = array_merge($design['config'], [

		]);
		return $this->template->render($design['template'], $data);
	}
	public function cover() {
		$template = $this->setting('cover', 'standard');
		return $this->template->find('cover/'.$template);
	}

	public function main($content) {
		$arg_design = $this->setting('main', 'standard');

		$design = $this->template->find('main/'.$arg_design);
		$data = array_merge($design['config'], [
			'children' => $content
		]);
		return $this->template->render($design['template'], $data);
	}

	public function shop() {
		$arg_design = $this->setting('shop', 'standard');

		$design = $this->template->find('shop/'.$arg_design);
		$data = array_merge($design['config'], [

		]);
		$content = $this->template->render($design['template'], $data);
		return $this->main($content);
	}



	public function content() {
		$arg_design = $this->setting('content', 'standard');
		$design = $this->template->find('content/'.$arg_design);
		$data = array_merge($design['config'], [

		]);
		$content = $this->template->render($design['template'], $data);

		return $this->main($content);
	}

	public function list($query = [], $args = []) {
		$collection_template = $this->setting('main', 'standard');
		$item_template = $this->setting('item', 'standard');
		if(isset($args['collection_template'])) {
			$collection_template = $args['collection_template'];
		}
		if(isset($args['item_template'])) {
			$item_template = $args['item_template'];
		}
		

		$args = array_merge($args, [
			'item_template' => $item_template,
			'collection_template' => $collection_template
		]);
		
		$content = $this->collection([], $args);
		return $this->main($content);
	}

	public function collection($query = [], $args = []) {
		$collection_template = '';
		$item_template = '';
		if(isset($args['collection_template'])) {
			$collection_template = $args['collection_template'];
		}
		if(isset($args['item_template'])) {
			$item_template = $args['item_template'];
		}
		$design = $this->template->find('collection/'.$collection_template, $args);

		$data = array_merge($design['config'], [
			'query' => $query,
			'item_template' => $item_template
		]);
		return $this->template->render($design['template'], $data);
	}


	public function item($template = false, $data = []) {
		$design = $this->template->find('item/'.$template);
		$data = array_merge($design['config'], $data);
		$content = $this->template->render($design['template'], $data);
		return [
			'item' => $content
		];
	}



	public function widget($name) {
		?>
		<?php if ( is_active_sidebar( $name ) ) : ?>
			<div class="widget-area sidebar">
				<?php dynamic_sidebar( $name ); ?>
			</div>
		<?php endif; ?>

		<?php
	}


	private function library() {
		$this->css = Css::instance();
		$this->data = Data::instance();
		$this->template = Template::instance();
	}

	/******************************
	*
	*******************************/
	private static $instance;
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->library();
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

