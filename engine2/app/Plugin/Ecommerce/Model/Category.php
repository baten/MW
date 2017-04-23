<?php
App::uses('EcommerceAppModel', 'Ecommerce.Model');
/**
 * Category Model
 *
 * @property Category $ParentCategory
 * @property Category $ChildCategory
 */
class Category extends EcommerceAppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'ecommerce';
	
	public $actsAs = array('Containable');

	//public $tablePrefix ='english_';
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
		'parent_id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
		'meta_keys' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'meta_description' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'description' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
		'order' => array(
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

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	 public $belongsTo = array(
		'ParentCategory' => array(
			'className' => 'Ecommerce.Category',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	); 

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ChildCategory' => array(
			'className' => 'Ecommerce.Category',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Childcat' => array(
			'className' => 'Ecommerce.Category',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ProductCategory' => array(
			'className' => 'Ecommerce.ProductCategory',
			'foreignKey' => 'category_id',
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
	
	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasOne = array(
		'CategoryImage' => array(
			'className' => 'Ecommerce.CategoryImage',
			'foreignKey' => 'category_id',
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
	
	public function beforeSave($options = array()){
		$data = $this->data;
		if(!empty($data['Category']['title'])){
			$title = $data['Category']['title'];
			$slug = $this->slugify(strtolower($title),'-');
			//pr($slug);die();
			//pr($slug);
			
			
			$checkSlugData = $this->query("SELECT id,slug FROM english_categories as Category WHERE title = '".addslashes($title) ."' AND slug != 'NULL'");
			//pr(each($check_slug));
			$newdata = Set::extract('/Category/.', $checkSlugData);
			$check_slug = array_column($newdata,'slug','id');
			 
			if(count($check_slug) == 0){
				if(!empty($data['Category']['id'])){
					if($this->exists($data['Category']['id'])){
						if($this->langsName == 'English'){
							$data['Category']['slug'] = $slug;
						}
					}else{
						$data['Category']['slug'] = $slug;
					}
						
				}else{
					$data['Category']['slug'] = $slug;
				}
				
			}else{
				if(!empty($data['Category']['id'])){
					if($this->exists($data['Category']['id'])){
						if($this->langsName == 'English'){
							if(!empty($data['Category']['slug'])){
								if($data['Category']['slug'] === $check_slug[$data['Category']['id']]){
									$data['Category']['slug'] = $data['Category']['slug'];
								}else{
									natcasesort($check_slug);
									$newArr = array_reverse($check_slug);
									$new_val = reset($newArr);
									$new_val_arr = explode('~', $new_val);
									if(count($new_val_arr) >  1){
										$intVal = ((int) $new_val_arr[1] + 1);
										$data['Category']['slug'] = $new_val_arr[0]."~{$intVal}";
									}else{
										$data['Category']['slug'] = $slug."~1";
									}
								}
							}else{
								natcasesort($check_slug);
								$newArr = array_reverse($check_slug);
								$new_val = reset($newArr);
								$new_val_arr = explode('~', $new_val);
								if(count($new_val_arr) >  1){
									$intVal = ((int) $new_val_arr[1] + 1);
									$data['Category']['slug'] = $new_val_arr[0]."~{$intVal}";
								}else{
									$data['Category']['slug'] = $slug."~1";
								}
							}
						}
					}else{
						natcasesort($check_slug);
						$newArr = array_reverse($check_slug);
						$new_val = reset($newArr);
						$new_val_arr = explode('~', $new_val);
						if(count($new_val_arr) >  1){
							$intVal = ((int) $new_val_arr[1] + 1);
							$data['Category']['slug'] = $new_val_arr[0]."~{$intVal}";
						}else{
							$data['Category']['slug'] = $slug."~1";
						}
					}
					
	
				}else{
					natcasesort($check_slug);
					$newArr = array_reverse($check_slug);
					$new_val = reset($newArr);
					$new_val_arr = explode('~', $new_val);
					if(count($new_val_arr) >  1){
						$intVal = ((int) $new_val_arr[1] + 1);
						$data['Category']['slug'] = $new_val_arr[0]."~{$intVal}";
					}else{
						$data['Category']['slug'] = $slug."~1";
					}
				}
	
			}
			//pr($data);die();
			$this->data = $data;
			return true;
		}
	
	}
	
}
