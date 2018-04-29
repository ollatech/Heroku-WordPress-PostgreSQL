<?php
namespace Stencil\Core\Base;

use Stencil\Core\Field;

class Option_Group_Base {
	
	protected $name;
	protected $title;
	protected $description;
	protected $icon;
	protected $options;

	public function add_option($name, $callable) {
		$this->options[$name] = $callable;
	}

	public function name() {
		return $this->name;
	}
	
	public function title() {
		return $this->title;
	}

	public function description() {
		return $this->description;
	}

	public function icon() {
		return $this->icon;
	}

	public function render() {
		if (!current_user_can('manage_options')) {
			wp_die('Unauthorized user');
		}
		$page = explode('-', $_GET['page']);
		$current_option = $_GET['section'];
		$options  = $this->options;
		?>
		<div class="wrap ux-wrapper">
			<form method="post">
				<div id="icon-themes" class="icon32"></div>
				<h2><?php echo $this->title; ?></h2>
				<div class="ux-tab">
					<?php if(count($options) > 0) { ?> 
					<ul class="nav nav-tabs" id="navRight" role="tablist">
						<?php
						foreach ($options as $key => $option) { ?>
						<li class="nav-item">
							<a class="nav-link active" id="home-tab" data-toggle="tab" href="?page=<?php echo $_GET['page']; ?>&section=<?php echo $key; ?>"  aria-selected="true"><?php echo $option->title(); ?></a>
						</li>
						<?php }
						?>
					</ul>
					<?php } ?>
					<div class="ux-section pt-10">
						<?php
						if($options[$current_option]) {
							$option = $options[$current_option];
							$field = Field::instance();
							echo $field->render($option->controls());
						}
						?>
						<?php submit_button(); ?>
					</div>
				</div>
			</form>
		</div>
		<?php
	}
}