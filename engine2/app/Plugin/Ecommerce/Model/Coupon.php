<?php
App::uses('EcommerceAppModel', 'Ecommerce.Model');
/**
 * Coupon Model
 *
 */
class Coupon extends EcommerceAppModel {
	
public $useDbConfig = 'ecommerce';
//public $actsAs = array('Enumerable');

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'coupons';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'coupon_number';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'coupon_number' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
	        'uniqueCouponNumberRule' => array(
	            'rule' => 'isUnique',
	            'message' => 'Coupon Number already axists'
	        )
		),
		'discount_type' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'discount_amount' => array(
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

	function updateCouon($couponNumber){
		$this->query("UPDATE `coupons` SET `status`='Inactive' WHERE `coupon_number`='".$couponNumber."'");
	}

}
