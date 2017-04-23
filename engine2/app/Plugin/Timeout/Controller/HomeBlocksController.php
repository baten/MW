<?php
App::uses('TimeoutAppController', 'Timeout.Controller');
/**
 * HomeBlocks Controller
 *
 * @property HomeBlock $HomeBlock
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class HomeBlocksController extends TimeoutAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session','Uploader');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->HomeBlock->recursive = 0;
		
		if ($this->request->is('post')) {
			$this->paginate = array(
					'conditions'=>array(
						'OR'=>array(
							"HomeBlock.title LIKE '%".$this->request->data['HomeBlock']['keywords']."%'"
					)
				)
			);
		}
		$this->set('homeBlocks', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->HomeBlock->exists($id)) {
			throw new NotFoundException(__('Invalid home block'));
		}
		$options = array('conditions' => array('HomeBlock.' . $this->HomeBlock->primaryKey => $id));
		$this->set('homeBlock', $this->HomeBlock->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			
			if(isset($data['HomeBlock']['image']) && $data['HomeBlock']['image']['error'] == 0){
				$data['HomeBlock']['image_extension'] = $this->Uploader->getFileExtension($data['HomeBlock']['image']);
			}else{
				$data['HomeBlock']['image_extension'] = '';
			}
				
			$this->HomeBlock->create();
			if ($this->HomeBlock->save($data)) {
				$image_id = $this->HomeBlock->getInsertID();
				if(isset($data['HomeBlock']['image']) && $data['HomeBlock']['image']['error'] == 0){
					$this->Uploader->upload($data['HomeBlock']['image'], $image_id, $data['HomeBlock']['image_extension'], 'homeblock',$fileOrImage = null, $height = '150', $width = '200', $oldfile = null );
				}
				$this->Session->setFlash('The home block has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The home block could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
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
		if (!$this->HomeBlock->exists($id)) {
			throw new NotFoundException(__('Invalid home block'));
		}
		if ($this->request->is(array('post', 'put'))) {
			
			$data = $this->request->data;
			
			if(isset($data['HomeBlock']['image']) && $data['HomeBlock']['image']['error'] == 0){
				$data['HomeBlock']['image_extension'] = $this->Uploader->getFileExtension($data['HomeBlock']['image']);
				$this->Uploader->upload($data['HomeBlock']['image'], $id, $data['HomeBlock']['image_extension'] , 'homeblock', $fileOrImage = null, $height = '150', $width = '200', $oldfile = null );
			}
			
			
			if ($this->HomeBlock->save($data)) {
				$this->Session->setFlash('The home block has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The home block could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('HomeBlock.' . $this->HomeBlock->primaryKey => $id));
			$this->request->data = $this->HomeBlock->find('first', $options);
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
		$this->HomeBlock->id = $id;
		$data = $this->HomeBlock->getHomeblockImgExtById($id);
		if (!$this->HomeBlock->exists()) {
			throw new NotFoundException(__('Invalid home block'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->HomeBlock->delete()) {
			if(!empty($data)){
				$img_file = WWW_ROOT."img".DS."site".DS."homeblock".DS.$id.".".$data['HomeBlock']['image_extension'];
				if(file_exists($img_file)){
					$this->Uploader->deleteFile($img_file);
				}
			}
			$this->Session->setFlash('The home block has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The home block could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
