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
		$options  = $this->options;
		$current_option = isset($_GET['section']) ? $_GET['section'] : false;
		if(!$current_option && count($options) > 0) {
			$current_option = $options[key($options)]->name();
		}
		if(empty($options)) {
			return;
		}
		$option = $options[$current_option];
		
		?>
		<div class="wrap ux-wrapper">
			<form method="post">
				<div id="icon-themes" class="icon32"></div>
				<h2><?php echo $this->title.' : '.$option->title(); ?></h2>
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
					<div class="ux-section pt-10 rwmb-meta-box" data-autosave="false" data-object-type="stencil">
						<?php
						wp_nonce_field( "rwmb-save-1", "nonce_{333333}" );
						if(isset($options[$current_option])) {
							$option = $options[$current_option];
							foreach ($option->controls() as $key => $field) {
								Field::option($field);
							}
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