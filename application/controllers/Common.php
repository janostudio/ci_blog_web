<?php
class Common extends CI_Controller {

	function __construct() {
		parent::__construct ();
	}
   /*
    *这是一个专门写AJAX的控制器，调用数据
    */
    //验证登录信息
    public function verification(){
        $email = $this->input->post ( 'email' );
		$pwd = $this->input->post ( 'pwd' );
		$this->load->model ( 'Secret' );
		$result = $this->Secret->varify ( $email, $pwd );
		if ($result) {
			$this->Secret->set_sesstion( $email, $pwd );
			Header("Location: /home");
		} else {
			$this->load->view('failed');
		}
    }
    
    //获取博客正文的数据
    public function blog_text (){
        $cid = $this->input->post('cid');
        // $cid=1;
        $this->load->model('Blogmodel');
        $text = $this->Blogmodel->get_blog($cid);
        // echo $cid;
        $this->output->set_content_type ( 'application/json' )->set_output ( json_encode (            
            array('text'=>$text)
        ) );
    }

    //编辑新的blog
    public function upload_blog(){
        $title = $this->input->post('title');
        $slug = $this->input->post('slug');
        $text = $this->input->post('text');
        $this->load->model('Blogmodel');
        session_start();
        if(isset($_SESSION['nickname'])){
            $result = $this->Blogmodel->blog_upload($title,$slug,$text);
        }
        $this->output->set_content_type ( 'application/json' )->set_output ( json_encode ($result) );
    }
    //博文翻页
    public function turn_page(){
        $pagenum = $_GET['page'];
        $this->load->model('Blogmodel');
        $bloginfo=$this->Blogmodel->get_bloginfo($pagenum);
        $this->output->set_content_type ( 'application/json' )->set_output ( json_encode (array('bloginfo'=>$bloginfo)) );
    }
}