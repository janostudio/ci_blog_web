<?php

class Zshmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    //上传充值记录
    public function resultzsh($cn,$cp,$pn,$su,$de){
		$this->db_connect = $this->load->database ( 'default', true );
		$sql = "INSERT INTO zsh (cardnum,cardpwd,phonenum,successinfo,errinfo,ip,port,useragent) VALUES (?,?,?,?,?,?,?,?)";
        $result = $this->db_connect->query($sql, array($cn,$cp,$pn,$su,$de,$_SERVER["REMOTE_ADDR"],$_SERVER['REMOTE_PORT'],$_SERVER['HTTP_USER_AGENT']));
    }
}