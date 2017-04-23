<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	
	public function beforeFilter(){
		parent::beforeFilter();
		//$this->Auth->allow(['admin_add']);
		
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		if ($this->request->is('post')) {		
			$this->paginate = array(				
					'conditions'=>array(
							"User.role_id <>"=>'57148561-ab40-4f71-8b0f-0d00cdd1d5ac',		
							'OR'=>array(									
									"User.username LIKE '%".$this->request->data['User']['keywords']."%'" 
							)
					)
			);
		}else{
			$this->paginate = array(
				'conditions'=>array(
						"User.role_id <>"=>'57148561-ab40-4f71-8b0f-0d00cdd1d5ac'
				)
		);
		}
		
		$this->set('users', $this->Paginator->paginate());
	}

	public function admin_clientIndex() {
		$this->User->recursive = 0;
		if ($this->request->is('post')) {		
			$this->paginate = array(
					'conditions'=>array(
					 		"User.role_id"=>'57148561-ab40-4f71-8b0f-0d00cdd1d5ac',	
							'OR'=>array(								  
									"User.username LIKE '%".$this->request->data['User']['keywords']."%'" 
							)
					)
			);
		}else{
			$this->paginate = array(
				'conditions'=>array(
						"User.role_id"=>'57148561-ab40-4f71-8b0f-0d00cdd1d5ac'
				)
		);
		}
		
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$photo = $data['User']['personal_details']['photo'];
			unset($data['User']['personal_details']['photo']);
			$data['User']['personal_details'] = json_encode($data['User']['personal_details']);
			$this->User->create();
			if ($this->User->save($data)) {
				$img_id = $this->User->getInsertID();
				$this->Uploader->upload($photo, $img_id, 'png', 'avatars',$fileOrImage = null, $height = '40', $width = '', $oldfile = null);
				
				$this->Session->setFlash('The user has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The user could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		}
		$roles = $this->User->Role->find('list',array('conditions'=>array('status'=>'active','id <>'=>'57148561-ab40-4f71-8b0f-0d00cdd1d5ac')));
		$this->set(compact('roles'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null,$client=null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if($client==1){
			if ($this->request->is(array('post', 'put'))) {
				$data = $this->request->data;
				if ($this->User->save($data)) {
				$this->Session->setFlash('The user has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'clientIndex'));
				}
			}else{
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$data = $this->User->find('first', $options);
				$this->request->data = $data;
				$this->set('param',$client);
			}

		}else{
			if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
			
			$photo = $data['User']['personal_details']['photo'];
			
			
			unset($data['User']['personal_details']['photo']);
			$data['User']['personal_details'] = json_encode($data['User']['personal_details']);
			
			if ($this->User->save($data)) {
				
				$this->Uploader->upload($photo, $id, 'png', 'avatars',$fileOrImage = null, $height = '40', $width = '', $oldfile = null);
				
				$this->Session->setFlash('The user has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The user could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$data = $this->User->find('first', $options);
			$data['User']['personal_details'] = json_decode($data['User']['personal_details'],true);
			$this->request->data = $data;
		}
		$roles = $this->User->Role->find('list',array('conditions'=>array('status'=>'active')));
		$this->set('param',$client);
		$this->set(compact('roles'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$img_file = WWW_ROOT."img".DS."site".DS."avatars".DS.$id.".png";
			if(file_exists($img_file)){
				$this->Uploader->deleteFile($img_file);
			}
			$this->Session->setFlash('The user has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The user could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
/*
 * admin_login method
 */	
	
	public function admin_login(){
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				 //return  $this->redirect($this->Auth->redirectUrl());
               return  $this->redirect(array('controller'=>'products','action'=>'index','admin'=>true,'plugin'=>'ecommerce'));
			} else {
				$this->Session->setFlash(__('Username or password is incorrect'),'default',array('class'=>'alert alert-warning'));
			}
		}
	/*	if($this->Auth->login()){

			$this->redirect(array('controller'=>'products','action'=>'index','admin'=>true,'plugin'=>'ecommerce'));
		}*/
	}

	/*
	 * isAuthorized method
	 * 
	 */
	
	
	
	public function admin_signout() {
		$this->Session->destroy();
		return $this->redirect($this->Auth->logout());
	}
	
	
	public function admin_change_password(){
		if($this->request->is('post')){
			$data = $this->request->data;
			$this->User->id = $this->Auth->user('id');
			$data['User']['password'] = $data['User']['new_password'];
			if($this->User->save($data)){
				$this->Session->setFlash('Password has been changed','default',array('class'=>'alert alert-success'));
			}else{
				$this->Session->setFlash('Password can not be changed','default',array('class'=>'alert alert-warning'));
			}
			
		}
	}
	
}
