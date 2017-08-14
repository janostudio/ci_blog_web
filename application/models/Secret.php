<?php

class Secret extends CI_Model {    
    var $db_connect;
	var $query;
	var $result;
    //验证账户名，并返回bool值
	public function varify($email, $pwd) {
		$this->db_connect = $this->load->database ( 'default', true );
		$result = false;
		$arr = array (
				'mail' => $email,
				'password' => $pwd 
		);
		$query = $this->db_connect->select ( "mail" )->where ( $arr )->get ( "users" );
		foreach ( $query->result () as $row ) {
			if ($row->mail == $email) {
				$result = true;
			}
		};
		return $result;
	}
    // 设置session保存用户信息，设置数据库sessionid
	public function set_sesstion($email, $pwd) {
		session_start ();
		$_SESSION ['email'] = $email;
		$_SESSION ['sessionid'] = session_id ();
		$this->db_connect = $this->load->database ( 'default', true );
		$where=array('mail'=>$email);
		$query = $this->db_connect->select ( "uid" )->where ($where)->get ( "users" );
		foreach ( $query->result () as $row ){
			$uid = $row->uid;
		};
		$_SESSION ['uid'] = $uid;
		$query2 = $this->db_connect->select ( "nickname" )->where ($where)->get ( "users" );
		foreach ( $query2->result () as $row ){
			$nickname = $row->nickname;
		};
		$_SESSION ['nickname'] = $nickname;
		$data = array ('sessionID' =>session_id ());
		$this->db_connect->where ( 'uid', $uid );
		if ($this->db_connect->update ('users',$data)){
			return true;
		} else {
			return false;
		}
	}
    // 验证用户是否登陆
	public function loginvarify() {
		$this->db_connect = $this->load->database ( 'default', true );
		if(isset($_SESSION ['email'])){
			$email = $_SESSION ['email'];
			$query = $this->db_connect->select ( "sessionID" )->where ( 'mail', $email )->get ( "users" );
			foreach ( $query->result () as $row ) {
				$id = $row->sessionID;
			};
			if ($id == $_SESSION ['sessionid']) {
				return true;
			} else {
				return false;
			}
		}
		else{
			return false;
		}
		
	}
	//保存访问者信息
	public function log_save(){
		if($_SERVER["REMOTE_ADDR"]=="::1"){
			return;
		}else{
			$this->db_connect = $this->load->database ( 'default', true );
			$sql = "INSERT INTO log (ip_addr,log_time,page_url) VALUES (?,?,?)";
			$this->db_connect->query($sql, array($_SERVER["REMOTE_ADDR"],date("Y-m-d H:i:s"),$_SERVER["PHP_SELF"]));
		}
	}
}