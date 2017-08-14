<?php
/*
 *use,include必须写在class的外边，否则无效
 */
include_once 'aliyun-php-sdk-core/Config.php';
use Sms\Request\V20160927 as Sms; 
class Pandoracommon extends CI_Controller {

 
	function __construct() {
		parent::__construct ();
	}
   /*
    *这是一个专门写AJAX的控制器
    */
    //验证登录信息
    public function verification(){
        $nickname = $this->input->post ( 'name' );
		$pwd = $this->input->post ( 'pwd' );
		$this->load->model ( 'Pandorasecret' );
		$result = $this->Pandorasecret->varify ( $nickname, $pwd );
		if ($result) {
			$this->Pandorasecret->set_sesstion( $nickname, $pwd );
			Header("Location: /pandora/detail");
		} else {
			$this->load->view('wechatapp/login_fail');
		}
    }
	//验证手机号是否重复
    public function phonevarify(){
		$result = false;
		$phone = $this->input->post ( 'phone' );
		$this->load->model ( 'Pandorasecret' );
		$this->Pandorasecret->varify_phone ( $phone);
    }	
    //注册账号
    public function regist(){
        $nickname = $this->input->post ( 'name' );
		$phone = $this->input->post ( 'phone' );
		$pwd = $this->input->post ( 'pwd' );
		$code = $this->input->post('code');
		$usercode = $this->input->post('usercode');
		$result=false;
		if((($code+8989)/107/33)==$usercode){
			$this->load->model ( 'Pandorasecret' );
			$result = $this->Pandorasecret->regist_account ( $nickname, $phone, $pwd );
		}else{
			$this->output->set_content_type ( 'application/json' )->set_output ( json_encode (  
            	$result
			) );
		}

    }
	//提交单条明细
	public function itemadd(){
		$result = true;
		session_start();
		$money = $this->input->post('money');
		$book_id = $this->input->post('book_id');
		$account_id = $this->input->post('account_id');
		$inout_type = $this->input->post('inout_type');
		$category_id = $this->input->post('category_id');
		$remark = $this->input->post('remark');
		$date = $this->input->post('date');
		$this->load->model ( 'Pandorasecret' );
		$this->Pandorasecret->add_item ( $money, $date , $book_id , $account_id ,$inout_type,$category_id,$remark);
		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode (  
            $result
        ) );
	}
	//获取验证码
	public function sendtoali(){
		$phone = $this->input->post ( 'phone' );  
		//获得六位数
		$numbers = range(0,9);
		shuffle($numbers);
		$start = mt_rand(1,4);
		$result = array_slice($numbers,$start,6);
		$random = '';
		for($i=0;$i<6;$i++){
			$random=$random.$result[$i];
		}
		
		//获得手机号后六位
		$lastfour = substr($phone,-4);
		$iClientProfile = DefaultProfile::getProfile("cn-hangzhou", "LTAIZyRh9uRi5j8t", "sXT4YAzh2BdJi96rTwSyjiyNm4UzKZ");        
		$client = new DefaultAcsClient($iClientProfile);    
		$request = new Sms\SingleSendSmsRequest();
		$request->setSignName("欧尼酱");/*签名名称*/
		$request->setTemplateCode("SMS_25385309");/*模板code*/
		$request->setRecNum($phone);/*目标手机号*/
		$request->setParamString("{\"varify_code\":\"{$random}\",\"phone_code\":\"{$lastfour}\"}");/*模板变量，数字一定要转换为字符串*/
		try {
			$response = $client->getAcsResponse($request);
			//print_r($response);
			print_r($random*107*33-8989);
		}
		catch (ClientException  $e) {
			print_r($e->getErrorCode());   
			print_r($e->getErrorMessage());   
		}
		catch (ServerException  $e) {        
			print_r($e->getErrorCode());   
			print_r($e->getErrorMessage());
		}
		return  ($random*107*33-8989);
	}
	//更改账户名和密码
	public function moneychange(){
		$result =true;
		$type = $this->input->post ( 'type' ); 
		$money = $this->input->post ( 'money' ); 
		$account_name = $this->input->post ( 'name' ); 
		$id = $this->input->post ( 'id' ); 
		$this->load->model ( 'Pandorasecret' );
		$this->Pandorasecret->change_money( $money, $type , $account_name,$id);
		$this->output->set_content_type ( 'application/json' )->set_output ( json_encode (  
            $result
        ) );
	}
	//添加账户及余额
	public function accountadd(){
		$result = true;
		session_start();
		$value = $this->input->post('value');
		$name = $this->input->post('name');
		$balance = $this->input->post('balance');
		$remark = $this->input->post('remark');
		$this->load->model('Pandorasecret');
		$this->Pandorasecret->add_account($name,$balance,$value,$remark);
		$this->output->set_content_type('application/json')->set_output( json_encode(
			$result
		));
	}
	//添加品类
	public function addcate(){
		$result = true;
		session_start();
		$name = $this->input->post("name");
		$type = $this->input->post("type");
		$icon = $this->input->post("icon");
		$this->load->model('Pandorasecret');
		$this->Pandorasecret->add_cate($name,$type,$icon);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
	//转账
	public function transfermoney(){
		$result = true;
		session_start();
		$a = $this->input->post("a");
		$b = $this->input->post("b");
		$moneya = $this->input->post("moneya");
		$moneyb = $this->input->post("moneyb");
		$typea = $this->input->post("typea");
		$typeb = $this->input->post("typeb");
		$money =  $this->input->post("money");
		$this->load->model('Pandorasecret');
		$this->Pandorasecret->transfer_money($money,$a,$b,$moneya,$moneyb,$typea,$typeb);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));

	}
    
}