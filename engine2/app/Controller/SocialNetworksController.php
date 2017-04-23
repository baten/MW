<?php
App::uses('AppController', 'Controller');
/**
 * SocialNetworks Controller
 *
 * @property SocialNetwork $SocialNetwork
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SocialNetworksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->SocialNetwork->recursive = 0;
		if ($this->request->is('post')) {
			$this->paginate = array(
				'conditions'=>array(
					"SocialNetwork.title LIKE '%".$this->request->data['SocialNetwork']['keywords']."%'"
				)
			);
		}else{
			$this->paginate = array('order'=>array('order'=>'ASC'));
		}
		$this->set('socialNetworks', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->SocialNetwork->exists($id)) {
			throw new NotFoundException(__('Invalid social network'));
		}
		$options = array('conditions' => array('SocialNetwork.' . $this->SocialNetwork->primaryKey => $id));
		$this->set('socialNetwork', $this->SocialNetwork->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$icon = $data['SocialNetwork']['icon'];
			
			unset($data['SocialNetwork']['icon']);
			
			$this->SocialNetwork->create();
			if ($this->SocialNetwork->save($data)) {
				
				if(!empty($this->request->data['SocialNetwork']['icon']) && $icon['error'] == 0){
					$img_id = $this->SocialNetwork->getInsertID();
					$this->Uploader->upload($icon, $img_id, 'png', 'social_icons',$fileOrImage = null, $height = '40', $width = '', $oldfile = null);
				}
				
				
				
				$this->Session->setFlash('The social network has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The social network could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
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
		if (!$this->SocialNetwork->exists($id)) {
			throw new NotFoundException(__('Invalid social network'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
			if ($this->SocialNetwork->save($data)) {
				if(isset($data['SocialNetwork']['icon']) && $data['SocialNetwork']['icon']['error'] == 0){
					$this->Uploader->upload($data['SocialNetwork']['icon'], $id, 'png', 'social_icons',$fileOrImage = null, $height = '40', $width = '', $oldfile = null);
				}
				
				$this->Session->setFlash('The social network has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The social network could not be saved. Please, try again.','default',array('class'=>'alert alert-warnging'));
			}
		} else {
			$options = array('conditions' => array('SocialNetwork.' . $this->SocialNetwork->primaryKey => $id));
			$this->request->data = $this->SocialNetwork->find('first', $options);
		}
	}
	
	
	/**
	 * sort_socialnetwork method
	 *
	 * @return void
	 */
	public function admin_sort_socialnetwork() {
	 
		$this->SocialNetwork->recursive = 0;
		if ($this->request->is('post')) {
			$data = $this->request->data;
			if(isset($data['BtnOrder'])){
				$i = 1;
				foreach ($data['SocialNetwork']['id'] AS $datum){
					$this->SocialNetwork->id = $datum;
					$this->SocialNetwork->saveField('order', $i);
					$i++;
				}
				
				$this->Session->setFlash('Social Networks has been sorted','default',array('class'=>'alert alert-success'));
				return $this->redirect('sort_socialnetwork');
			}else{
				$this->paginate = array(
					'conditions'=>array(
						"SocialNetwork.title LIKE '%".$this->request->data['SocialNetwork']['keywords']."%'"
					)
				);
					
			}
			
			
		}else{
			$this->paginate = array('order'=>array('order'=>'ASC'));
		}
		$this->set('socialNetworks', $this->Paginator->paginate());
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->SocialNetwork->id = $id;
		if (!$this->SocialNetwork->exists()) {
			throw new NotFoundException(__('Invalid social network'));
		}
		$this->request->allowMethod('post', 'delete');
		
		if ($this->SocialNetwork->delete()) {
			
			$img_file = WWW_ROOT."img".DS."site".DS."social_icons".DS.$id.".png";
			if(file_exists($img_file)){
				$this->Uploader->deleteFile($img_file);
			}
			
			
			$this->Session->setFlash('The social network has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The social network could not be deleted. Please, try again.','default',array('class'=>'alert alert-warnging'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
