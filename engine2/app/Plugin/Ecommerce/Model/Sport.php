<?php
App::uses('EcommerceAppModel', 'Ecommerce.Model');
/**
 * Sport Model
 *
 */
class Sport extends EcommerceAppModel {

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
		'image_extension' => array(
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
	
	public function beforeSave($options = array()){
		$data = $this->data;
		if(!empty($data['Sport']['title'])){
			$title = $data['Sport']['title'];
			$slug = $this->slugify(strtolower($title),'-');
			//pr($slug);die();
			//pr($slug);
	
	
			$checkSlugData = $this->query("SELECT id,slug FROM english_sports as Sport WHERE title = '".$title ."' AND slug != 'NULL'");
			//pr(each($check_slug));
			$newdata = Set::extract('/Sport/.', $checkSlugData);
			$check_slug = array_column($newdata,'slug','id');
	
			if(count($check_slug) == 0){
				if(!empty($data['Sport']['id'])){
					if($this->exists($data['Sport']['id'])){
						if($this->langsName == 'English'){
							$data['Sport']['slug'] = $slug;
						}
					}else{
						$data['Sport']['slug'] = $slug;
					}
	
				}else{
					$data['Sport']['slug'] = $slug;
				}
	
			}else{
				if(!empty($data['Sport']['id'])){
					if($this->exists($data['Sport']['id'])){
						if($this->langsName == 'English'){
							if(!empty($data['Sport']['slug'])){
								if($data['Sport']['slug'] === $check_slug[$data['Sport']['id']]){
									$data['Sport']['slug'] = $data['Sport']['slug'];
								}else{
									natcasesort($check_slug);
									$newArr = array_reverse($check_slug);
									$new_val = reset($newArr);
									$new_val_arr = explode('~', $new_val);
									if(count($new_val_arr) >  1){
										$intVal = ((int) $new_val_arr[1] + 1);
										$data['Sport']['slug'] = $new_val_arr[0]."~{$intVal}";
									}else{
										$data['Sport']['slug'] = $slug."~1";
									}
								}
							}else{
								natcasesort($check_slug);
								$newArr = array_reverse($check_slug);
								$new_val = reset($newArr);
								$new_val_arr = explode('~', $new_val);
								if(count($new_val_arr) >  1){
									$intVal = ((int) $new_val_arr[1] + 1);
									$data['Sport']['slug'] = $new_val_arr[0]."~{$intVal}";
								}else{
									$data['Sport']['slug'] = $slug."~1";
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
							$data['Sport']['slug'] = $new_val_arr[0]."~{$intVal}";
						}else{
							$data['Sport']['slug'] = $slug."~1";
						}
					}
	
	
				}else{
					natcasesort($check_slug);
					$newArr = array_reverse($check_slug);
					$new_val = reset($newArr);
					$new_val_arr = explode('~', $new_val);
					if(count($new_val_arr) >  1){
						$intVal = ((int) $new_val_arr[1] + 1);
						$data['Sport']['slug'] = $new_val_arr[0]."~{$intVal}";
					}else{
						$data['Sport']['slug'] = $slug."~1";
					}
				}
	
			}
			//pr($data);die();
			$this->data = $data;
			return true;
		}
	
	}
}
