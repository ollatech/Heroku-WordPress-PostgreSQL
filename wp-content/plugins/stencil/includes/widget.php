<?php


class Stencil_Widget {

	public function swiper($data = [], $args = [], $template = '') {
		?>
		<div class="swiper-container swiper_standard">

			<div class="swiper-wrapper">
				<?php foreach ($data as $key => $item) { 
					$output = '';
					ob_start();
					?>
					<div class="swiper-slide">
						<?php
						echo Stencil_Mustache()->render($template, $item);
						?>
					</div>
					<?php
					$output .= ob_get_clean();
					echo $output;
				} ?>
			</div>
			<div class="swiper-pagination"></div>

			<div class="swiper-button-prev"></div>
			<div class="swiper-button-next"></div>
			<div class="swiper-scrollbar"></div>
		</div>
		<?php
	}

	public function carousel($data = [], $args = [], $template = '') {
		?>
		<div class="owl" data-items="3">
			<div class="items owl-carousel">
				<?php foreach ($data as $key => $item) { 
					$output = '';
					ob_start();
					echo Stencil_Mustache()->render($template, $item);
					$output .= ob_get_clean();
					echo $output;
				} ?>
			</div>
		</div>
		<?php
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
