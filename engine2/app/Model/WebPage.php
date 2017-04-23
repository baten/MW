<?php
App::uses('AppModel', 'Model');
/**
 * WebPage Model
 *
 */
class WebPage extends AppModel {

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
			)/*,
	        'uniqueTitleRule' => array(
	            'rule' => 'isUnique',
	            'message' => 'This title is already axists'
	        )*/
		),
		
		'meta_keys' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Pleas input meta key words',
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'meta_description' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Pleas input meta description.',
				//'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'description' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Please input a details.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
			'numeric' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'WebPageDetail' => array(
			'className' => 'WebPageDetail',
			'foreignKey' => 'web_page_id',
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
		//pr($data);die();
		if(!empty($data['WebPage']['title'])){
			$title = $data['WebPage']['title'];
			$slug = $this->slugify(strtolower($title),'-');
			//pr($slug);die();
			//pr($slug);
			$checkSlugData = $this->query("SELECT id,slug FROM english_web_pages as WebPage WHERE title = '".addslashes($title) ."' AND slug != 'NULL'");
			//pr(each($check_slug));
			$newdata = Set::extract('/WebPage/.', $checkSlugData);
			$check_slug = array_column($newdata,'slug','id');
			
			if(count($check_slug) == 0){
				if(!empty($data['WebPage']['id'])){
					if($this->exists($data['WebPage']['id'])){
						if($this->langsName == 'English'){
							$data['WebPage']['slug'] = $slug;
						}
					}else{
						$data['WebPage']['slug'] = $slug;
					}
					
				}else{
					$data['WebPage']['slug'] = $slug;
				}
				
			}else{
				if(!empty($data['WebPage']['id'])){
					if($this->exists($data['WebPage']['id'])){
						if($this->langsName == 'English'){
							if(!empty($data['WebPage']['slug'])){
								if($data['WebPage']['slug'] === $check_slug[$data['WebPage']['id']]){
									$data['WebPage']['slug'] = $data['WebPage']['slug'];
								}else{
									natcasesort($check_slug);
									$newArr = array_reverse($check_slug);
									$new_val = reset($newArr);
									$new_val_arr = explode('~', $new_val);
									if(count($new_val_arr) >  1){
										$intVal = ((int) $new_val_arr[1] + 1);
										$data['WebPage']['slug'] = $new_val_arr[0]."~{$intVal}";
									}else{
										$data['WebPage']['slug'] = $slug."~1";
									}
								}
							}else{
								natcasesort($check_slug);
								$newArr = array_reverse($check_slug);
								$new_val = reset($newArr);
								$new_val_arr = explode('~', $new_val);
								if(count($new_val_arr) >  1){
									$intVal = ((int) $new_val_arr[1] + 1);
									$data['WebPage']['slug'] = $new_val_arr[0]."~{$intVal}";
								}else{
									$data['WebPage']['slug'] = $slug."~1";
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
							$data['WebPage']['slug'] = $new_val_arr[0]."~{$intVal}";
						}else{
							$data['WebPage']['slug'] = $slug."~1";
						}
					}
					
				}else{
					natcasesort($check_slug);
					$newArr = array_reverse($check_slug);
					$new_val = reset($newArr);
					$new_val_arr = explode('~', $new_val);
					if(count($new_val_arr) >  1){
						$intVal = ((int) $new_val_arr[1] + 1);
						$data['WebPage']['slug'] = $new_val_arr[0]."~{$intVal}";
					}else{
						$data['WebPage']['slug'] = $slug."~1";
					}
				}
			}
			
		}
		$this->data = $data;
		//return true;
	
	}
}

