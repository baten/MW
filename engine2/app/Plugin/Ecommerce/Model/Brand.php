<?php
App::uses('EcommerceAppModel', 'Ecommerce.Model');
/**
 * Brand Model
 *
 */
class Brand extends EcommerceAppModel {

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
				'message' => 'Please input a title.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'meta_keys' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Please input a meta keys. Max character is 60.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'meta_description' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Please input a meta description. Max character is 60',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'description' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Please input a description.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		/*
		'image_extension' => array(
			
			'image_type' => array(
					'rule' => array('extension', array('jpeg', 'png', 'jpg')),
					'message' => 'Please select valid image ie jpeg,png or jpg.',
					//'allowEmpty' => true,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'image_size' => array(
					'rule' => array('fileSize', '<=', '10MB'),
					'message' => 'Image must be less than 10MB'
					//'allowEmpty' => true,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
			
		),*/
		'order' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please input order.',
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
	
	public function getBranImgExtById($id){
		$data = $this->find('first',array('recursive'=>-1,'fields'=>array('image_extension'),'conditions'=>array('id'=>$id)));
		return $data;
	}
	
	public function beforeSave($options = array()){
		$data = $this->data;
		if(!empty($data['Brand']['title'])){
			$title = $data['Brand']['title'];
			$slug = $this->slugify(strtolower($title),'-');
			//pr($slug);die();
			//pr($slug);
				
				
			$checkSlugData = $this->query("SELECT id,slug FROM english_brands as Brand WHERE title = '".$title ."' AND slug != 'NULL'");
			//pr(each($check_slug));
			$newdata = Set::extract('/Brand/.', $checkSlugData);
			$check_slug = array_column($newdata,'slug','id');
	
			if(count($check_slug) == 0){
				if(!empty($data['Brand']['id'])){
					if($this->exists($data['Brand']['id'])){
						if($this->langsName == 'English'){
							$data['Brand']['slug'] = $slug;
						}
					}else{
						$data['Brand']['slug'] = $slug;
					}
	
				}else{
					$data['Brand']['slug'] = $slug;
				}
	
			}else{
				if(!empty($data['Brand']['id'])){
					if($this->exists($data['Brand']['id'])){
						if($this->langsName == 'English'){
							if(!empty($data['Brand']['slug'])){
								if($data['Brand']['slug'] === $check_slug[$data['Brand']['id']]){
									$data['Brand']['slug'] = $data['Brand']['slug'];
								}else{
									natcasesort($check_slug);
									$newArr = array_reverse($check_slug);
									$new_val = reset($newArr);
									$new_val_arr = explode('~', $new_val);
									if(count($new_val_arr) >  1){
										$intVal = ((int) $new_val_arr[1] + 1);
										$data['Brand']['slug'] = $new_val_arr[0]."~{$intVal}";
									}else{
										$data['Brand']['slug'] = $slug."~1";
									}
								}
							}else{
								natcasesort($check_slug);
								$newArr = array_reverse($check_slug);
								$new_val = reset($newArr);
								$new_val_arr = explode('~', $new_val);
								if(count($new_val_arr) >  1){
									$intVal = ((int) $new_val_arr[1] + 1);
									$data['Brand']['slug'] = $new_val_arr[0]."~{$intVal}";
								}else{
									$data['Brand']['slug'] = $slug."~1";
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
							$data['Brand']['slug'] = $new_val_arr[0]."~{$intVal}";
						}else{
							$data['Brand']['slug'] = $slug."~1";
						}
					}
						
	
				}else{
					natcasesort($check_slug);
					$newArr = array_reverse($check_slug);
					$new_val = reset($newArr);
					$new_val_arr = explode('~', $new_val);
					if(count($new_val_arr) >  1){
						$intVal = ((int) $new_val_arr[1] + 1);
						$data['Brand']['slug'] = $new_val_arr[0]."~{$intVal}";
					}else{
						$data['Brand']['slug'] = $slug."~1";
					}
				}
	
			}
			//pr($data);die();
			$this->data = $data;
			return true;
		}
	
	}
	
}
