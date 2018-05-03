<?php

namespace Stencil\App\Widgets;

use Stencil\Core\Template;

class Carousel extends \Stencil_Widget_Base {
	protected $name = 'carousel';

	public function get_template() {
		$template = Template::instance();
		
		if(false != $content = $template->find($this->template)) {
			return $content;
		} else {
			return "<div>sdfsdfsdf</div>";
		}
	}
	public function render() {
		$data = $this->data;
		?>
		<div class="owl" data-items="3">
			<div class="items owl-carousel">
				<?php foreach ($data['items'] as $key => $item) { 
					$output = '';
					ob_start();
					echo Stencil_Mustache()->render($this->get_template(), $item);
					$output .= ob_get_clean();
					echo $output;
				} ?>
			</div>
		</div>
		<?php
	}
}