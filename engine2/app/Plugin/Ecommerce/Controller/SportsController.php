<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * Sports Controller
 *
 * @property Sport $Sport
 * @property PaginatorComponent $Paginator
 */
class SportsController extends EcommerceAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','Uploader');
	
	public function beforeFilter(){
		parent::beforeFilter();
		if($this->langsName == 'English'){
			$this->Sport->tablePrefix = 'english_';
			$this->Sport->langsName = 'English';
		}else{
			$this->Sport->langsName = 'Bengali';
		}
	
	}
	

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Sport->recursive = 0;
		if ($this->request->is('post')) {
			$searchText = addslashes($this->request->data['Sport']['keywords']);
			$this->paginate = array(
				'conditions'=>array(
					'OR'=>array(
						"Sport.title LIKE '%".$searchText."%'",
						"Sport.description LIKE '%".$searchText."%'",
					)
				)
			);
		}else{
			$this->paginate = array('order'=>array('order'=>'ASC'));
		}
		$this->set('sports', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Sport->exists($id)) {
			throw new NotFoundException(__('Invalid sport'));
		}
		$options = array('conditions' => array('Sport.' . $this->Sport->primaryKey => $id));
		$this->set('sport', $this->Sport->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
	if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->Sport->create();
			if(isset($data['Sport']['image']) && $data['Sport']['image']['error'] == 0){
				$data['Sport']['image_extension'] = $this->Uploader->getFileExtension($data['Sport']['image']);
				$image = $data['Sport']['image'];
			}
			if(isset($data['Sport']['logo']) && $data['Sport']['logo']['error'] == 0){
				$data['Sport']['logo_extension'] = $this->Uploader->getFileExtension($data['Sport']['logo']);
				$logo = $data['Sport']['logo'];
			}
			
			unset($data['Sport']['image'],$data['Sport']['logo']);
			
			$datasource = $this->Sport->getDataSource();
			try {
				$datasource->begin();
				if(!$this->Sport->save($data)){
					throw new Exception();
				}
				$image_id = $this->Sport->id;
				$data['Sport']['id'] = $image_id;
				//image upload
				if(isset($image) && $image['error'] == 0){
					$this->Uploader->upload($image, $image_id, $data['Sport']['image_extension'], 'sports',$fileOrImage = null, $height = '', $width = '', $oldfile = null );
				}
				//logo upload
				if(isset($logo) && $logo['error'] == 0){
					$this->Uploader->upload($logo, 'l-' . $image_id, $data['Sport']['logo_extension'], 'sports',$fileOrImage = null, $height = '', $width = '', $oldfile = null );
				}
					
				//save data in oposite table
				if($this->langsName=='Bengali'){
					$this->Sport->tablePrefix = 'english_';
				}else{
					$this->Sport->tablePrefix = '';
				}
			
				if(!$this->Sport->save($data)){
					throw new Exception();
				}
					
					
				$datasource->commit();
				$this->Session->setFlash('The sport has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} catch(Exception $e) {
				$datasource->rollback();
				$this->Session->setFlash('The sport could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
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
	if (!$this->Sport->exists($id)) {
			throw new NotFoundException(__('Invalid brand'));
		}
		if ($this->request->is(array('post', 'put'))) {
			
			$data = $this->request->data;
			
			
			if(isset($data['Sport']['image']) && $data['Sport']['image']['error'] == 0){
				$data['Sport']['image_extension'] = $this->Uploader->getFileExtension($data['Sport']['image']);
				$this->Uploader->upload($data['Sport']['image'], $id, $data['Sport']['image_extension'], 'sports',$fileOrImage = null, $height = '80', $width = '', $oldfile = null );
			}
			//logo upload
			if(isset($data['Sport']['logo']) && $data['Sport']['logo']['error'] == 0){
				$data['Sport']['logo_extension'] = $this->Uploader->getFileExtension($data['Sport']['logo']);
				$this->Uploader->upload($data['Sport']['logo'], 'l-' . $id, $data['Sport']['logo_extension'], 'sports',$fileOrImage = null, $height = '', $width = '', $oldfile = null );
			}
			
			if(!empty($data['Sport']['is_featured'])){
				$updateableDataForOpposite['Sport']['is_featured'] = $data['Sport']['is_featured'];
			}else{
				$updateableDataForOpposite['Sport']['is_featured'] = 0;
			}
			 
			if ($this->Sport->save($data)) {
				$slugData = $this->Sport->findById($id,array('Sport.slug'));
				if($this->langsName =='Bengali'){
					$this->Sport->tablePrefix = 'english_';
				}else{
					$this->Sport->tablePrefix = '';
					$updateableDataForOpposite['Sport']['slug'] = $slugData['Sport']['slug'];
				}
				$this->Sport->updateData('Sport', $updateableDataForOpposite, $id, $this->Sport->tablePrefix);
				$this->Session->setFlash('The sport has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The sport could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		} else {
			$options = array('conditions' => array('Sport.' . $this->Sport->primaryKey => $id));
			$this->request->data = $this->Sport->find('first', $options);
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
		$this->Sport->id = $id;
		if (!$this->Sport->exists()) {
			throw new NotFoundException(__('Invalid brand'));
		}
		$data = $this->Sport->findById($id);
		
		$this->request->allowMethod('post', 'delete');
		$this->request->allowMethod('post', 'delete');
		$datasource = $this->Sport->getDataSource();
		try {
			$datasource->begin();
			if(!$this->Sport->delete()){
				throw new Exception();
			}
			//image delete
			$img_file = WWW_ROOT."img".DS."site".DS."sports".DS.$id.".".$data['Sport']['image_extension'];
			if(file_exists($img_file)){
				$this->Uploader->deleteFile($img_file);
			}
			// delete logo
			$logo_file = WWW_ROOT."img".DS."site".DS."sports".DS.'l-'.$id.".".$data['Sport']['logo_extension'];
			if(file_exists($logo_file)){
				$this->Uploader->deleteFile($logo_file);
			}
			if($this->langsName=='Bengali'){
				$this->Sport->tablePrefix = 'english_';
			}else{
				$this->Sport->tablePrefix = '';
			}
			$this->Sport->id = $id;
			if(!$this->Sport->delete()){
				throw new Exception();
			}
			$datasource->commit();
			$this->Session->setFlash('The sport has been deleted.','default',array('class'=>'alert alert-success'));
		} catch(Exception $e) {
			$datasource->rollback();
			$this->Session->setFlash('The sport could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
	 
		return $this->redirect(array('action' => 'index'));
	}
}
