<?php
App::uses('EcommerceAppModel', 'Ecommerce.Model');
/**
 * CategoryImage Model
 *
 */
class CategoryImage extends EcommerceAppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'ecommerce';
	
	
	public function getCategoryImageById($id){
		return $data = $this->find(
			'first',
			array(
				'fields' => array('id','image_extension','thumb_extension'),
				'recursive' =>-1,
				'conditions' => array('category_id' => $id )
			)
		);
			
	}

}
