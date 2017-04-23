<?php
App::uses('ShippingAppModel', 'Shipping.Model');
/**
 * City Model
 *
 * @property Country $Country
 */
class City extends ShippingAppModel {

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
	public $displayField = 'city_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'city_name' => array(
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

	//get city list
	public function getCities($country_code,$state_code){
		return $this->find('list',array('conditions'=>array('state_code'=>$state_code,'country_code'=>$country_code)));
	}
	
	//get city list
	public function cityList($cond_string){
		$cond_string = substr($cond_string, 0,-1);
		$cond = array("City.id IN($cond_string)");
		return $this->find('list',array('conditions'=>$cond));
	}
	
	//get city list by array
	public function getCityListByArrayData($array){
		return $this->find('list',
			array('conditions'=>array('id'=>$array),
						'order'=>array('city_name'=>'ASC')
				  )
				           );
	}	
	
}