<?php
namespace Stencil\Vendors\Html;

use DOMDocument;
use DOMElement;


class Element {

	protected $storage = 'post';
	protected $storage_model = 'element';
	protected $parent = null;
	protected $name;
	protected $controls;
	protected $models;

	public function __construct() {
		$this->controls = $this->controls();
	}

	public function get_models() {
		return $this->models;
	}

	public function get_model($model) {
		if(isset($this->models[$model])) {
			return $this->models[$model];
		}
	}

	public function storage() {
		return $this->storage;
	}

	public function storage_model() {
		return $this->storage_model;
	}


	public function parent() {
		return $this->parent;
	}

	public function name() {
		return $this->name;
	}

	public function controls() {
		return [
		];
	}

	public function add_model($name, $callable) {
		if($callable instanceof Element_Model) {
			$this->models[$name] = $callable;
			return $this;
		} else {
			throw new \UnexpectedValueException('Model must extend Element_Model class. ='.$name);
		}
	}



	public function compose_name($element) {
		return ' name="'.$this->name.'"';
	}
	public function compose_model($element) {
		return ' model="'.$element['model'].'"';
	}
	public function compose_node($element) {
		return $element['node'];
	}
	public function compose_atts($element) {
		$output = '';
		if (!empty($element) && isset($element['attributes'])) {
			foreach($element['attributes'] as $attr => $attr_value) {
				switch ($attr) {
					case 'classes':
					if(is_array($attr_value)) {
						$output .= ' class="';
						foreach ($attr_value as $key => $className) {
							$output .= ' '. $className;
						}
						$output .= '"';
					}
					break;
					case 'data':
					if(is_array($attr_value)) {
						foreach ($attr_value as $dataKey => $dataValue) {
							$att_name = str_replace('_','-', $dataKey);
							$output .= ' data-'. $att_name .'="'. $dataValue .'"';
						}
					}
					break;
					case 'style':
						# code...
					break;
					
					default:
					$att_name = str_replace('_','-', $attr);
					$output .= ' '. $att_name .'="'. $attr_value .'"';
					break;
				}
			}
		}
		return $output;
	}
	public function compose_config($element) {
		return '';
	}
	public function compose_text($element) {
		if(isset($element['text'])) {
			return $element['text'];
		}
	}

	public function extract_name(DOMElement $element) {
		$name = false;
		foreach ($element->attributes as $attribute) {
			if ('name' == $attribute->name) {
				$name = $attribute->value;
			}
		}
		return $name;
	}
	public function extract_model(DOMElement $element) {
		$model = 'standard';
		foreach ($element->attributes as $attribute) {
			if ('model' == $attribute->name) {
				$model = $attribute->value;
			}
		}
		return $model;
	}
	public function extract_node(DOMElement $element) {
		return mb_strtolower($element->tagName);
	}
	public function extract_atts(DOMElement $element) {
		$attributes = [];
		$attributes['data'] = [];
		$attributes['style'] = [];
		foreach ($element->attributes as $attribute) {
			$attr = mb_strtolower($attribute->name);
			$value = $attribute->value;
			if ('style' == $attr) {
				$value = $this->extract_style($value);
			}
			$data = explode('-', $attr);
			if($data[0] === 'data') {
				$attributes['data'][$data[1]] = $value;
			} else {
				$attributes[$attr] = $value;
			}
		}
		return $attributes;
	}
	public function extract_config(DOMElement $element) {
		return [];
	}
	public function extract_text(DOMElement $element) {
		return [];
	}
	protected function extract_style($style) {
		$urls = [];
		$css = preg_replace_callback('/url(\s+)?\(.*\)/i', function ($match) use (&$urls) {
			$index = count($urls) + 1;
			$index = "%%$index%%";
			$urls[$index] = $match[0];
			return $index;
		}, $style);
		$arr = array_filter(array_map('trim', explode(';', $style)));
		$result = [];
		foreach ($arr as $item) {
			list ($attribute, $value) = array_map('trim', explode(':', $item));
			if (preg_match('/%%\d+%%/', $value)) {
				$value = preg_replace_callback('/%%\d+%%/', function ($match) use ($urls) {
					if (isset($urls[$match[0]])) {
						return $urls[$match[0]];
					}
					else {
						return $match[0];
					}
				}, $value);
			}
			$result[$attribute] = $value;
		}
		return $result;
	}

	public function render_html($model, $values = []) {

		if(isset($this->models[$model]) && method_exists($this->models[$model], 'render_html')) {
			return $this->models[$model]->render_html($values);
		} else {
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
	}

	public function render_json($model, $values = []) {
		if(isset($this->models[$model]) && method_exists($this->models[$model], 'render_json')) {
			return $this->models[$model]->render_html($values);
		} else {
			return $values;
		}
		
	}
}