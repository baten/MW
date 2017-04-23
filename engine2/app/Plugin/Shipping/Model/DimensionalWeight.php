<?php
App::uses('ShippingAppModel', 'Shipping.Model');
/**
 * DimensionalWeight Model
 *
 */
class DimensionalWeight extends ShippingAppModel {

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
	public $displayField = 'packageName';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'packageName' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'measurement' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'dimensionWeight' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'actualWeight' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
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
	
	public function getActualWeight($dimensionalWeight){
		$data = $this->find(
			'list',
			array(
				'recursive'	=> -1,
				'fields'=>array('dimensionWeight','actualWeight'),
				'conditions' => array(
					'dimensionWeight >='.$dimensionalWeight
				)
			)
		);
		return $data;
	}
 
}
