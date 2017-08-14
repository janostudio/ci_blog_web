<?php

class Pandorasecret extends CI_Model {    
    var $db_connect;
	var $query;
	var $result;
    //验证账户名，并返回bool值
	public function varify($nickname, $pwd) {
		$this->db_connect = $this->load->database ( 'pandora', true );
		$result = false;
		$arr = array (
				'nickname' => $nickname,
				'password' => $pwd 
		);
		$query = $this->db_connect->select ( "nickname" )->where ( $arr )->get ( "user_table" );
		foreach ( $query->result () as $row ) {
			if ($row->nickname == $nickname) {
				$result = true;
			}
		};
		return $result;
	}
    // 设置session保存用户信息，设置数据库sessionid
	public function set_sesstion($nickname, $pwd) {
		session_start ();
		$_SESSION ['nickname'] = $nickname;
		$_SESSION ['sessionid'] = session_id ();
		$this->db_connect = $this->load->database ( 'pandora', true );
		$where=array('nickname'=>$nickname);
		$query = $this->db_connect->select ( "id" )->where ($where)->get ( "user_table" );
		foreach ( $query->result () as $row ){
			$id = $row->id;
		};
		$_SESSION ['id'] = $id;
		$query2 = $this->db_connect->select ( "nickname" )->where ($where)->get ( "user_table" );
		foreach ( $query2->result () as $row ){
			$nickname = $row->nickname;
		};
		$_SESSION ['nickname'] = $nickname;
		$data = array ('session_id' =>session_id (),'last_logging_time'=>date("Y-m-d H:i:s"));
		$this->db_connect->where ( 'id', $id );
		if ($this->db_connect->update ('user_table',$data)){
			return true;
		} else {
			return false;
		}
	}
    // 验证用户是否登陆
	public function loginvarify() {
		$this->db_connect = $this->load->database ( 'pandora', true );
		if(isset($_SESSION ['nickname'])){
			$nickname = $_SESSION ['nickname'];
			$query = $this->db_connect->select ( "session_id" )->where ( 'nickname', $nickname )->get ( "user_table" );
			foreach ( $query->result () as $row ) {
				$id = $row->session_id;
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
			$this->db_connect = $this->load->database ( 'pandora', true );
			$sql = "INSERT INTO user_log (user_id,ip_address,login_time) VALUES (?,?,?)";
			$this->db_connect->query($sql, array($_SESSION['id'],$_SERVER["REMOTE_ADDR"],date("Y-m-d H:i:s")));
		}
	}
	//验证手机号是否重复
	public function varify_phone( $phone ){
		$this->db_connect = $this->load->database ( 'pandora', true );
		$sql = "SELECT id  from user_table where phone_number = ".$phone;
		$query = $this->db_connect->query($sql);
		foreach ( $query->result () as $row ){
			$id = $row->id;
		};
		if(isset($id)){
			$result = false;
		}else{
			$result = true;
		}
		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode (  
            $result
        ) );
	}	
	//注册账号(应同时创建账本，基础余额账户，成员等)
	public function regist_account( $nickname, $phone, $pwd ){
		$result = true;
		$this->db_connect = $this->load->database ( 'pandora', true );
		$sql = "INSERT INTO user_table (phone_number,nickname,password,createtime) VALUES (?,?,?,?)";
		$this->db_connect->query($sql, array($phone,$nickname,$pwd,date("Y-m-d H:i:s")));
		$sql2 = "SELECT id from user_table where phone_number = ".$phone;
		$query = $this->db_connect->query($sql2);
		foreach ( $query->result () as $row ){
			$id = $row->id;
		};		
		//创建默认账本
		$sql = "INSERT INTO book_table (user_id,book_name) VALUES (?,?)";
		$this->db_connect->query($sql, array($id,"默认账本"));		
		//创建默认的账户,8种类型
		$sql3 = "SELECT account_type_name,id,account_type_icon,account_remark from account_type_table ";
		$query3 = $this->db_connect->query($sql3);
		foreach ( $query3->result () as $row3 ){
			$sql = "INSERT INTO balance_table (user_id,account_name,account_type_id,account_icon,account_remark,createtime) VALUES (?,?,?,?,?,?)";
			$this->db_connect->query($sql, array($id,$row3->account_type_name,$row3->id,$row3->account_type_icon,$row3->account_remark,date("Y-m-d H:i:s")));
		};
		//创建默认开销收入种类
		$sql = "SELECT category_name,category_icon,category_inout_type from category_table where user_id is NULL";
		$query4 = $this->db_connect->query($sql);
		foreach ( $query4->result () as $row4 ){
			$sql = "INSERT INTO category_table (user_id,category_name,category_icon,category_inout_type) VALUES (?,?,?,?)";
			$this->db_connect->query($sql, array($id,$row4->category_name,$row4->category_icon,$row4->category_inout_type));
		};	
		//创建成员表	
		$sql = "INSERT INTO member_table (user_id,member_name) VALUES (?,?)";
		$this->db_connect->query($sql, array($id,"我"));

		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode (  
            $result
        ) );
	}
	//增加明细页获取用户个人品类
	public function get_user_category($id){
		$this->db_connect = $this->load->database ( 'pandora', true );
		$sql = "SELECT category_name,category_icon,category_inout_type,id  from category_table where user_id = ".$id;
		$query = $this->db_connect->query($sql);
		$category['name']=array();
    	$category['icon']=array();
		$category['catetype']=array();
		$category['cateid']=array();
		foreach( $query->result () as $row ){
    		array_push($category['name'],$row->category_name);
    		array_push($category['icon'],$row->category_icon);
			array_push($category['catetype'],$row->category_inout_type);
			array_push($category['cateid'],$row->id);
		}	
		return $category;
	}
	//获取用户账户
	public function get_user_account($id){
		$this->db_connect = $this->load->database ( 'pandora', true );
		$sql = "SELECT account_name,id  from balance_table where user_id = ".$id;
		$query = $this->db_connect->query($sql);
		$account['accountname']=array();
		$account['accountid']=array();

		foreach( $query->result () as $row ){
    		array_push($account['accountname'],$row->account_name);
    		array_push($account['accountid'],$row->id);
		}	
		return $account;
	}
	//提交单条明细
	public function add_item ( $money,$date, $book_id , $account_id ,$inout_type,$category_id,$remark){
		$this->db_connect = $this->load->database ( 'pandora', true );
		$sql = "INSERT INTO item_detail_table (user_id,date,money,book_id,account_id,inout_type,category_id,member_id,remark,createtime)  VALUES  (?,?,?,?,?,?,?,?,?,?)";
		$this->db_connect->query($sql, array($_SESSION['id'],$date,$money,$book_id , $account_id ,$inout_type,$category_id,"3",$remark,date("Y-m-d H:i:s")));
		//在账户中加减余额
		$sql = "SELECT account_type_id,money_sum,money_limit from balance_table where id = ".$account_id;
		$query = $this->db_connect->query($sql);
		foreach($query->result () as $row){
			$balance["type"] = $row->account_type_id;
			$balance["money_sum"] = $row->money_sum;
			$balance["money_limit"] = $row->money_limit;
		}
		if($balance["type"]==3){
			if($inout_type == 'N'){
				$money = $balance["money_limit"] - $money;
			}else{
				$money = $balance["money_limit"] + $money;
			}
			$sql = "UPDATE balance_table SET money_limit = ".$money." where id = ".$account_id;
			$query = $this->db_connect->query($sql);
		}else{
			if($inout_type == 'N'){
				$money = $balance["money_sum"] - $money;
			}else{
				$money = $balance["money_sum"] + $money;
			}
			$sql = "UPDATE balance_table SET money_sum = ".$money." where id = ".$account_id;
			$query = $this->db_connect->query($sql);
		}
	}
	//获取明细
	public function get_detail(){
		$this->db_connect = $this->load->database ( 'pandora', true );
		$day1 = date("Y-m-d");
		$para = strtotime("today");
		$day2 = strtotime("-4 day",$para);
		$daylast = date("Y-m-d",$day2);
		$sql = "SELECT money,account_id,category_id,inout_type,date  from item_detail_table where user_id = ".$_SESSION["id"]." and date >= '".$daylast."' and date <= '".$day1."' order by date desc";
		$query = $this->db_connect->query($sql);
		$daydata['money']=array();
		$daydata['account']=array();
		$daydata['category_id']=array();
		$daydata['inout_type']=array();
		$daydata['date']=array();
		foreach( $query->result () as $row ){
    		array_push($daydata['money'],$row->money);
			$sql = "SELECT account_name from balance_table where user_id = ".$_SESSION["id"]." and id = ".$row->account_id;
			$query1 = $this->db_connect->query($sql);
			foreach( $query1->result () as $row1 ){
    			array_push($daydata['account'],$row1->account_name);
			}
			$sql = "SELECT category_name from category_table where user_id = ".$_SESSION["id"]." and id = ".$row->category_id;
			$query2 = $this->db_connect->query($sql);
			foreach( $query2->result () as $row2 ){
    			array_push($daydata['category_id'],$row2->category_name);
			}			
			array_push($daydata['inout_type'],$row->inout_type);
			array_push($daydata['date'],$row->date);
		}		
		return $daydata;
	}
	//获取余额
	public function get_balance(){
		$this->db_connect = $this->load->database ( 'pandora', true );
		$sql = "SELECT id,money_sum,money_limit,account_icon,account_type_id,account_name,account_remark  from balance_table where user_id = ".$_SESSION["id"];
		$query = $this->db_connect->query($sql);
		$balance["account_name"]=array();
		$balance["account_icon"]=array();
		$balance["account_remark"]=array();
		$balance["money_sum"]=array();
		$balance["money_limit"]=array();
		$balance["account_type_id"]=array();
		$balance["id"]=array();
		foreach($query->result() as $row){
			array_push($balance["account_name"],$row->account_name);
			array_push($balance["account_icon"],$row->account_icon);
			array_push($balance["account_remark"],$row->account_remark);
			array_push($balance["money_sum"],$row->money_sum);
			array_push($balance["money_limit"],$row->money_limit);
			array_push($balance["account_type_id"],$row->account_type_id);
			array_push($balance["id"],$row->id);
		}
		return $balance;
	}
	//得到特定账户值
	public function get_special_balance($account_id){
		$this->db_connect = $this->load->database ( 'pandora', true );
		$sql = "SELECT id,money_sum,money_limit,account_type_id,account_name  from balance_table where id = ".$account_id;
		$query = $this->db_connect->query($sql);
		foreach($query->result() as $row){
			$account["id"] = $row->id;
			$account["money_sum"] = $row->money_sum;
			$account["money_limit"] = $row->money_limit;
			$account["account_type_id"] = $row->account_type_id;
			$account["account_name"] = $row->account_name;
		}
		$account["month"] = date("m");
		$account["year"] = date("Y");
		$yearmonth = date("Y-m");
		$account["cate_money"] = array();
		$account["cate_inout_type"] = array();
		$account["cate_date"] = array();
		$account["cate_remark"] = array();
		$account["cate_name"] = array();
		$account["cate_icon"] = array();
		//获得明细
		$sql = "SELECT money,category_id,inout_type,date,remark  from item_detail_table where user_id = ".$_SESSION["id"]." and account_id = ".$account_id." and date >= '".$yearmonth."-1' and date <= '".$yearmonth."-31' order by date desc";
		$query = $this->db_connect->query($sql);
		foreach($query->result() as $row){
			array_push($account["cate_money"] , $row->money);
			array_push($account["cate_inout_type"] , $row->inout_type);
			array_push($account["cate_date"] , $row->date);
			array_push($account["cate_remark"] , $row->remark);
			$sql = "SELECT category_icon,category_name  from category_table where user_id = ".$_SESSION["id"]." and id = ".$row->category_id;
			$query1 = $this->db_connect->query($sql);
			foreach($query1->result() as $row1){
				array_push($account["cate_name"] , $row1->category_name);
				array_push($account["cate_icon"] , $row1->category_icon);
			}
		}
		//获得总计
		$sql = "SELECT sum(money) as sum_out from item_detail_table where user_id = ".$_SESSION["id"]." and account_id = ".$account_id." and inout_type = 'N' and date >= '".$yearmonth."-1' and date <= '".$yearmonth."-31' order by date desc";
		$query = $this->db_connect->query($sql);	
		foreach($query->result() as $row){
			$account["sum_out"] = $row->sum_out;
		}	
		$sql = "SELECT sum(money) as sum_in from item_detail_table where user_id = ".$_SESSION["id"]." and account_id = ".$account_id." and inout_type = 'Y' and date >= '".$yearmonth."-1' and date <= '".$yearmonth."-31' order by date desc";
		$query = $this->db_connect->query($sql);	
		foreach($query->result() as $row){
			$account["sum_in"] = $row->sum_in;
		}		
		return $account;
	}
	//更改账户名与余额
	public function change_money( $money, $type , $account_name,$id){
		$this->db_connect = $this->load->database ( 'pandora', true );
		if($account_name != "notchange"){
			$sql = "UPDATE balance_table SET account_name = '".$account_name."' where id = ".$id;
			$query = $this->db_connect->query($sql);
		}
		if($money != "notchange"){
			if($type!=3){
				$sql = "UPDATE balance_table SET money_sum = ".$money." where id = ".$id;
				$query = $this->db_connect->query($sql);
			}else{
				$sql = "UPDATE balance_table SET money_limit = ".$money." where id = ".$id;
				$query = $this->db_connect->query($sql);				
			}
		}		
	}
	//添加新的账户及余额
	public function add_account($name,$balance,$value,$remark){
		$this->db_connect = $this->load->database ( 'pandora', true );
		switch($value){
			case 1:
				$sql = "INSERT INTO balance_table (user_id,account_type_id,account_name,account_icon,account_remark,money_sum,createtime) VALUES (?,?,?,?,?,?,?)";
				$query =$this->db_connect->query($sql, array($_SESSION['id'],$value,$name,"cash",$remark,$balance,date("Y-m-d H:i:s")));
			break;
			case 2:
				$sql = "INSERT INTO balance_table (user_id,account_type_id,account_name,account_icon,account_remark,money_sum,createtime) VALUES (?,?,?,?,?,?,?)";
				$query =$this->db_connect->query($sql, array($_SESSION['id'],$value,$name,"deposit_card",$remark,$balance,date("Y-m-d H:i:s")));
			break;
			case 3:
				$sql = "INSERT INTO balance_table (user_id,account_type_id,account_name,account_icon,account_remark,money_limit,createtime) VALUES (?,?,?,?,?,?,?)";
				$query =$this->db_connect->query($sql, array($_SESSION['id'],$value,$name,"credit_card",$remark,$balance,date("Y-m-d H:i:s")));
			break;
			case 4:
				$sql = "INSERT INTO balance_table (user_id,account_type_id,account_name,account_icon,account_remark,money_sum,createtime) VALUES (?,?,?,?,?,?,?)";
				$query =$this->db_connect->query($sql, array($_SESSION['id'],$value,$name,"network_account",$remark,$balance,date("Y-m-d H:i:s")));
			break;
			case 5:
				$sql = "INSERT INTO balance_table (user_id,account_type_id,account_name,account_icon,account_remark,money_sum,createtime) VALUES (?,?,?,?,?,?,?)";
				$query =$this->db_connect->query($sql, array($_SESSION['id'],$value,$name,"investment",$remark,$balance,date("Y-m-d H:i:s")));
			break;
			case 6:
				$sql = "INSERT INTO balance_table (user_id,account_type_id,account_name,account_icon,account_remark,money_sum,createtime) VALUES (?,?,?,?,?,?,?)";
				$query =$this->db_connect->query($sql, array($_SESSION['id'],$value,$name,"pre_paid",$remark,$balance,date("Y-m-d H:i:s")));
			break;
			case 7:
				$sql = "INSERT INTO balance_table (user_id,account_type_id,account_name,account_icon,account_remark,money_sum,createtime) VALUES (?,?,?,?,?,?,?)";
				$query =$this->db_connect->query($sql, array($_SESSION['id'],$value,$name,"debt",$remark,$balance,date("Y-m-d H:i:s")));
			break;
			case 8:
				$sql = "INSERT INTO balance_table (user_id,account_type_id,account_name,account_icon,account_remark,money_sum,createtime) VALUES (?,?,?,?,?,?,?)";
				$query =$this->db_connect->query($sql, array($_SESSION['id'],$value,$name,"loan",$remark,$balance,date("Y-m-d H:i:s")));
			break;
		}		

	}
	//添加新的品类
	public function add_cate($name,$type,$icon){
		$this->db_connect = $this->load->database('pandora',true);
		$sql = "INSERT INTO category_table (user_id,category_name,category_icon,category_inout_type) VALUES (?,?,?,?)";
		$query = $this->db_connect->query($sql,array($_SESSION['id'],$name,$icon,$type));
	}
	//转账
	public function transfer_money($money,$a,$b,$moneya,$moneyb,$typea,$typeb){
		$this->db_connect = $this->load->database('pandora',true);
		if($typea == 3){
			$sql = "UPDATE balance_table SET money_limit = ".$moneya." where id = ".$a;
			$query = $this->db_connect->query($sql);
			$sql = "INSERT INTO item_detail_table (user_id,date,money,book_id,account_id,inout_type,category_id,member_id,remark,createtime)  VALUES  (?,?,?,?,?,?,?,?,?,?)";
			$this->db_connect->query($sql, array($_SESSION['id'],date("Y-m-d"),$money,"11", $a ,"N",(int)($_SESSION['id'])*2+4,"3","转出",date("Y-m-d H:i:s")));
		}else{
			$sql = "UPDATE balance_table SET money_sum = ".$moneya." where id = ".$a;
			$query = $this->db_connect->query($sql);
			$sql = "INSERT INTO item_detail_table (user_id,date,money,book_id,account_id,inout_type,category_id,member_id,remark,createtime)  VALUES  (?,?,?,?,?,?,?,?,?,?)";
			$this->db_connect->query($sql, array($_SESSION['id'],date("Y-m-d"),$money,"11", $a ,"N",(int)($_SESSION['id'])*2+4,"3","转出",date("Y-m-d H:i:s")));			
		}
		if($typeb == 3){
			$sql = "UPDATE balance_table SET money_limit = ".$moneyb." where id = ".$b;
			$query = $this->db_connect->query($sql);
			$sql = "INSERT INTO item_detail_table (user_id,date,money,book_id,account_id,inout_type,category_id,member_id,remark,createtime)  VALUES  (?,?,?,?,?,?,?,?,?,?)";
			$this->db_connect->query($sql, array($_SESSION['id'],date("Y-m-d"),$money,"11", $b ,"Y",(int)($_SESSION['id'])*2+4,"3","转入",date("Y-m-d H:i:s")));			
		}else{
			$sql = "UPDATE balance_table SET money_sum = ".$moneyb." where id = ".$b;
			$query = $this->db_connect->query($sql);
			$sql = "INSERT INTO item_detail_table (user_id,date,money,book_id,account_id,inout_type,category_id,member_id,remark,createtime)  VALUES  (?,?,?,?,?,?,?,?,?,?)";
			$this->db_connect->query($sql, array($_SESSION['id'],date("Y-m-d"),$money,"11", $b ,"Y",(int)($_SESSION['id'])*2+4,"3","转入",date("Y-m-d H:i:s")));			
		}
	}


}