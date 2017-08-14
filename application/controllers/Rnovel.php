<?php
class Rnovel extends CI_Controller {

	function __construct() {
		parent::__construct ();
	}
	//网站主页
	public function index ($page = 'rnovel'){
		if (! file_exists ( 'application/views/' . $page . '.php' )) {
			show_404 ();
		}
		$this->load->model('Specialmodel');
		$title=$this->Specialmodel->get_novel_title();
		$data['title'] = json_encode($title);
		$this->load->view($page,$data);
	}
	//得到context
	public function main_content(){
		$this->load->model('Specialmodel');
		$context=$this->Specialmodel->get_novel_context();
		$data['title'] = $_GET['title'];
		$context = str_replace('。','。<br>',$context);
		// $str = preg_replace('//s*/', '<br>', $context);
		$data['context'] = $context;
		$this->load->view('context',$data);
	}
}