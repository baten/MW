<?php
App::uses('EcommerceAppModel', 'Ecommerce.Model');
/**
 * Product Model
 *
 * @property ProductAttribute $ProductAttribute
 */
class Product extends EcommerceAppModel {

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
	
	public $actsAs = array('Containable');

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
		 
	 	
		'price' => array(
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
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ProductAttribute' => array(
			'className' => 'Ecommerce.ProductAttribute',
			'foreignKey' => 'product_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Wishlist' => array(
			'className' => 'Ecommerce.Wishlist',
			'foreignKey' => 'product_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ProductBrand' => array(
			'className' => 'Ecommerce.ProductBrand',
			'foreignKey' => 'product_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ProductSport' => array(
			'className' => 'Ecommerce.ProductSport',
			'foreignKey' => 'product_id',
			'dependent' => true,
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
				'foreignKey' => 'product_id',
				'dependent' => true,
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
		),
		'ProductImage' => array(
				'className' => 'Ecommerce.ProductImage',
				'foreignKey' => 'product_id',
				'dependent' => true,
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
		),
		'RelatedProduct' => array(
			'className' => 'Ecommerce.RelatedProduct',
			'foreignKey' => 'product_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
          'Purchase' => array(
            'className' => 'Ecommerce.Purchase',
            'foreignKey' => 'product_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
	);
	
	 
	
	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'Merchant' => array(
			'className' => 'Ecommerce.Merchant',
			'foreignKey' => 'merchant_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Team' => array(
			'className' => 'Ecommerce.Team',
			'foreignKey' => 'team_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function getProductById($id){
		$this->recursive = -1;
		return $data = $this->find(
			'first',
			array(
				'fields' => array('title'),
				'conditions'=>array('id' => $id)
			)
		);
	}
	
	public function generateSlug($title,$tableName=null,$id = null){
		$title=addslashes($title);
		$slug = Inflector::slug(strtolower($title),'-');
		if($tableName=='English'){
			$checkSlugData = $this->query("SELECT `id`,`slug` FROM `english_products` as `Product` WHERE title = '$title'");
		}else{
			$checkSlugData = $this->query("SELECT `id`,`slug` FROM `products` as `Product` WHERE title = '$title'");
		}

	
		if(count($checkSlugData) > 0){
			$newdata = Set::extract('/Product/.', $checkSlugData);
			$check_slug = array_column($newdata,'slug','id');
			//pr($check_slug);die();	
			natcasesort($check_slug);
			//pr($check_slug); die();
			$newArr = array_reverse($check_slug);
			//pr($newArr); die();
			$new_val = reset($newArr);			
			$new_val_arr = explode('~', $new_val);
			//pr($new_val_arr); 
			if(count($new_val_arr) >  1){
				$intVal = ((int) $new_val_arr[1] + 1);
				//pr($new_val_arr[0]."~{$intVal}");
				return  $new_val_arr[0]."~{$intVal}";
			}else{
				return $slug."~1";
			}			
		}else{
			return $slug;
		}
	}	 

}