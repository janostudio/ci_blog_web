<?php
class Home extends CI_Controller {

	function __construct() {
		parent::__construct ();
	}
	
    //网站主页
    public function index ($page = 'home'){
        if (! file_exists ( 'application/views/' . $page . '.php' )) {
			show_404 ();
		}
		session_start();
		$this->load->model ('Secret');
		if(isset($_SESSION ['nickname'])){
			if($this->Secret->loginvarify ()){
				$this->load->view('home_header');
			}
		}else{
			$this->load->view('home_un_header');
		}		
       		$this->load->view($page);
        	$this->load->view('footer');
		//获取访问者信息
		$this->Secret->log_save();

    }
    //测试次级页面
    public function blog ($page = 'blog'){
    	if (! file_exists ( 'application/views/' . $page . '.php' )) {
    		show_404 ();
    	}
    	$data=array();
    	$this->load->model ('Blogmodel');
		$sum = $this->Blogmodel->get_blogsum();
		$pagenum=(int)(($sum-1)/5)+1;
    	$bloginfo=$this->Blogmodel->get_bloginfo($pagenum);
		$blogtitle = $this->Blogmodel->get_blogtitle();
    	// $ip=$this->input->ip_address() ;
		// $this->load->model('Specialmodel');
		// $this->Specialmodel->up_ip($ip);
		session_start();
		$this->load->model ('Secret');
		$data['sum']=json_encode($sum);
		$data['blogtitle']=json_encode($blogtitle);
		$data['bloginfo']=json_encode($bloginfo); 
		if($this->Secret->loginvarify ()){
			$this->load->view('logined',$data);
		}else{    	
			$this->load->view('header',$data);
		}

			$this->load->view($page);
			$this->load->view('footer');
			$this->Secret->log_save();
			///service/getIpInfo.php?ip=[ip地址字串](http://ip.taobao.com/instructions.php)
    }
	//编辑页面
	public function edit ($page = 'edit'){
    	if (! file_exists ( 'application/views/' . $page . '.php' )) {
    		show_404 ();
    	}
		// echo ($_SESSION ['email']);
		session_start();
		$this->load->model ('Secret');
		if($this->Secret->loginvarify ()){
				//判断是该用户在其他浏览器登陆
			 	$this->load->view('logined');
				$this->load->view($page);
				$this->load->view('footer');
			 }else{
				$this->load->view('unlogin');
			 }
	}
	//work页面
	public function work($page = 'work'){
		if (! file_exists ( 'application/views/' . $page . '.php' )) {
    		show_404 ();
    	}
		session_start();
		if(isset($_SESSION['nickname'])){
			$data['nickname'] = $_SESSION['nickname'];
		}else{
			$data['nickname'] = null;
		}
		$this->load->view('header');
		$this->load->view($page,$data);
		$this->load->view('footer');
	}
}

