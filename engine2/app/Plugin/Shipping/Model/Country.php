<?php
App::uses('ShippingAppModel', 'Shipping.Model');
/**
 * Country Model
 *
 * @property City $City
 */
class Country extends ShippingAppModel {

	public $actsAs = array('Containable');
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
	public $displayField = 'country_name';
	
	public $primaryKey = 'country_code';
	
	

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'country_name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)		
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		
		'State' => array(
			'className' => 'Shipping.State',
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
		),
		
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
		),*/
		
		/*'Channel' => array(
			'className' => 'Shipping.Channel',
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
	);

	public function getCountries(){
			$model = $this;
	     	return Cache::remember('all_countries_list', function() use ($model){
	         	return $model->find('list',array('order'=>array('country_name'=>'ASC')));
		       }, 'long');
				
	}

}
