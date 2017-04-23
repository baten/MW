<?php
App::uses('TimeoutAppController', 'Timeout.Controller');
/**
 * Lookbooks Controller
 *
 * @property Lookbook $Lookbook
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class BannersController extends TimeoutAppController {

	
	
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','Uploader');
	
	public function beforeFilter(){
		parent::beforeFilter();
		if($this->langsName == 'English'){
			$this->Banner->tablePrefix = 'english_';
			$this->Banner->langsName = 'English';
		}else{
			$this->Banner->langsName = 'Bengali';
		}
	
	}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Banner->recursive = 0;
	if ($this->request->is('post')) {
			$this->paginate = array(
				'conditions'=>array(
					'OR'=>array(
						"Banner.title LIKE '%".$this->request->data['Banner']['keywords']."%'"
					)
				)
			);
		}
		$this->set('banners', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Banner->exists($id)) {
			throw new NotFoundException(__('Invalid Banner'));
		}
		$options = array('conditions' => array('Banner.' . $this->Banner->primaryKey => $id));
		$this->set('banner', $this->Banner->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$this->Banner->create();
			if(isset($data['Banner']['image']) && $data['Banner']['image']['error'] == 0){
				$data['Banner']['image_extension'] = $this->Uploader->getFileExtension($data['Banner']['image']);
				$tmpImge = $data['Banner']['image'];
			}
			unset($data['Banner']['image']);
			$datasource = $this->Banner->getDataSource();
			try {
				$datasource->begin();
				if(!$this->Banner->save($data)){
					throw new Exception();
				}
				$bannerId = $this->Banner->id;
				$data['Banner']['id'] = $bannerId;
				if(isset($tmpImge) && $tmpImge['error'] == 0){
					$this->Uploader->upload($tmpImge, $bannerId, $data['Banner']['image_extension'], 'banners',$fileOrImage = null, $height = '', $width = '', $oldfile = null );
				}
					
				//save data in oposite table
				if($this->langsName=='Bengali'){
					$this->Banner->tablePrefix = 'english_';
				}else{
					$this->Banner->tablePrefix = '';
				}
					
				if(!$this->Banner->save($data)){
					throw new Exception();
				}
					
				$datasource->commit();
				$this->Session->setFlash('The banner has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} catch(Exception $e) {
				$datasource->rollback();
				$this->Session->setFlash('The banner could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
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
		if (!$this->Banner->exists($id)) {
			throw new NotFoundException(__('Invalid Banner'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
			if(isset($data['Banner']['image']) && $data['Banner']['image']['error'] == 0){
				$data['Banner']['image_extension'] = $this->Uploader->getFileExtension($data['Banner']['image']);
				$this->Uploader->upload($data['Banner']['image'], $id, $data['Banner']['image_extension'], 'banners',$fileOrImage = null, $height = '', $width = '', $oldfile = null );
			}
			if ($this->Banner->save($data)) {
				
				$this->Session->setFlash('The lookbook has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The banner could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('Banner.' . $this->Banner->primaryKey => $id));
			$this->request->data = $this->Banner->find('first', $options);
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
		$this->Banner->id = $id;
		$data = $this->Banner->getLookbookImgExtById($id);
		if (!$this->Banner->exists()) {
			throw new NotFoundException(__('Invalid lookbook'));
		}
		$this->request->allowMethod('post', 'delete');
		$bannerData =$this->Banner->find('first',array('fields'=> array('id','image_extension'),'conditions'=>array('id'=>$id)));
		$datasource = $this->Banner->getDataSource();
		try {
			$datasource->begin();
			if(!$this->Banner->delete()){
				throw new Exception();
			}
			if(!empty($bannerData['Banner']['image_extension'])){
				$img_file = WWW_ROOT."img".DS."site".DS."banners".DS.$bannerData['Banner']['id'].".".$bannerData['Banner']['image_extension'];
				if(file_exists($img_file)){
					$this->Uploader->deleteFile($img_file);
				}
			}
			 
			if($this->langsName=='Bengali'){
				$this->Banner->tablePrefix = 'english_';
			}else{
				$this->Banner->tablePrefix = '';
			}
			$this->Banner->id = $id;
			if(!$this->Banner->delete()){
				throw new Exception();
			}
			$datasource->commit();
			$this->Session->setFlash('The banner has been deleted.','default',array('class'=>'alert alert-success'));
		} catch(Exception $e) {
			$datasource->rollback();
			$this->Session->setFlash('The banner could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
