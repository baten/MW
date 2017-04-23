<?php
App::uses('EcommerceAppModel', 'Ecommerce.Model');
/**
 * Attribute Model
 *
 * @property Type $Type
 * @property AttributeValue $AttributeValue
 */
class Attribute extends EcommerceAppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'ecommerce';

/**
 * Display field
 *
 * @var string
 */
	public $actsAs = array('Containable');
	public $displayField = 'title';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
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

	//The Associations below have been created with all possible keys, those that are not needed can be removed

 
/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'AttributeValue' => array(
			'className' => 'Ecommerce.AttributeValue',
			'foreignKey' => 'attribute_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		) 
	);
	
	
	//get attribute values  associated with attributes
	public function getAttributes(){
			$data = $this->find(
				'all',
			 	array(
		 		'fields'=>array('id','title'),
			 	'contain' => array(
			 			'AttributeValue' => array('fields'=> array('id','value','has_price'))
			 		)
			 	)
			);
		return $data;
	}
	

}
