<?php
App::uses('AppController', 'Controller');
/**
 * SystemSettings Controller
 *
 * @property SystemSetting $SystemSetting
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SystemSettingsController extends AppController {

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
		$system = $this->SystemSetting->find('all');
	
		if(isset($system[0])){
			$this->redirect(array('controller'=>'system_settings','action'=>'edit',$system[0]['SystemSetting']['id'],'admin'=>true));
		}else{
			$this->redirect(array('controller'=>'system_settings','action'=>'add','admin'=>true));
		}
		/*
		$this->SystemSetting->recursive = 0;
		$this->set('systemSettings', $this->Paginator->paginate());
		*/
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->SystemSetting->exists($id)) {
			throw new NotFoundException(__('Invalid system setting'));
		}
		$options = array('conditions' => array('SystemSetting.' . $this->SystemSetting->primaryKey => $id));
		$this->set('systemSetting', $this->SystemSetting->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->SystemSetting->create();
			if ($this->SystemSetting->save($this->request->data)) {
				$this->Session->setFlash('The system setting has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The system setting could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
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
		if (!$this->SystemSetting->exists($id)) {
			throw new NotFoundException(__('Invalid system setting'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SystemSetting->save($this->request->data)) {
				$this->Session->setFlash('The system setting has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The system setting could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		} else {
			$options = array('conditions' => array('SystemSetting.' . $this->SystemSetting->primaryKey => $id));
			$this->request->data = $this->SystemSetting->find('first', $options);
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
		$this->SystemSetting->id = $id;
		if (!$this->SystemSetting->exists()) {
			throw new NotFoundException(__('Invalid system setting'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SystemSetting->delete()) {
			$this->Session->setFlash('The system setting has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The system setting could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
