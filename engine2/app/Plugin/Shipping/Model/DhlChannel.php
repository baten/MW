<?php
App::uses('ShippingAppModel', 'Shipping.Model');
/**
 * DhlChannel Model
 *
 * @property Country $Country
 * @property City $City
 */
class DhlChannel extends ShippingAppModel {
	
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
	//public $displayField = 'id';
	//public $primaryKey = array('country_code','state_code');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		/* 'city_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		), */
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Country' => array(
			'className' => 'Shipping.Country',
			'foreignKey' => 'country_code',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
			
		/*'City' => array(
			'className' => 'Shipping.City',
			'foreignKey' => 'city_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)*/
	);
}
