<?php
App::uses('EcommerceAppModel', 'Ecommerce.Model');
/**
 * Demage Model
 *
 */
class Demage extends EcommerceAppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'ecommerce';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'product_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
    public $belongsTo = array(
        'Product' => array(
            'className' => 'Ecommerce.Product',
            'foreignKey' => 'product_id',
            'dependent' => false,
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
}
