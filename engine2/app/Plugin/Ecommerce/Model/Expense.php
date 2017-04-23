<?php
App::uses('EcommerceAppModel', 'Ecommerce.Model');
/**
 * Expense Model
 *
 */
class Expense extends EcommerceAppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'ecommerce';
    public $actsAs = array('Containable');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'expense_title_id' => array(
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
    public $belongsTo = array(
        'ExpenseTitle' => array(
            'className' => 'Ecommerce.ExpenseTitle',
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
