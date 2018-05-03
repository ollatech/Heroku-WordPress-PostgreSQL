<?php

/**
$posts_array = get_posts(
    array(
        'posts_per_page' => -1,
        'post_type' => 'fabric_building',
        'tax_query' => array(
            array(
                'taxonomy' => 'fabric_building_types',
                'field' => 'term_id',
                'terms' => $cat->term_id,
            )
        )
    )
);

**/
class Stencil_Data {

	public function location() {
		$location = '';
		if(is_home()) {
			$location = 'home';
		}
		if(is_archive() || is_tag() || is_tax()) {
			$location = 'archive';
		}
		if(is_page()) {
			$location = 'page';
		}

		if(is_singular()) {
			$location = 'single';

		}

		if(is_search()) {
			$location = 'search';
		}
		return $location;
	}

	public function terms($taxonomy, $args = []) {
		$args =  array_merge([
		], $args);
		$terms = get_terms($taxonomy, $args);
		$options = [];
		foreach ($terms as $key => $term) {
			$options[$term->term_id] = $term->name;
		}
		return $options;
	}

	public function posts($posttype = 'post', $args = []) {
		$data = [];
		$args = array_merge([
			'post_type' => $posttype,
			'post_per_page' => 10
		], $args);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$data[get_the_ID()] = $this->extract_post();
			}
		}
		wp_reset_postdata();
		return $data;
	}

	public function related_posts($post_id, $args = []) {
		global $post;
		$tags = wp_get_post_tags($post_id);
		$tag_ids = [];
		foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
		$data = [];
		$args = array_merge([
			'tag__in' => $tag_ids,
			'post__not_in' => array($post->ID), 
			'orderby' => 'rand',
			'post_per_page' => 10
		], $args);
		$query = new WP_Query( $args );

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$data[get_the_ID()] = $this->extract_post();
			}
		}
		wp_reset_postdata();
		return $data;
	}

	private function extract_post() {
		$item = [];
		$item['id'] = get_the_ID();
		$item['title'] = get_the_title();
		$item['text'] = get_the_excerpt();
		$item['link'] = get_the_permalink();
		$item['date'] =  get_the_date();
		$item['image'] = '';
		$item['thumbnail'] = '';
		if ( has_post_thumbnail() ) {
			$image  = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
			$item['image'] = $image[0];

			$thumbnail  = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
			$item['thumbnail'] = $thumbnail[0];
		}
		return $item;
	}

	public function attachments($post_id, $args = []) {
		$data = [];
		$args = array_merge([
			'post_type' => 'attachment',
			'posts_per_page' => -1,
			'post_parent' => $post_id
		], $args);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$data[get_the_ID()] = $this->extract_post();
			}
		}
		wp_reset_postdata();
		return $data;
	}

	public function meta($meta_id, $default) {

	}

	public function option($option_id, $default) {

	}

	




	/******************************
	*
	*******************************/
	private static $instance;
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
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


