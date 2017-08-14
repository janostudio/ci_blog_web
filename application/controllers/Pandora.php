<?php
class Pandora extends CI_Controller {

	function __construct() {
		parent::__construct ();
	}
	//登录页
	public function index ($page = 'wechatapp/login'){
		if (! file_exists ( 'application/views/' . $page . '.php' )) {
			show_404 ();
		}
		$data["login_fail"] = 0;
		$this->load->view($page,$data);
	}
	//注册页
	public function register ($page = 'wechatapp/register'){
		if (! file_exists ( 'application/views/' . $page . '.php' )) {
			show_404 ();
		}
		$this->load->view($page);
	}
	//账单明细页
	public function detail ($page = 'wechatapp/item_detail'){
		if (! file_exists ( 'application/views/' . $page . '.php' )) {
			show_404 ();
		}
		session_start();
		$this->load->model ('Pandorasecret');
		if(isset($_SESSION ['nickname'])){
			if($this->Pandorasecret->loginvarify ()){
				//获取访问者信息
				$this->Pandorasecret->log_save();
				$data = array();
				$data["detail"] = $this->Pandorasecret->get_detail();
				$this->load->view($page,$data);
			}
		}else{
			$this->load->view('wechatapp/login');
		}
	}
	//用户余额页
	public function balance ($page = 'wechatapp/my_balance'){
		if (! file_exists ( 'application/views/' . $page . '.php' )) {
			show_404 ();
		}
		session_start();
		$this->load->model ('Pandorasecret');
		if(isset($_SESSION ['nickname'])){
			if($this->Pandorasecret->loginvarify ()){
				$data = array();
				$data["balance"] = $this->Pandorasecret->get_balance();				
				$this->load->view($page,$data);
			}
		}else{
			$this->load->view('wechatapp/login');
		}
	}
	//账户余额统计页
	public function balancestatic ($page = 'wechatapp/balance_static'){
		if (! file_exists ( 'application/views/' . $page . '.php' )) {
			show_404 ();
		}
		session_start();
		$this->load->model ('Pandorasecret');
		if(isset($_SESSION ['nickname'])){
			if($this->Pandorasecret->loginvarify ()){
				$data = array();
				$account_id = $this->input->get( 'account_id',true);
				$data["change"] = $this->Pandorasecret->get_special_balance($account_id/7/17);
				$this->load->view($page,$data);
			}
		}else{
			$this->load->view('wechatapp/login');
		}
	}
	//账户余额类型新增页
	public function balancenew ($page = 'wechatapp/balance_new'){
		if (! file_exists ( 'application/views/' . $page . '.php' )) {
			show_404 ();
		}
		session_start();
		$this->load->model ('Pandorasecret');
		if(isset($_SESSION ['nickname'])){
			if($this->Pandorasecret->loginvarify ()){
				$this->load->view($page);
			}
		}else{
			$this->load->view('wechatapp/login');
		}
	}
	//账户余额新增页
	public function balancenewdetail ($page = 'wechatapp/balance_new_detail'){
		if (! file_exists ( 'application/views/' . $page . '.php' )) {
			show_404 ();
		}
		session_start();
		$this->load->model ('Pandorasecret');
		if(isset($_SESSION ['nickname'])){
			if($this->Pandorasecret->loginvarify ()){
				$data = array();
				$data["value"] = $this->input->get("value");
				$this->load->view($page,$data);
			}
		}else{
			$this->load->view('wechatapp/login');
		}
	}
	//余额转账页面
	public function transfer ($page = 'wechatapp/transfer'){
		if (! file_exists ( 'application/views/' . $page . '.php' )) {
			show_404 ();
		}
		session_start();
		$this->load->model ('Pandorasecret');
		if(isset($_SESSION ['nickname'])){
			if($this->Pandorasecret->loginvarify ()){
				$data = array();
				$data["did"] = $this->input->get("did");
				$data["dname"] = $this->input->get("dname");
				$data["balance"] = $this->Pandorasecret->get_balance();	
				$this->load->view($page,$data);
			}
		}else{
			$this->load->view('wechatapp/login');
		}
	}		
	//新增明细页
	public function additem ($page = 'wechatapp/add_item'){
		if (! file_exists ( 'application/views/' . $page . '.php' )) {
			show_404 ();
		}
		session_start();
		$this->load->model ('Pandorasecret');
		if(isset($_SESSION ['nickname'])){
			if($this->Pandorasecret->loginvarify ()){
				//获取用户品类
				$data=array();
				$data["category"]=$this->Pandorasecret->get_user_category($_SESSION["id"]);
				$data["account"]=$this->Pandorasecret->get_user_account($_SESSION["id"]);
				$this->load->view($page,$data);
			}
		}else{
			$this->load->view('wechatapp/login');
		}
	}
	//明细品类新增页
	public function addcategory ($page = 'wechatapp/add_category'){
		if (! file_exists ( 'application/views/' . $page . '.php' )) {
			show_404 ();
		}
		session_start();
		$this->load->model ('Pandorasecret');
		if(isset($_SESSION ['nickname'])){
			if($this->Pandorasecret->loginvarify ()){				
				$this->load->view($page);
			}
		}else{
			$this->load->view('wechatapp/login');
		}		
	}
	//数据统计页
	public function charts ($page = 'wechatapp/sum_charts'){
		if (! file_exists ( 'application/views/' . $page . '.php' )) {
			show_404 ();
		}
		session_start();
		$this->load->model ('Pandorasecret');
		if(isset($_SESSION ['nickname'])){
			if($this->Pandorasecret->loginvarify ()){
				$this->load->view($page);
			}
		}else{
			$this->load->view('wechatapp/login');
		}
	}
	//个人主页
	public function me ($page = 'wechatapp/me'){
		if (! file_exists ( 'application/views/' . $page . '.php' )) {
			show_404 ();
		}
		session_start();
		$this->load->model ('Pandorasecret');
		if(isset($_SESSION ['nickname'])){
			if($this->Pandorasecret->loginvarify ()){
				$this->load->view($page);
			}
		}else{
			$this->load->view('wechatapp/login');
		}
	}
	//个人信息设置页
	public function mesetting ($page = 'wechatapp/me_setting'){
		if (! file_exists ( 'application/views/' . $page . '.php' )) {
			show_404 ();
		}
		session_start();
		$this->load->model ('Pandorasecret');
		if(isset($_SESSION ['nickname'])){
			if($this->Pandorasecret->loginvarify ()){
				$this->load->view($page);
			}
		}else{
			$this->load->view('wechatapp/login');
		}
	}

}