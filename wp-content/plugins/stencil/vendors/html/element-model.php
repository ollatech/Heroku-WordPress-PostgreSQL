<?php
namespace Stencil\Vendors\Html;


class Element_Model {
	protected $element = "block";
	protected $name;
	protected $title;
	protected $icon;
	protected $control_sections;
	protected $constrols;
	protected $attributes = [];

	public function __construct() {
		$this->control_sections = $this->control_sections();
		$this->controls = $this->controls();
	}

	public function element() {
		return $this->element;
	}
	
	public function name() {
		return $this->name;
	}

	public function title() {
		return __( $this->title , 'stencil' );
	}

	public function icon() {
		return $this->icon;
	}
	public function control_sections() {
		return [

		];
	}
	public function controls() {
		return [

		];
	}

	public function render_html($values = []) {
		$output = '';
		ob_start();
		?>
		<{{node}} {{{name}}} {{{attributes}}}>
		{{{config}}}
		{{{text}}}
		{{{children}}}
		</{{node}}>
		<?php
		$output .= ob_get_clean();
		return $output;
	}

	public function render_json($values = []) {
		return $values;
	}

	public function structure() {
		return [];
	}

	/**
	*
	*/
	public function template() {
		return [
			"element" => $this->element,
			"name" =>$this->name,
			"controls" => $this->controls(),
			"attributes" => $this->attributes,
			"children" => $this->structure()
		];
	}
}