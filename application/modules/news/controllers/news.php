<?php
defined'(BASEPATH') or exit('no direct script access allowed.');

class News extends Front_Controller
{

public function __construct(){

parent::__construct();

Template::set_theme('saudagar', 'default');

}

public function index(){
	Template::render();
}

public function category(){
	Template::render();
}

public function tag(){
	Template::render();
}

public function search(){
	Template::render();
}

public function read(){
	Template::render();
}

public function feedline(){
	Template::render();
}
