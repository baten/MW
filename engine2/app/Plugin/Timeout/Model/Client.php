<?php
App::uses('TimeoutAppModel', 'Timeout.Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * Client Model
 *
 */
class Client extends TimeoutAppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'timeout';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'details' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
					$this->data[$this->alias]['password'],'Blowfish'
			);
		}
		return true;
	}
	
	public function processLogin($username,$password){
		$salt_data = $this->find('first',array('recursive'=>-1,'conditions'=>array('username'=>$username,'status'=>'active')));
		if(sizeof($salt_data) > 0){
			$hashed = Security::hash($password,'Blowfish',$salt_data['Client']['password']);
			
			if($salt_data['Client']['password'] == $hashed){
				return $salt_data;
			}
		}
		return 'error';
	}
	// alter merchant status
	public function alterStatus($id){
		$data = $this->find('first',array('recursive'=>-1,'fields'=>array('status'),'conditions'=>array('id'=>$id)));
		if($data['Client']['status'] == 'active'){
			$status = 'inactive';
		}else{
			$status = 'active';
		}
		$this->id = $id;
		$this->saveField('status', $status);
		return $status;
	}
	
	//check valid user
	public function checkValidUser($username,$token = ''){
		$ext = '';
		if(!empty($token)){
			$ext = "token = '$token'";
		}
		$data = $this->find(
			'first',
			array(
				'recursive'=>-1,
				'fields'=>array('id'),
				'conditions'=>array("BINARY username = '".$username."'" ,$ext)
			)
		);
		return $data;
	}
	
	
}