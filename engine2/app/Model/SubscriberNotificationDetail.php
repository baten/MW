<?php
App::uses('AppModel', 'Model');
/**
 * SubscriberNotificationDetail Model
 *
 * @property Subscriber $Subscriber
 */
class SubscriberNotificationDetail extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'subscriber_id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'subscriber_id' => array(
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

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Subscriber' => array(
			'className' => 'Subscriber',
			'foreignKey' => 'subscriber_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
