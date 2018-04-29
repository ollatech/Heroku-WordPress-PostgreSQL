<?php
namespace Stencil\Vendors\Html;

use Stencil\Vendors\Html\Element_Html;
use DOMDocument;
use DOMElement;
use InvalidArgumentException;

class Html {

	protected $template_engine;
	protected $elements = [];
	protected $providers = [];

	public function get_elements() {
		return $this->elements;
	}

	public function get_element($element, $model) {
		if(isset($this->elements[$element])) {
			$el = $this->elements[$element];
			return $el->get_model($model);
		}
	}

	public function set_template_engine($engine) {
		$this->template_engine = $engine;
	}

	public function add_element($name, $callable) {
		if($callable instanceof Element) {
			$this->elements[$name] = $callable;
		} else {
			throw new InvalidArgumentException('Invalid Element, callable class must extend Element class.');
		}
	}

	public function isElementExist($element) {
		if($element && isset($this->elements[$element]) && $this->elements[$element] instanceof Element) {
			return true;
		}
		return false;
	}

	public function convertToHtml($element) {

		if($this->isElementExist($element['element'])) {
			$converter  = $this->elements[$element['element']];
		} else {
			$converter = new Element_Html();
		}

		$name = $converter->compose_name($element);
		$model = $converter->compose_model($element);
		$node = $converter->compose_node($element);;
		$attributes = $converter->compose_atts($element);
		$config = $converter->compose_config($element);
		$text = $converter->compose_text($element);
		$children = '';

		if(isset($element['children']) && !empty($element['children'])) {
			foreach ($element['children'] as $key => $child) {
				if(method_exists($converter, 'compose_children') && array_key_exists($child['element'], $converter->childrens)) {
					$children .= $converter->compose_children($child);
				} else {
					$children .= $this->convertToHtml($child);
				}
			}
		}
		$values = [
			'name' => $name,
			'model' => $model,
			'node'=> $node, 
			'config' => $config,
			'attributes' => $attributes,
			'children' => $children,
			'text' => $text
		];
		return $this->template_engine->load($converter->render_html($element['model'],$values),$values);

	}

	public function convertToJson(DOMElement $element) {
		$name = false;

		foreach ($element->attributes as $attribute) {
			if ('name' == $attribute->name) {
				$name = $attribute->value;
			}
		}

		if($this->isElementExist($name)) {
			$converter  = $this->elements[$name];
		} else {
			$converter = new Element_Html();
		}
		$name = $converter->extract_name($element);
		$model = $converter->extract_model($element);
		$node = $converter->extract_node($element);;
		$attributes = $converter->extract_atts($element);
		$config = $converter->extract_config($element);
		$children = [];

		if ($element->hasChildNodes()) {
			foreach ($element->childNodes as $childNode) {
				$child_name = false;
				if(isset($childNode->attributes)) {
					foreach ($childNode->attributes as $child_attribute) {
						if ('name' == $child_attribute->name) {
							$child_name = $child_attribute->value;
						}
					}
				}

				if(method_exists($converter, 'extract_children') && array_key_exists($child_name, $converter->childrens)) {
					$children .= $converter->extract_children($childNode);
				} else {
					if (XML_ELEMENT_NODE === $childNode->nodeType) {
						$children[] = $this->convertToJson($childNode);
					}
					elseif (XML_TEXT_NODE === $childNode->nodeType ) {
						$text = $childNode->nodeValue;
						if ("" != trim($text)) {
							$children[] = [
								'node' => 'text',
								'text' => trim($text)
							];
						}
					}
				}
			}
		}

		$result = [
			'node'=> $node, 
			'config' => $config,
			'attributes' => $attributes,
			'children' => $children
		];
		if($name) {
			$result['name'] = $name;
		}
		if($model) {
			$result['model'] = $model;
		}
 		return $converter->render_json($model,$result);
		
	}

	public function jsonToHtml($json) {
		$data = json_decode($json);
		$data = $this->object_to_array($data);

		$output = '';
		foreach ($data as $object) {
			$output .= $this->convertToHtml($object);
		}
		return $output;
	}

	public function htmlToJson($data) {
		if (false === mb_strpos(mb_strtolower(mb_substr($data, 0, 80)), '<!doctype') ) {
			$data = "<!DOCTYPE html><html><head><meta charset='UTF-8' /></head><body>$data</body></html>";
		}
		$dom = new DOMDocument('1.0', 'UTF-8');
		@libxml_use_internal_errors(true);
		$dom->loadHTML($data);
		@libxml_clear_errors();
		$body = $dom->getElementsByTagName('body');
		if (0 == $body->length) {
			throw new InvalidArgumentException('Invalid HTML.');
		}
		
		$element = $body->item(0);
		$data = [];
		if ($element->hasChildNodes()) {
			foreach ($element->childNodes as $childNode) {
				if (XML_ELEMENT_NODE === $childNode->nodeType) {
					$data[] = $this->convertToJson($childNode);
				}
				elseif (XML_TEXT_NODE === $childNode->nodeType ) {
					$text = $childNode->nodeValue;
					if ("" != trim($text)) {
						$data[] = [
							'node' => 'text',
							'text' => $text
						];
					}
				}
			}
		}
		return json_encode($data, JSON_PRETTY_PRINT);
	}

	function object_to_array($data) {
		if (is_object($data)) {
			$data = get_object_vars($data);
		}
		if (is_array($data)) {
			return array_map(array($this, 'object_to_array'), $data);
		}
		else {
			return $data;
		}
	}

	//singeton
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