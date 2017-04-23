<?php
App::uses('EcommerceAppModel', 'Ecommerce.Model');
/**
 * Team Model
 *
 * @property Product $Product
 */
class Team extends EcommerceAppModel {

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
		'slug' => array(
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

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Product' => array(
			'className' => 'Ecommerce.Product',
			'foreignKey' => 'team_id',
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
	
	public function beforeSave($options = array()){
		$data = $this->data;
		if(!empty($data['Team']['title'])){
			$title = $data['Team']['title'];
			$slug = $this->slugify(strtolower($title),'-');
			//pr($slug);die();
			//pr($slug);
	
	
			$checkSlugData = $this->query("SELECT id,slug FROM english_teams as Team WHERE title = '".$title ."' AND slug != 'NULL'");
			//pr(each($check_slug));
			$newdata = Set::extract('/Team/.', $checkSlugData);
			$check_slug = array_column($newdata,'slug','id');
	
			if(count($check_slug) == 0){
				if(!empty($data['Team']['id'])){
					if($this->exists($data['Team']['id'])){
						if($this->langsName == 'English'){
							$data['Team']['slug'] = $slug;
						}
					}else{
						$data['Team']['slug'] = $slug;
					}
	
				}else{
					$data['Team']['slug'] = $slug;
				}
	
			}else{
				if(!empty($data['Team']['id'])){
					if($this->exists($data['Team']['id'])){
						if($this->langsName == 'English'){
							if(!empty($data['Team']['slug'])){
								if($data['Team']['slug'] === $check_slug[$data['Team']['id']]){
									$data['Team']['slug'] = $data['Team']['slug'];
								}else{
									natcasesort($check_slug);
									$newArr = array_reverse($check_slug);
									$new_val = reset($newArr);
									$new_val_arr = explode('~', $new_val);
									if(count($new_val_arr) >  1){
										$intVal = ((int) $new_val_arr[1] + 1);
										$data['Team']['slug'] = $new_val_arr[0]."~{$intVal}";
									}else{
										$data['Team']['slug'] = $slug."~1";
									}
								}
							}else{
								natcasesort($check_slug);
								$newArr = array_reverse($check_slug);
								$new_val = reset($newArr);
								$new_val_arr = explode('~', $new_val);
								if(count($new_val_arr) >  1){
									$intVal = ((int) $new_val_arr[1] + 1);
									$data['Team']['slug'] = $new_val_arr[0]."~{$intVal}";
								}else{
									$data['Team']['slug'] = $slug."~1";
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
							$data['Team']['slug'] = $new_val_arr[0]."~{$intVal}";
						}else{
							$data['Team']['slug'] = $slug."~1";
						}
					}
	
	
				}else{
					natcasesort($check_slug);
					$newArr = array_reverse($check_slug);
					$new_val = reset($newArr);
					$new_val_arr = explode('~', $new_val);
					if(count($new_val_arr) >  1){
						$intVal = ((int) $new_val_arr[1] + 1);
						$data['Team']['slug'] = $new_val_arr[0]."~{$intVal}";
					}else{
						$data['Team']['slug'] = $slug."~1";
					}
				}
	
			}
			//pr($data);die();
			$this->data = $data;
			return true;
		}
	
	}

}
