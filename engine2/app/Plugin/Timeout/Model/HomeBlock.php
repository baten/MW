<?php
App::uses('TimeoutAppModel', 'Timeout.Model');
/**
 * HomeBlock Model
 *
 */
class HomeBlock extends TimeoutAppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'timeout';

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'homeBlocks';

/**
 * Display field
 *
 * @var string
 */
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
		'url' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
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
	
	public function getHomeblockImgExtById($id){
		$data = $this->find('first',array('recursive'=>-1,'fields'=>array('image_extension'),'conditions'=>array('id'=>$id)));
		return $data;
	}
}
