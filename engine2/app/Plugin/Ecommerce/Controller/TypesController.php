<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * Types Controller
 *
 * @property Type $Type
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TypesController extends EcommerceAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	public $helper = array('UyTree');

/**
 * admin_index method
 *
 * @return void
 */
	
	private function getProductCategories(){
		$data = ClassRegistry::init('Ecommerce.Category')->find('list');
		return $data;
	}
	
	public function admin_index() {
		$this->Type->recursive = 0;
		if ($this->request->is('post')) {
		
			$this->paginate = array(
					'conditions'=>array(
							'OR'=>array(
									"Type.title LIKE '%".$this->request->data['Type']['keywords']."%'"
							)
					)
			);
		}
		$this->set('types', $this->Paginator->paginate());
	}
	
	public function admin_ajax_index() {
		$this->layout = false;
		$this->Type->recursive = 0;
		$this->set('types', $this->Paginator->paginate());
	}
	

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Type->exists($id)) {
			throw new NotFoundException(__('Invalid type'));
		}
		$options = array('conditions' => array('Type.' . $this->Type->primaryKey => $id));
		$this->set('type', $this->Type->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			
			//remove uncheck categories			
			foreach($data['Type']['ProductCategory'] as $category_ind => $category_val){
				if($category_val['category_id'] == 0){
					unset($data['Type']['TypeCategory'][$category_ind]);
				}
			}
			
			//debug($data); die();
			$this->Type->create();
			if ($this->Type>saveAssociated($data,array('deep' => true))) {
				$this->Session->setFlash('The type has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The type could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		}
		$this->set('catNode',$this->getCategotriesWithNode());
		$this->set('productCategories', $this->getProductCategories());
		$this->set('category_has_types',$this->getCategoryHasType());
		$this->set('existingTypes',$this->Type->find('list'));
		
		
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Type->exists($id)) {
			throw new NotFoundException(__('Invalid type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
			
			if ($this->Type->save($data)) {
				$this->Session->setFlash('The type has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The type could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('recursive'=>2, 'conditions' => array('Type.' . $this->Type->primaryKey => $id));
			$this->request->data = $this->Type->find('first', $options);
		}
	
		$this->set('currentCategories',$this->currnentCategoriesByTypeId($id));
		$this->set('catNode',$this->getCategotriesWithNode());
		$this->set('productCategories', $this->getProductCategories());
		$this->set('category_has_types',$this->getCategoryHasType());
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Type->id = $id;
		if (!$this->Type->exists()) {
			throw new NotFoundException(__('Invalid type'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Type->deleteAll(array('Type.id'=>$id,true))) {
			$this->Session->setFlash('The type has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The type could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function admin_ajax_add() {
		$this->layout = false;
		$this->autoRender = false;
		
		if($this->request->is('post')){
			$data =  $this->request->data;
			$this->Type->create();
			if($this->Type->saveAssociated($data,array('deep' => true))){
				
				$this->Session->setFlash('This configuration is saved.','default',array('class'=>'alert alert-success'));
				return 'success';
			}else{
				$this->Session->setFlash('This configuration can not saved. Please try again.','default',array('class'=>'alert alert-success'));
				return 'error';
			}
		}
	}
	
	public function admin_ajax_edit() {
		$this->layout = false;
		$this->autoRender = false;
	
		if($this->request->is('post')){
			//post
			$data =  $this->request->data;
			
			 
			$p_attr = array();
			$p_attr_values =  array();
			foreach($data['Type']['Attribute'] as $p_attr_key => $p_attr_v){
				if(isset($p_attr_v['id'])){
					$p_attr[] = $p_attr_v['id'];
				}
				
				foreach($p_attr_v['AttributeValue'] as $i=>$j){
					if(isset($j['id'])){
						$p_attr_values[] = $j['id'];
					}
					
				}
			}
			
			//get current data
			$cur_data = $this->Type->find('first',array(
				 'contain'=>array(
			 			'Attribute'=>array(
		 					'AttributeValue' => array('fields' => array('id'))
	 					)
		 			),
					'conditions' => array('id' =>$data['Type']['id'] )
						
				)
			);
			
		
			//current attr and value
			$c_attr = array();
			$c_attr_values =  array();
			foreach($cur_data['Attribute'] as $c_attr_key => $c_attr_name){
				$c_attr[] = $c_attr_name['id'];
				foreach($c_attr_name['AttributeValue'] as $i=>$j){
					$c_attr_values[] = $j['id'];
				}
			}
			//current type_category
			
			//$deleteableTypeCategory = array();
			
			$deleteAbleAttributes = array_diff($c_attr, $p_attr);
			$deleteAbleAttributeValues = array_diff($c_attr_values, $p_attr_values);
			
			// start delete product_attribute by delelteableAttributes
			
			if(!empty($deleteAbleAttributes)){
				
				$deleteAbleProductAttrValues = array();
				$productAttributeClass = ClassRegistry::init('Ecommerce.ProductAttribute');
				foreach ($deleteAbleAttributes AS $delAbleAttr){
					$productAttrbuteId = $productAttributeClass->find('first',array('recursive'=>-1,'fields'=>array('id'),'conditions'=>array('attribute_id'=>$delAbleAttr)));
					$productAttributeClass->query("DELETE FROM product_attributes WHERE attribute_id = '{$delAbleAttr}'");
					array_push($deleteAbleProductAttrValues, $productAttrbuteId['ProductAttribute']['id']);
					
				}
				// delete productAttributeValues.
				if(!empty($deleteAbleProductAttrValues)){
					$productAttributeValueClass = ClassRegistry::init('Ecommerce.ProductAttributeValue');
					foreach ($deleteAbleProductAttrValues AS $deleteAbleProductAttrValue){
						$productAttributeValueClass->query("DELETE FROM product_attribute_values WHERE product_attribute_id = '{$deleteAbleProductAttrValue}'");
					}
				}
				
			}
			// end delete product_attribute 
			
			//delete attributes
			$attributeClass = ClassRegistry::init('Attribute');
			foreach($deleteAbleAttributes as $key => $value){
				$attributeClass->query("DELETE FROM attributes WHERE id = '{$value}'");
			}
			
			//delete attribute values
			$attributeValueClass = ClassRegistry::init('AttributeValue');
			foreach($deleteAbleAttributeValues as $key => $value){
				$attributeValueClass->query("DELETE FROM attribute_values WHERE id = '{$value}'");
			}
			
			//delete all categories
			$typeCategory = ClassRegistry::init('Ecommerce.TypeCategory')->deleteAll(array('TypeCategory.type_id' => $data['Type']['id']));
			
			if($this->Type->saveAssociated($data,array('deep' => true))){
				$this->Session->setFlash('This configuration is saved.','default',array('class'=>'alert alert-success'));
				return 'success';
			}else{
				$this->Session->setFlash('This configuration can not saved. Please try again.','default',array('class'=>'alert alert-success'));
				return 'error';
			}
		}
	}
	
	
	private function getCategoryHasType(){
		$data = $this->Type->TypeCategory->find(
			'list',
			array(
				'fields' => array('id', 'TypeCategory.category_id'),
				'group' => array('category_id')
			)		
		);
		return array_flip($data);
	}
	
	private function getCategotriesWithNode(){
		$data =ClassRegistry::init('Ecommerce.Category')->find(
				'threaded',
				array(
						'contain' => array(),
						'fields' => array('id','parent_id', 'title'),
						
				)
		);
		
		return $data;
	}
	
	private function currnentCategoriesByTypeId($id){
		$data =  $this->Type->TypeCategory->find(
			'list',
			array(
				'fields' => array('category_id','type_id'),
				'conditions' => array('type_id' => $id)
			)	
		);
		
		return  $data;
	}
	
	// ajax post
	
	public function admin_ajax_getTypeAttr(){
		$this->autoRender = false;
		$type_id = $_REQUEST['typeId'];
		
		$type_attr = $this->Type->Attribute->getAttributeByTypeId($type_id);
		//pr($type_attr);
	
		return json_encode($type_attr);
	}
	
	
}
