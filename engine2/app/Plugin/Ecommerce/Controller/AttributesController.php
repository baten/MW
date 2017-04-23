<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * Attributes Controller
 *
 * @property Attribute $Attribute
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AttributesController extends EcommerceAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	
	
	public function beforeFilter(){
		parent::beforeFilter();
		if($this->langsName == 'English'){
			$this->Attribute->tablePrefix = 'english_';
			$this->Attribute->AttributeValue->tablePrefix = 'english_';
			$this->Attribute->langsName = 'English';
		}else{
			$this->Attribute->langsName = 'Bengali';
		}
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Attribute->recursive = 0;
			if ($this->request->is('post')) {
		
			$this->paginate = array(
				'conditions'=>array(
					"Attribute.title LIKE '%".addslashes($this->request->data['Attribute']['keywords'])."%'",
				),
				'order'=>array('order'=>'ASC')
			);
		}else{
			$this->paginate = array( 'order'=>array('order'=>'ASC'));
		} 
		$this->set('attributes', $this->Paginator->paginate());
	}
	
	
	public function admin_sort_attribute() {
		 
		if ($this->request->is('post')) {
				
			$data = $this->request->data;
			//pr($data);die();
			$i = 1;
			$orderData = array();
			foreach ($data['order'] AS $datum){
				$orderData[$i]['Attribute']['id'] = $datum;
				$orderData[$i]['Attribute']['order'] = $i;
				$i++;
		
			}
				
			$datasource = $this->Attribute->getDataSource();
			try {
				$datasource->begin();
				if(!$this->Attribute->saveMany($orderData)){
					throw new Exception();
				}
		
				//save data in oposite table
				if($this->langsName=='Bengali'){
					$this->Attribute->tablePrefix = 'english_';
				}else{
					$this->Attribute->tablePrefix = '';
				}
					
				if(!$this->Attribute->saveMany($orderData)){
					throw new Exception();
				}
					
					
				$datasource->commit();
				$this->Session->setFlash('These attribute has been sorted.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} catch(Exception $e) {
				$datasource->rollback();
				$this->Session->setFlash('These attribute could not be sorted. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		}
		 
		 
		$this->set('attributes', $this->Attribute->find('list',array('order'=>array('order'=>'ASC'))));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Attribute->exists($id)) {
			throw new NotFoundException(__('Invalid attribute'));
		}
		$options = array('conditions' => array('Attribute.' . $this->Attribute->primaryKey => $id));
		$this->set('attribute', $this->Attribute->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Attribute->create();
			if ($this->Attribute->save($this->request->data)) {
				$this->Session->setFlash('The attribute has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The attribute could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Attribute->exists($id)) {
			throw new NotFoundException(__('Invalid attribute'));
		}
		if ($this->request->is(array('post', 'put'))) {
			pr($this->request->data);die();
			if ($this->Attribute->save($this->request->data)) {
				$this->Session->setFlash('The attribute has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The attribute could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		} else {
			$options = array('conditions' => array('Attribute.' . $this->Attribute->primaryKey => $id));
			$this->request->data = $this->Attribute->find('first', $options);
		}
		 
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Attribute->id = $id;
		if (!$this->Attribute->exists()) {
			throw new NotFoundException(__('Invalid attribute'));
		}
		$this->request->allowMethod('post', 'delete');
		$datasource = $this->Attribute->getDataSource();
		try {
			$datasource->begin();
			if(!$this->Attribute->delete()){
				throw new Exception();
			}
				
			if($this->langsName=='Bengali'){
				$this->Attribute->tablePrefix = 'english_';
				$this->Attribute->AttributeValue->tablePrefix = 'english_';
			}else{
				$this->Attribute->tablePrefix = '';
				$this->Attribute->AttributeValue->tablePrefix = '';
			}
			
			$this->Attribute->id = $id;
			if(!$this->Attribute->delete()){
				throw new Exception();
			}
			 
			$datasource->commit();
			$this->Session->setFlash('The attribute has been deleted.','default',array('class'=>'alert alert-success'));
		} catch(Exception $e) {
			$datasource->rollback();
			$this->Session->setFlash('The attribute could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	
	public function admin_ajax_add() {
		$this->layout = false;
		$this->autoRender = false;
	
		if($this->request->is('post')){
			$data =  $this->request->data;
			$processData['Attribute']['title'] = $data['Attribute'][0]['title'];
			$processData['AttributeValue'] = $data['Attribute'][0]['AttributeValue'];
			$this->Attribute->create();
			$datasource = $this->Attribute->getDataSource();
			try {
				$datasource->begin();
				if(!$this->Attribute->saveAssociated($processData)){
					throw new Exception();
				}
				$attribute_id = $this->Attribute->id;
				$data['Attribute']['id'] = $attribute_id;
				
				//save data in oposite table
				if($this->langsName=='Bengali'){
					$this->Attribute->tablePrefix = 'english_';
					$this->Attribute->AttributeValue->tablePrefix = 'english_';
				}else{
					$this->Attribute->tablePrefix = '';
					$this->Attribute->AttributeValue->tablePrefix = '';
				}
				
				if(!$this->Attribute->saveAssociated($processData)){
					throw new Exception();
				}
				$datasource->commit();
				$this->Session->setFlash('This Attribute is saved.','default',array('class'=>'alert alert-success'));
				return 'success';
				
			}catch(Exception $e) {
            	$datasource->rollback();
            	$this->Session->setFlash('This Attribute can not saved. Please try again.','default',array('class'=>'alert alert-success'));
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
			$data['Attribute']['id'] = $data['Attribute'][0]['id'];
			$data['Attribute']['title'] = $data['Attribute'][0]['title'];
			$data['AttributeValue'] = $data['Attribute'][0]['AttributeValue'];
			$p_attr_values =  array();
			$p_attr_values_op = array();
			foreach($data['AttributeValue'] as $i=>$j){
				 
				if(isset($j['id'])){
					$p_attr_values[] = $j['id'];
				}else{
					$j['attribute_id'] = $data['Attribute']['id'];
					$p_attr_values_op[] = $j;
					
				}
					
			}
			 
			//get current data
			$cur_data = $this->Attribute->AttributeValue->find('all',array(
				'recursive'=>-1,
				'conditions' => array('attribute_id' =>$data['Attribute'][0]['id'])
	
				)
			); 
			$c_attr_values =  array();
			foreach($cur_data as $i=>$j){
				$c_attr_values[] = $j['AttributeValue']['id'];
			}
			$deleteAbleAttributeValues = array_diff($c_attr_values, $p_attr_values);
			
			 
			$datasource = $this->Attribute->getDataSource();
			try {
				$datasource->begin();
				
				if(!empty($deleteAbleAttributeValues)){
					$productAttributeValueClass = ClassRegistry::init('Ecommerce.ProductAttributeValue');
					foreach ($deleteAbleAttributeValues AS $deleteAbleAttributeValue){
						$productAttributeValueClass->query("DELETE FROM product_attribute_values WHERE attribute_value_id = '{$deleteAbleAttributeValue}'");
						$this->Attribute->AttributeValue->query("DELETE FROM attribute_values WHERE id = '{$deleteAbleAttributeValue}'");
						$this->Attribute->AttributeValue->query("DELETE FROM english_attribute_values WHERE id = '{$deleteAbleAttributeValue}'");
					}
				}
				
				if(!$this->Attribute->saveAssociated($data)){
					throw new Exception();
				}
				
				  
				//save data in oposite table
				if($this->langsName=='Bengali'){
					$this->Attribute->AttributeValue->tablePrefix = 'english_';
				}else{
					$this->Attribute->AttributeValue->tablePrefix = '';
				}
				$this->Attribute->AttributeValue->saveAll($p_attr_values_op);
				$datasource->commit();
				$this->Session->setFlash('This configuration is saved.','default',array('class'=>'alert alert-success'));
				return 'success';
			} catch(Exception $e) {
            	$datasource->rollback();
            	$this->Session->setFlash('This configuration can not saved. Please try again.','default',array('class'=>'alert alert-success'));
				return 'error';
            }
           
		}
	}
	
	 public function admin_ajax_setAttrUseForStck(){
		$this->layout = false;
		$this->autoRender = false;
		
		if($this->request->is('post')){
			$postRequest = $this->request->data;
			if($postRequest['checkedValue'] === 'true'){
				$count = $this->Attribute->find('count',array('conditions'=>array('useCombination' => 1)));
				if($count == 3){
					return false;
				}	
			} 
			$this->Attribute->id = $postRequest['attrId'];
			$data['Attribute']['useCombination'] = 0;
			if($postRequest['checkedValue'] === 'true'){
				$data['Attribute']['useCombination'] = 1;
			} 
			
			if($this->Attribute->save($data)){
				//save data in oposite table
				if($this->langsName=='Bengali'){
					$this->Attribute->tablePrefix = 'english_';
					$this->Attribute->AttributeValue->tablePrefix = 'english_';
				}else{
					$this->Attribute->tablePrefix = '';
					$this->Attribute->AttributeValue->tablePrefix = '';
				}
				if($this->Attribute->save($data)){
					return true;
				}
				
			}
			
			return false;
		}
	}
	 
	 
	
}
