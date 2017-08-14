<?php

class Specialmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    //取得浏览者的ip并上传
    // public function up_ip($ip){
    //    $this->db_connect = $this->load->database ( 'default', true );
    //    $this->db_connect->insert('watchlog',array("ip_addr"=>163));
    // }
    //取得文章title
    public function get_novel_title(){
		$this->db_connect = $this->load->database ( 'rnovel', true );
		$query = $this->db_connect->select ( "title" )->order_by("title","asc")->get ( "wlxs" );
        $title = array();
		foreach ( $query->result_array() as $row ){
			array_push($title,$row['title']);
		}
		return $title;
    }
    //取得文章
    public function get_novel_context(){
        $this->db_connect = $this->load->database ( 'rnovel', true );
        $where=array('title'=>$_GET['title']);
		$query = $this->db_connect->select ( "context" )->where($where)->get ( "wlxs" );//->order_by("title","asc")
        foreach ( $query->result_array() as $row ){
			$context = $row['context'];
		}
        return $context;
    }
}