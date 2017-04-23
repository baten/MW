<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * Merchants Controller
 *
 * @property Merchant $Merchant
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MerchantsController extends EcommerceAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	
	public function beforeFilter(){
		parent::beforeFilter();
		if($this->langsName == 'English'){
			$this->Merchant->tablePrefix = 'english_';
		}
	
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Merchant->recursive = -1;
		if ($this->request->is('post')) {
			$searchText = addslashes($this->request->data['Merchant']['keywords']);
			$this->paginate = array(
				'conditions'=>array(
					'OR'=>array(
						"Merchant.fullName LIKE '%".$searchText."%'",
						"Merchant.phone LIKE '%".$searchText."%'",
						"Merchant.email LIKE '%".$searchText."%'",
						"Merchant.status LIKE '%".$searchText."%'",
					)
				),
				'order'=>array('created' => 'DESC')
			);
		}else{
			$this->paginate = array(
				'order'=>array('created' => 'DESC')
			);
		}
	
		$this->set('merchants', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Merchant->exists($id)) {
			throw new NotFoundException(__('Invalid merchant'));
		}
		$options = array('conditions' => array('Merchant.' . $this->Merchant->primaryKey => $id));
		$this->set('merchant', $this->Merchant->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	 
	
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Merchant->create();
			$data = $this->request->data;
			//pr($data);die();
				
			$datasource = $this->Merchant->getDataSource();
			try {
				$datasource->begin();
				if(!$this->Merchant->save($data)){
					throw new Exception();
				}
				$data['Merchant']['id'] = $this->Merchant->id;
				//image upload.
				if(isset($data['Merchant']['image']) && $data['Merchant']['image']['error'] == 0){
					$this->Uploader->upload($data['Merchant']['image'], $this->Merchant->id, 'png', 'merchants',$fileOrImage = null, $height = null, $width = '100', $oldfile = null );
				}
					
				//save data in oposite table
				if($this->langsName=='Bengali'){
					$this->Merchant->tablePrefix = 'english_';
				}else{
					$this->Merchant->tablePrefix = '';
				}
	
				if(!$this->Merchant->save($data)){
					throw new Exception();
				}
					
					
				$datasource->commit();
				$this->Session->setFlash('The merchant has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} catch(Exception $e) {
				$datasource->rollback();
				$this->Session->setFlash('The merchant could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
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
		if (!$this->Merchant->exists($id)) {
			throw new NotFoundException(__('Invalid merchant'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
			if(isset($data['Merchant']['image']) && $data['Merchant']['image']['error'] == 0){
				$this->Uploader->upload($data['Merchant']['image'], $id, 'png', 'merchants',$fileOrImage = null, $height = null, $width = '100', $oldfile = null );
			}
			
			if ($this->Merchant->save($this->request->data)) {
				$this->Session->setFlash('The merchant has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The merchant could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('Merchant.' . $this->Merchant->primaryKey => $id));
			$this->request->data = $this->Merchant->find('first', $options);
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
		$this->Merchant->id = $id;
		if (!$this->Merchant->exists()) {
			throw new NotFoundException(__('Invalid merchant'));
		}
		$this->request->allowMethod('post', 'delete');
		$datasource = $this->Merchant->getDataSource();
		try {
				$datasource->begin();
				if(!$this->Merchant->delete()){
					throw new Exception();
				}
				$img = WWW_ROOT."img".DS."site".DS."merchants".DS.$id.".png";
				if(file_exists($img)){
					$this->Uploader->deleteFile($img);
				}
				if($this->langsName=='Bengali'){
					$this->Merchant->tablePrefix = 'english_';
				}else{
					$this->Merchant->tablePrefix = '';
				}	
				$this->Merchant->id = $id;
				if(!$this->Merchant->delete()){
					throw new Exception();
				}
				$datasource->commit();
				$this->Session->setFlash('The merchant has been deleted.','default',array('class'=>'alert alert-success'));
			} catch(Exception $e) {
				$datasource->rollback();
				$this->Session->setFlash('The merchant could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		return $this->redirect(array('action' => 'index'));
	}
	
	 
}
