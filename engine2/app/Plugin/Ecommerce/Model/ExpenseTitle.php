<?php
App::uses('EcommerceAppModel', 'Ecommerce.Model');
/**
 * ExpenseTitle Model
 *
 */
class ExpenseTitle extends EcommerceAppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'ecommerce';
    public $actsAs = array('Containable');

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

    public $hasMany = array(
        'Expense' => array(
            'className' => 'Ecommerce.Expense',
            'foreignKey' => 'expense_title_id',
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
