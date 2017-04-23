<?php
App::uses('ShippingAppModel', 'Shipping.Model');
/**
 * State Model
 *
 */
class State extends ShippingAppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'shipping';
	

/**
 * Display field
 *
 * @var string
 */
	//public $displayField = 'state_name';
	//public $primaryKeyArray  = array('country_code','state_code');
	//public $primaryKey = 'state_code';
	
	public $belongsTo = array(
		'Country' => array(
			'className' => 'Shipping.Country',
			'foreignKey' => 'country_code',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)		
	);
	
	
	//public $hasMany = array(
		/*'Channel' => array(
			'className' => 'Shipping.Channel',
			'foreignKey' => 'state_code',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),*/
		/*'City' => array(
			'className' => 'Shipping.City',
			'foreignKey' => 'country_code',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)*/
	//);
	
	//get state list
	public function getStates($country_code){
		return $this->find('list',array('fields'=>array('state_code','state_name'),'conditions'=>array('country_code'=>$country_code),'order'=>array('state_name'=>'ASC')));
	}
	
	//get city list
	public function stateList($cond_string){
		$cond_string = substr($cond_string, 0,-1);
		$cond = array("State.state_code IN($cond_string)");
		return $this->find('list',array('conditions'=>$cond));
	}
	
	//get city list by array
	public function getStateListByArrayData($array){
		return $this->find('list',array('conditions'=>array('State.state_code'=>$array)));
	}
}
