<?php
App::uses('EcommerceAppModel', 'Ecommerce.Model');
/**
 * ProductStock Model
 *
 * @property Product $Product
 */
class ProductStock extends EcommerceAppModel {

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
		'quantity' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sold' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Product' => array(
			'className' => 'Ecommerce.Product',
			'foreignKey' => 'product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function getStockByProductId($productId){
		return $data = $this->find(
			'list',
			array(
				'fields' => array('attributeValues','attributes'),
				'conditions' => array(
					'product_id' => $productId,
					'attributeValues IS NOT NULL'
				)
			)
		);
	}
	
	public function getDetaultStock($productId){
		return $this->find(
			'first',
			array(
				'fields'=>array('quantity'),
				'conditions'=>array('product_id'=>$productId,'attributes'=>NULL,'attributeValues' => NULL)
				)
			);
	}
}
