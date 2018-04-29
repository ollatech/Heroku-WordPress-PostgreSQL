<?php



class Html {
    protected $_root;
    protected $_array = null;
    protected $_removeEmptyStrings = true;
    protected $_parseCss = true;
    
    public function __construct($html) {
        if (false === mb_strpos(mb_strtolower(mb_substr($html, 0, 80)), '<!doctype') ) {
            $html = "<!DOCTYPE html><html><head><meta charset='UTF-8' /></head><body>$html</body></html>";
        }
        $dom = new DOMDocument('1.0', 'UTF-8');
        @libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        @libxml_clear_errors();
        $body = $dom->getElementsByTagName('body');
        if (0 == $body->length) {
            throw new InvalidArgumentException('Invalid HTML.');
        }
        $this->_root = $body[0];
    }
    /**
     * Get serialized html as associative array
     * @return array
     */
    public function toArray() {
        if (null === $this->_array) {
            $array = $this->_domElementToArray($this->_root);
            if(empty($array) || ! isset($array['children'])) {
                $this->_array = [];
            }
            else {
                $this->_array = $array['children'];
            }
        }
        return $this->_array;
    }
    /**
     * Get serialized html as json
     * @return string
     */
    public function toJson() {
        return json_encode($this->toArray(), JSON_PRETTY_PRINT);
    }
    /**
     * Set parse inline css to object
     * @param bool $value
     */
    public function parseCss($value = true) {
        $this->_parseCss = boolval($value);
    }
    /**
     * Set remove nodes with empty whitespaces
     * @param bool $value
     */
    public function removeEmptyStrings($value = true) {
        $this->_removeEmptyStrings = boolval($value);
    }
    protected function _parseInlineCss($css) {
        $urls = [];
        // fix issue with ";" symbol in url()
        $css = preg_replace_callback('/url(\s+)?\(.*\)/i', function ($match) use (&$urls) {
            $index = count($urls) + 1;
            $index = "%%$index%%";
            $urls[$index] = $match[0];
            return $index;
        }, $css);
        $arr = array_filter(array_map('trim', explode(';', $css)));
        $result = [];
        foreach ($arr as $item) {
            list ($attribute, $value) = array_map('trim', explode(':', $item));
            // restore original url()
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
    protected function _domElementToArray(DOMElement $element) {

        $node = mb_strtolower($element->tagName);
        $type = mb_strtolower($element->tagName);
        $attributes = [];
        $attributes['data'] = [];
        $attributes['style'] = [];

        foreach ($element->attributes as $attribute) {
            $attr = mb_strtolower($attribute->name);
            $value = $attribute->value;
            if ('style' == $attr) {
                $value = $this->_parseInlineCss($value);
            }
            $data = explode('-', $attr);
            if($data[0] === 'data') {
            	$attributes['data'][$data[1]] = $value;
            } else {
            	$attributes[$attr] = $value;
            }
        }
        $children = [];
        if ($element->hasChildNodes()) {
            foreach ($element->childNodes as $childNode) {
                if (XML_ELEMENT_NODE === $childNode->nodeType) {
                    $children[] = $this->_domElementToArray($childNode);
                }
                elseif (XML_TEXT_NODE === $childNode->nodeType ) {
                    $text = $childNode->nodeValue;
                    if ("" != trim($text)) {
                        $children[] = [
                            'node' => 'text',
                            'text' => $text
                        ];
                    }
                }
            }
        }
        $result = [
            'node' => $node,
            'type' => $type,
        ];
        if (count($attributes) > 0) {
            $result['attributes'] = $attributes;
        }
        if (count($children) > 0) {
            $result['children'] = $children;
        }
        return $result;
    }
}

class HTMLTranslator {

	protected function atts($atts) {
		$output = '';
		if (!empty($atts)) {
			unset($atts['children']);
			unset($atts['settings']);
			unset($atts['content']);
			foreach($atts as $key => $value) {
				if($key === 'data' && is_array($value)) {
					foreach ($value as $key => $data_value) {
						$att_name = str_replace('_','-', $key);
						$output .= ' data-'. $att_name .'="'. $data_value .'"';
					}
				} else {
					$att_name = str_replace('_','-', $key);
					$output .= ' '. $att_name .'="'. $value .'"';
				}
			}
		}
		return $output;
	}

	protected function styles($atts) {
		$output = '';
		if (!empty($atts)) {

		}
		return $output;
	}

}

class BaseHTMLTranslator extends HTMLTranslator {
	public function start($type, $vars) {
		$output = '';
		$atts = $this->atts($vars);
		$output = '';
		$output .= '<'.$type.'  '.$atts.'>';
		return $output;
	}

	public function content($type, $vars) {
		$output = '';
		if(isset($vars['content'])) {
			$output .= $vars['content'];
		}
		return $output;
	}
	public function end($type, $vars) {
		$output = '';
		$output .= '</'.$type.'>';
		return $output;
	}

	public function setting($type, $vars) {
		$output = '';
		return $output;
	}
}

class rowTranslator extends HTMLTranslator {

	protected $tag = 'div';
	public function start($type, $vars) {
		$output = '';
		$atts = $this->atts($vars);
		$output = '';
		$output .= '<'.$this->tag.'  '.$atts.'>';
		return $output;
	}

	public function content($type, $vars) {


	}


	public function end($type, $vars) {
		$output = '';
		$output .= '</'.$this->tag.'>';
		return $output;
	}
}

class componentHTML {

	protected $translator;
	protected $translators = [];

	public function __construct() {


	}

	public function setTranslator($class) {
		$this->translator = $class;
	}

	public function addTranslator($type, $class) {
		$this->translators[$type] = $class;
	}

	public function jsonToHtml($json) {
		$data = json_decode($json);
		$data = $this->object_to_array($data);
		$output = '';
		foreach ($data as $object) {
			$output .= $this->toHtml($object);
		}
		return $output;
	}

	public function translator($position, $type, $vars) {
		//check if there any translator
		if(isset($this->translators[$type])) {
			$class = new $this->translators[$type];
			if($position == 'start' && method_exists($class, 'start')) {
				return $class->start($type, $vars);
			}
			
			if($position == 'content' && method_exists($class, 'content')) {
				return $class->content($type, $vars);
			}

			if($position == 'end' && method_exists($class, 'end')) {
				return $class->end($type, $vars);
			}
		}

		if(isset($this->translator)) {
			$class = new $this->translator;
			if($position == 'before' && method_exists($class, 'before')) {
				return $class->before($type, $vars);
			}
			if($position == 'start' && method_exists($class, 'start')) {
				return $class->start($type, $vars);
			}
			if($position == 'setting' && method_exists($class, 'setting')) {
				return $class->setting($type, $vars);
			}
			if($position == 'before_children' && method_exists($class, 'before_children')) {
				return $class->before_children($type, $vars);
			}
			if($position == 'after_children' && method_exists($class, 'after_children')) {
				return $class->after_children($type, $vars);
			}
			if($position == 'content' && method_exists($class, 'content')) {
				return $class->content($type, $vars);
			}
			if($position == 'end' && method_exists($class, 'end')) {
				return $class->end($type, $vars);
			}
			if($position == 'after' && method_exists($class, 'after')) {
				return $class->after($type, $vars);
			}
		}
	}


	public function toHtml($data) {
		$type = key($data);
		$vars = $data[$type];
		$output = '';
		$output .= $this->translator('start', $type, $vars);
		$output .= $this->translator('content', $type, $vars);
		if(isset($vars['children'])) {
			foreach ($vars['children'] as $child) {
				$output .= $this->toHtml($child);
			}
		}
		$output .= $this->translator('end', $type, $vars);
		return $output;
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
}




$json = file_get_contents ("file.json");

echo  " \n\n \n\n";
$converter = new componentHTML();
$converter->setTranslator(new BaseHTMLTranslator());
$converter->addTranslator('row', new rowTranslator());
$html = $converter->jsonToHtml($json);
echo $html;
echo  " \n\n end \n\n";

$parse = new Html($html);
$json = $parse->toJson();

print_r($json);