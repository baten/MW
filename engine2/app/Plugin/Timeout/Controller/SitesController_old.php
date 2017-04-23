<?php
App::uses('TimeoutAppController', 'Timeout.Controller');
/**
 * Clients Controller
 *
 * @property Client $Client
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SitesController extends TimeoutAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Session','RequestHandler','EmailSender');
	
	public $uses = array('Timeout.Client');
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->response->header('Access-Control-Allow-Origin', '*');
		//$this->response->header('Access-Control-Allow-Origin', '*');
		
		$this->Auth->allow(array(
				'client_registration',
				'client_login',
				'client_profile',
				'check_current_password',
				'update_password',
				'lookbook',
				'homeblock',
				'gallery',
				'sendMail'
			)
		);
		
	}
	
	
	
/*
 * cleint registraion
 */	
	public function client_registration(){
		
		if($this->request->is('post')){
			$data =  $this->request->data;
			$cilentData = array();
			foreach($data as $key => $value){
				if($value['name'] != 'repassword'){
					if($value['name'] == 'username'){
						$cilentData['Client'][$value['name']] =$value['value'];
					}elseif($value['name'] == 'password'){
						$cilentData['Client'][$value['name']] =$value['value'];
					}else{
						$cilentData['Client']['details'][$value['name']] =$value['value'];
					}
				}
			}
			$cilentData['Client']['details'] = json_encode($cilentData['Client']['details']);
			
			if($this->Client->find('count',array('conditions'=>array('username'=>$cilentData['Client']['username']))) > 0){
				$return_data = array();
				$return_data['status'] = 'error';
				$return_data['message'] = 'Already registered.';
			}else{
				if($this->Client->save($cilentData)){
					
					//send email
					$emailConfig['from_email'] = 'info@timeoutstore.com'; //'joopdeyn@msn.com';
					$emailConfig['from_name'] = 'www.timeoutstore.com';
					$emailConfig['to'] = $cilentData['Client']['username'];
					$emailConfig['subject'] = 'Registration';
					$emailConfig['template'] = 'registration';
					$emailConfig['data'] = $cilentData;
					$this->EmailSender->sendEmail($emailConfig);
					
					
					$return_data = array();
					$return_data['status'] = 'success';
					$return_data['message'] = 'Registration has been completed.';
				}else{
					$return_data = array();
					$return_data['status'] = 'error';
					$return_data['message'] = 'Can not be procced.';
				}
			}
			
		}else{
			$return_data = array();
			$return_data['status'] = 'error';
			$return_data['message'] = 'Invalid Request.';
		}
		
		$this->set(
			array(
				'_serialize',
				'data' => array('registerClient'=>$return_data),
				'_jsonp' => true
			)
		);
		$this->render('json_render');
	}

	
	public function client_login(){
		$response = array();
		if($this->request->is('post')){
			//catch post ata
			$data =  $this->request->data;//input('json_decode',true);
			
			//process data
			$login_data = array();
			foreach($data as $key=>$value){
				$login_data[$value['name']] =$value['value'];
			}
			//check user auth credential
			$is_valid_user = $this->Client->processLogin($login_data['username'],$login_data['password']);
			
			if($is_valid_user != 'error'){
				unset($is_valid_user['Client']['password']);
				
				$response['status'] = 'success';
				$response['loggeduser'] = $is_valid_user;
			} else {
				$response['status'] = 'error';
				$response['message'] = 'Username and Password does not match';
			}
			
		//block other type of request.	
		}else{
			$response['status'] = 'error';
			$response['message'] = 'Invalid Request.';
		}
		
		//process the view
		$this->set(
			array(
				'_serialize',
				'data' => array('clientLogin'=>$response),
				'_jsonp' => true
			)
		);
		$this->render('json_render');
	}
	
/**
 * 
 */	
	public function client_profile(){
		if($this->request->is('post')){
			$data =  $this->request->data;
			
			//get current profile
			if($data['action'] == 'get_data'){
				
				$profile_data = $this->Client->find(
					'first',
					array(
							'conditions'=> array(
								'id' => $data['client_id']		
							)
					)
				);
				
				
				
				$this->set(
					array(
						'_serialize',
						'data' => array('clientProfile'=>$profile_data),
						'_jsonp' => true
					)
				);
			}
			//update profile
			else{
				//$new_profile_data['Client']['details']= json_encode($data['new_data']);
				$profile_data = array();
				foreach($data['new_data'] as $key=>$value){
					$profile_data[$value['name']] = $value['value'];
				}
				$new_profile_data['Client']['details'] = json_encode($profile_data);
				
				$this->Client->id = $data['client_id'];
				if($this->Client->save($new_profile_data)){
					$response['status'] = true;
					$response['message'] = 'Profile has been updated';
				}else{
					$response['status'] = false;
					$response['message'] = 'Profile update failed';
				}
				$this->set(
					array(
						'_serialize',
						'data' => array('clientProfileUpdate'=>$response),
						'_jsonp' => true
					)
				);
			}
			
		}
		
	
		$this->render('json_render');
	}

	/*
	 * check current password
	 */
	public function check_current_password(){
		
		
		if($this->request->is('post')){
			$post_data =  $this->request->data;
			$current_data = $this->Client->find('first',array('conditions'=>array('id'=> $post_data['client_id'])));
			$password_is_valid = $this->Client->processLogin($current_data['Client']['username'], $post_data['current_password']);
			if($password_is_valid == 'error'){
				$password_validation['message'] = 'Password does not match';
			}else{
				$password_validation['message'] = '';
			}
		}
		else{
			$password_validation['message'] = 'Invalid request';
		}
		$this->set(
			array(
				'_serialize',
				'data' => array('clientPasswordCheck'=>$password_validation),
				'_jsonp' => true
			)
		);
		
		$this->render('json_render');
		
	}

/**
 * update password
 */	
	public function update_password(){
		if($this->request->is('post')){
			$post_data =  $this->request->data;
			$this->Client->id = $post_data['client_id'];
			$update_data['Client']['password'] = $post_data['new_password'];
			if($this->Client->save($update_data)){
				$response['status'] = true;
				$response['message'] = 'Password has been updated';
			}else{
				$response['status'] = false;
				$response['message'] = 'Password can not be updated';
			}
			
		}else{
			$response['message'] = 'Invalid Request';
		}
		
		$this->set(
				array(
						'_serialize',
						'data' => array('clientUpdatePassword'=>$response),
						'_jsonp' => true
				)
		);
		
		$this->render('json_render');
	}
	
	
/**
 * get brands
 */	
	
	public function getBrands(){
		$response = ClassRegistry::init('Ecommerce.Brand')->find('list',array('conditions'=>array('status'=>'active')));
		
		$this->set(
				array(
						'_serialize',
						'data' => array('brandList'=>$response),
						'_jsonp' => true
				)
		);
		
		$this->render('json_render');
	}
	
	//look book
	public function lookbook(){
		$response = ClassRegistry::init('Timeout.Lookbook')->find('all',array('order'=>array('order'=>'asc')));
		$this->set(
			array(
				'_serialize',
				'data' => array('lookbook'=>$response),
				'_jsonp' => true
			)
		);
	
		$this->render('json_render');
	}
	
	//look book
	public function homeblock(){
		$response = ClassRegistry::init('Timeout.HomeBlock')->find('all');//,array('order'=>array('order'=>'asc')));
		$this->set(
				array(
					'_serialize',
					'data' => array('homeblock'=>$response),
					'_jsonp' => true
				)
		);
	
		$this->render('json_render');
	}
	
	//look book
	public function gallery(){
		$response = ClassRegistry::init('Timeout.Gallery')->find('all');//,array('order'=>array('order'=>'asc')));
		$this->set(
				array(
						'_serialize',
						'data' => array('gallery'=>$response),
						'_jsonp' => true
				)
		);
	
		$this->render('json_render');
	}
	
	
	public function sendMail(){
		if($this->request->is('POST')){
			$postData = $this->request->data;
			
			
			$emailConfig['from_email'] = $postData[0]['value']; //'joopdeyn@msn.com';
			$emailConfig['from_name'] = $postData[1]['value'];
			$emailConfig['to'] = 'info@timeoutstore.com';
			$emailConfig['subject'] = $postData[3]['value'];
			$emailConfig['template'] = 'enquiry';
			$emailConfig['data'] = $postData;
			
			
		
			$this->EmailSender->sendEmail($emailConfig);
			$response['status'] = true;
			$response['message'] = "Mail has been sent.";
			
		}else{
			$response['status'] = false;
			$response['message'] = "Invalid Request.";
				
		}
	
		$this->set(
				array(
						'_serialize',
						'data' => array('sendEmail'=>$response),
						'_jsonp' => true
				)
		);
	
		$this->render('json_render');
	}

}
