<?php
class Zsh extends CI_Controller {

	function __construct() {
		parent::__construct ();
	}
	//网站主页
	public function index ($page = 'zsh/zsh'){
		if (! file_exists ( 'application/views/' . $page . '.php' )) {
			show_404 ();
		}
		$this->load->view($page);
	}
	//上传充值结果
	public function zshresult(){
        $cn = $this->input->post ( 'cn' );
		$cp = $this->input->post ( 'cp' );
		$pn = $this->input->post ( 'cp' );
		$su = $this->input->post ( 'su' );
		$de = $this->input->post ( 'de' );
		
		$this->load->model ( 'Zshmodel' );
		$this->Zshmodel->resultzsh($cn,$cp,$pn,$su,$de);
	}

}