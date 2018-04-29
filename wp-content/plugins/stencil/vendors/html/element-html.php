<?php
namespace Stencil\Vendors\Html;
use DOMDocument;
use DOMElement;

class Element_Html extends Element {
	public $name = 'html';
	public $configs = [];
	public $childrens = [];
	public $models = [
		
	];
	public function compose_name($element) {

	}
	public function compose_model($element) {
		
	}

	public function extract_name(DOMElement $element) {
		
	}
	public function extract_model(DOMElement $element) {
		
	}

	public function render_html($model, $values = []) {
		$output = '';
		ob_start();
		?>
		<{{node}} {{{name}}} {{{attributes}}}>{{{config}}}{{{text}}}{{{children}}}</{{node}}>
		<?php
		$output .= ob_get_clean();
		return $output;
	}
}