<?php

class Blogmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }
	//得到博文总数
	public function get_blogsum(){
		$this->db_connect = $this->load->database ( 'default', true );
		$query = $this->db_connect->select ( "count(cid)" )->get ( "contents" );
		foreach ( $query->result_array() as $row ){
			$num = $row['count(cid)'];
		}
		return $num;
	}
    //取得blog文章相关的参数；
    public function get_bloginfo($pagenum){
		// $page = 1;
    	$this->db_connect = $this->load->database ( 'default', true );
    	$query = $this->db_connect->select ( "*" )->where("cid>".($pagenum*5-5)." and cid<".($pagenum*5+1))->get ( "contents" );
    	$blog['title']=array();
    	$blog['slug']=array();
    	$blog['username']=array();
    	$blog['createdtime']=array();
		$blog['cid']=array();
    	foreach ( $query->result_array() as $row ){
    		array_push($blog['title'],$row['title']);
    		array_push($blog['slug'],$row['slug']);
    		array_push($blog['username'],$row['username']);
    		array_push($blog['createdtime'],$row['createdtime']);
			array_push($blog['cid'],$row['cid']);
    	};
    	return $blog;
    }
	//获取blogtitle以及cid
	public function get_blogtitle(){
		$this->db_connect = $this->load->database ( 'default', true );
		$query = $this->db_connect->select ( "cid,title" )->where("cid<20")->get ( "contents" );
    	$title['title']=array();
		$title['cid']=array();
		foreach ( $query->result_array() as $row ){
			array_push($title['title'],$row['title']);
			array_push($title['cid'],$row['cid']);
		}
		return $title;
	}
    //通过Ajax获取blog文章的正文
	public function get_blog($cid){
		$this->db_connect = $this->load->database ( 'default', true );
		$query=$this->db_connect->select("text")->where("cid",$cid)->get("contents");
		$arr=array();
		foreach($query->result_array() as $row){
			$arr = $row['text'];
		}
		return $arr;
	}
	//通过编辑，上传新的博客
	public function blog_upload($title,$slug,$text){
		$this->db_connect = $this->load->database ( 'default', true );
		$sql = "INSERT INTO contents (title,slug,createdtime,username,text,authorid,type) VALUES (?,?,?,?,?,?,?)";
		$result = $this->db_connect->query($sql, array($title,$slug,date("Y-m-d H:i:s"),$_SESSION['nickname'],$text,$_SESSION['uid'],'Text'));
		return $result;
	}
}
