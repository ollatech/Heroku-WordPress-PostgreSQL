<?php

class Stencil_Loader {

	protected $includes = [];
	

	protected function className($path, $prefix = null, $suffix = null) {
		$class = $this->filename($path);
		if($prefix) {
			$class = $prefix.$class;
		}
		if($suffix) {
			$class = $class.$suffix;
		}
		$class = str_replace("-", "_",$class);
		$class = ucwords(str_replace("_", " ",$class));
		$class = str_replace( " ", "_", $class );
		return $class;
	}

	protected function init() {

	}

	protected function includes() {
		foreach ( $this->includes as $include ) {
			$this->require_file( STL_PATH . "$include.php" );
		}
	}


	protected function filename($path) {
		return basename($path);  
	}

	

	protected function require_file( $file ) {
		if ( file_exists( $file ) ) {
			require_once $file;
			return true;
		}
		return false;
	}
}