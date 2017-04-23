<?php
App::uses('EcommerceAppModel', 'Ecommerce.Model');
/**
 * Deliveryman Model
 *
 */
class Deliveryman extends EcommerceAppModel {

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
	public $displayField = 'name';

    public $hasMany = array(
        'ProductOrders' => array(
            'className' => 'Ecommerce.ProductOrder',
            'foreignKey' => 'deliveryman_id',
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
