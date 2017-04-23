<?php
App::uses('EcommerceAppModel', 'Ecommerce.Model');
/**
 * Purchase Model
 *
 * @property Product $Product
 */
class Purchase extends EcommerceAppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'ecommerce';
    public $actsAs = array('Containable');


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
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
	);
}
