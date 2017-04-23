<?php
App::uses('TimeoutAppController', 'Timeout.Controller');
/**
 * Galleries Controller
 *
 * @property Gallery $Gallery
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class GalleriesController extends TimeoutAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','Uploader');
	
	 
	public function beforeFilter(){
		parent::beforeFilter();
		if($this->langsName == 'English'){
			$this->Gallery->tablePrefix = 'english_';
			$this->Gallery->langsName = 'English';
		}else{
			$this->Gallery->langsName = 'Bengali';
		}
	
	}
	

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Gallery->recursive = 0;
		
		if ($this->request->is('post')) {
			$this->paginate = array(
				'conditions'=>array(
					'OR'=>array(
						"Gallery.title LIKE '%".$this->request->data['Gallery']['keywords']."%'"
					)
				)
			);
		}
		$this->set('galleries', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Gallery->exists($id)) {
			throw new NotFoundException(__('Invalid gallery'));
		}
		$options = array('conditions' => array('Gallery.' . $this->Gallery->primaryKey => $id));
		$this->set('gallery', $this->Gallery->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			if(isset($data['Gallery']['image']) && $data['Gallery']['image']['error'] == 0){
				$data['Gallery']['image_extension'] = $this->Uploader->getFileExtension($data['Gallery']['image']);
				$tmpImge = $data['Gallery']['image'];
			}
			unset($data['Gallery']['image']);
				
			$this->Gallery->create();
			$datasource = $this->Gallery->getDataSource();
			try {
				$datasource->begin();
				if(!$this->Gallery->save($data)){
					throw new Exception();
				}
				$galleryId = $this->Gallery->id;
				$data['Gallery']['id'] = $galleryId;
				if(isset($tmpImge) && $tmpImge['error'] == 0){
					$this->Uploader->upload($tmpImge, $galleryId, $data['Gallery']['image_extension'], 'gallery',$fileOrImage = null, $height = '', $width = '', $oldfile = null );
				}
					
				//save data in oposite table
				if($this->langsName=='Bengali'){
					$this->Gallery->tablePrefix = 'english_';
				}else{
					$this->Gallery->tablePrefix = '';
				}
					
				if(!$this->Gallery->save($data)){
					throw new Exception();
				}
					
				$datasource->commit();
				$this->Session->setFlash('The gallery has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} catch(Exception $e) {
				$datasource->rollback();
				$this->Session->setFlash('The gallery could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
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
		if (!$this->Gallery->exists($id)) {
			throw new NotFoundException(__('Invalid gallery'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
			if(isset($data['Gallery']['image']) && $data['Gallery']['image']['error'] == 0){
				$data['Gallery']['image_extension'] = $this->Uploader->getFileExtension($data['Gallery']['image']);
				$this->Uploader->upload($data['Gallery']['image'], $id, $data['Gallery']['image_extension'], 'gallery',$fileOrImage = null, $height = '300', $width = '1080', $oldfile = null );
			}
			
			if ($this->Gallery->save($data)) {
				$this->Session->setFlash('The gallery has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The gallery could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('Gallery.' . $this->Gallery->primaryKey => $id));
			$this->request->data = $this->Gallery->find('first', $options);
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
		$this->Gallery->id = $id;
		$data = $this->Gallery->getGalleryImgExtById($id);
		if (!$this->Gallery->exists()) {
			throw new NotFoundException(__('Invalid gallery'));
		}
		$this->request->allowMethod('post', 'delete');
		$galleryData =$this->Gallery->find('first',array('fields'=> array('id','image_extension'),'conditions'=>array('id'=>$id)));
		//pr($galleryData);die();
		$datasource = $this->Gallery->getDataSource();
		try {
			$datasource->begin();
			if(!$this->Gallery->delete()){
				if(!empty($galleryData['Gallery']['image_extension'])){
					$img_file = WWW_ROOT."img".DS."site".DS."gallery".DS.$id.".".$galleryData['Gallery']['image_extension'];
					if(file_exists($img_file)){
						$this->Uploader->deleteFile($img_file);
					}
				}
				throw new Exception();
			}
			
		
			if($this->langsName=='Bengali'){
				$this->Gallery->tablePrefix = 'english_';
			}else{
				$this->Gallery->tablePrefix = '';
			}
			$this->Gallery->id = $id;
			if(!$this->Gallery->delete()){
				throw new Exception();
			}
			$datasource->commit();
			$this->Session->setFlash('The gallery has been deleted.','default',array('class'=>'alert alert-success'));
		} catch(Exception $e) {
			$datasource->rollback();
			$this->Session->setFlash('The gallery could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
