<?php

use Stencil\Core\Template;
use Stencil\Core\Widget;
use Stencil\Core\Render;
use Stencil\Core\Data;
use Stencil\Core\View;

function Stencil_Template() {
	return Template::instance();
}
function Stencil_Data() {
	return Data::instance();
}
function Stencil_Render() {
	return Render::instance();
}
function Stencil_Widget() {
	return Widget::instance();
}

function Stencil_View() {
	return View::instance();
}

//function helpers

function register_design($name, $args = []) {
	Stencil_Template()->add_design($name, $args);
}

