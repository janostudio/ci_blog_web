<?php
class Cellar extends CI_Controller {

	function __construct() {
		parent::__construct ();
	}
	//网站主页
	public function index ($page = 'cellar'){
		if (! file_exists ( 'application/views/' . $page . '.php' )) {
			show_404 ();
		}
	
		$this->load->view($page);
		$this->load->view('footer');
	}
	
}