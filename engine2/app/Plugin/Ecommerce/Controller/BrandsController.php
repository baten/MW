<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * Brands Controller
 *
 * @property Brand $Brand
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class BrandsController extends EcommerceAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','Uploader');
	
	public $uses = array('Ecommerce.Brand','Ecommerce.ProductBrand');
	
	public function beforeFilter(){
		parent::beforeFilter();
		if($this->langsName == 'English'){
			$this->Brand->tablePrefix = 'english_';
			$this->Brand->langsName = 'English';
		}else{
			$this->Brand->langsName = 'Bengali';
		}
		
	}
	

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Brand->recursive = 0;
		if ($this->request->is('post')) {
			$this->paginate = array(
				'conditions'=>array(
					'OR'=>array(
						"Brand.title LIKE '%".$this->request->data['Brand']['keywords']."%'",
						"Brand.description LIKE '%".$this->request->data['Brand']['keywords']."%'",
					)
				)
			);
		}else{
			$this->paginate = array('order'=>array('order'=>'ASC'));
		}
		$this->set('brands', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Brand->exists($id)) {
			throw new NotFoundException(__('Invalid brand'));
		}
		$options = array('conditions' => array('Brand.' . $this->Brand->primaryKey => $id));
		$this->set('brand', $this->Brand->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		//echo 
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->Brand->create();
			if(isset($data['Brand']['image']) && $data['Brand']['image']['error'] == 0){
				$data['Brand']['image_extension'] = $this->Uploader->getFileExtension($data['Brand']['image']);
				$image = $data['Brand']['image'];
			}
			if(isset($data['Brand']['logo']) && $data['Brand']['logo']['error'] == 0){
				$data['Brand']['logo_extension'] = $this->Uploader->getFileExtension($data['Brand']['logo']);
				$logo = $data['Brand']['logo'];
			}
			
			unset($data['Brand']['image'],$data['Brand']['logo']);
			
			$datasource = $this->Brand->getDataSource();
			try {
				$datasource->begin();
				if(!$this->Brand->save($data)){
					throw new Exception();
				}
				$image_id = $this->Brand->id;
				$data['Brand']['id'] = $image_id;
				//image upload
				if(isset($image) && $image['error'] == 0){
					$this->Uploader->upload($image, $image_id, $data['Brand']['image_extension'], 'product_brands',$fileOrImage = null, $height = '', $width = '', $oldfile = null );
				}
				//logo upload
				if(isset($logo) && $logo['error'] == 0){
					$this->Uploader->upload($logo, 'l-' . $image_id, $data['Brand']['logo_extension'], 'product_brands',$fileOrImage = null, $height = '', $width = '', $oldfile = null );
				}
					
				//save data in oposite table
				if($this->langsName=='Bengali'){
					$this->Brand->tablePrefix = 'english_';
				}else{
					$this->Brand->tablePrefix = '';
				}
			
				if(!$this->Brand->save($data)){
					throw new Exception();
				}
					
					
				$datasource->commit();
				$this->Session->setFlash('The brand has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} catch(Exception $e) {
				$datasource->rollback();
				$this->Session->setFlash('The brand could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
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
		if (!$this->Brand->exists($id)) {
			throw new NotFoundException(__('Invalid brand'));
		}
		if ($this->request->is(array('post', 'put'))) {
			
			$data = $this->request->data;
			
			
			if(isset($data['Brand']['image']) && $data['Brand']['image']['error'] == 0){
				$data['Brand']['image_extension'] = $this->Uploader->getFileExtension($data['Brand']['image']);
				$this->Uploader->upload($data['Brand']['image'], $id, $data['Brand']['image_extension'], 'product_brands',$fileOrImage = null, $height = '', $width = '', $oldfile = null );
				$updateableDataForOpposite['Brand']['image_extension'] = $data['Brand']['image_extension'];
			}
			//logo upload
			if(isset($data['Brand']['logo']) && $data['Brand']['logo']['error'] == 0){
				$data['Brand']['logo_extension'] = $this->Uploader->getFileExtension($data['Brand']['logo']);
				$this->Uploader->upload($data['Brand']['logo'], 'l-' . $id, $data['Brand']['logo_extension'], 'product_brands',$fileOrImage = null, $height = '', $width = '', $oldfile = null );
				$updateableDataForOpposite['Brand']['logo_extension'] = $data['Brand']['logo_extension'];
			}
			
			if(!empty($data['Brand']['is_featured'])){
				$updateableDataForOpposite['Brand']['is_featured'] = $data['Brand']['is_featured'];
			}else{
				$updateableDataForOpposite['Brand']['is_featured'] = 0;
			}
			 
			if ($this->Brand->save($data)) {
				$slugData = $this->Brand->findById($id,array('Brand.slug'));
				if($this->langsName =='Bengali'){
					$this->Brand->tablePrefix = 'english_';
				}else{
					$this->Brand->tablePrefix = '';
					$updateableDataForOpposite['Brand']['slug'] = $slugData['Brand']['slug'];
				}
				$this->Brand->updateData('Brand', $updateableDataForOpposite, $id, $this->Brand->tablePrefix);
				$this->Session->setFlash('The brand has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The brand could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		} else {
			$options = array('conditions' => array('Brand.' . $this->Brand->primaryKey => $id));
			$this->request->data = $this->Brand->find('first', $options);
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
		$this->Brand->id = $id;
		if (!$this->Brand->exists()) {
			throw new NotFoundException(__('Invalid brand'));
		}
		
		$this->request->allowMethod('post', 'delete');
		$brandData =$this->Brand->find('first',array('fields' => array('id','image_extension','logo_extension'),'conditions' => array('id' => $id)));
		$this->request->allowMethod('post', 'delete');
		$datasource = $this->Brand->getDataSource();
		try {
			$datasource->begin();
			if(!$this->Brand->delete()){
				throw new Exception();
			}
			//image delete
			$img_file = WWW_ROOT."img".DS."site".DS."product_brands".DS.$id.".".$brandData['Brand']['image_extension'];
			if(file_exists($img_file)){
				$this->Uploader->deleteFile($img_file);
			}
			// delete logo
			$logo_file = WWW_ROOT."img".DS."site".DS."product_brands".DS.'l-'.$id.".".$brandData['Brand']['logo_extension'];
			if(file_exists($logo_file)){
				$this->Uploader->deleteFile($logo_file);
			}
			if($this->langsName=='Bengali'){
				$this->Brand->tablePrefix = 'english_';
			}else{
				$this->Brand->tablePrefix = '';
			}
			$this->Brand->id = $id;
			if(!$this->Brand->delete()){
				throw new Exception();
			}
			$datasource->commit();
			$this->Session->setFlash('The brand has been deleted.','default',array('class'=>'alert alert-success'));
		} catch(Exception $e) {
			$datasource->rollback();
			$this->Session->setFlash('The brand could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
	 
		return $this->redirect(array('action' => 'index'));
	}
	
	public function admin_sort() {
		$this->Brand->recursive = 0;
		
		
		if ($this->request->is('post')) {
			$data = $this->request->data;
			if(isset($data['BtnOrder'])){
				$i = 1;
				foreach ($data['Brand']['id'] AS $datum){
					$this->Brand->id = $datum;
					$this->Brand->saveField('order', $i);
					$i++;
				}
				return $this->redirect('index');
			}else{
					$this->paginate = array(
					'conditions'=>array(
						'OR'=>array(
							"Brand.title LIKE '%".$this->request->data['Brand']['keywords']."%'",
							"Brand.description LIKE '%".$this->request->data['Brand']['keywords']."%'",
						)
					)
				);
					
			}
		}else{
			$this->paginate = array('order'=>array('order'=>'ASC'));
		}
	
		$this->set('brands', $this->Paginator->paginate());
	}
}
