<?php
App::uses('EcommerceAppController', 'Ecommerce.Controller');
/**
 * toppers Controller
 *
 * @property Attribute $Attribute
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ToppersController extends EcommerceAppController {

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
		$this->Topper->recursive = 0;
		$this->set('toppers', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Topper->exists($id)) {
			throw new NotFoundException(__('Invalid topper'));
		}
		$options = array('conditions' => array('Topper.' . $this->Topper->primaryKey => $id));
		$this->set('topper', $this->Topper->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Topper->create();
			if ($this->Topper->save($this->request->data)) {
				$this->Session->setFlash('The topper has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The topper could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
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
		if (!$this->Topper->exists($id)) {
			throw new NotFoundException(__('Invalid topper'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Topper->save($this->request->data)) {
				$this->Session->setFlash('The topper has been saved.','default',array('class'=>'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The topper could not be saved. Please, try again.','default',array('class'=>'alert alert-warning'));
			}
		} else {
			$options = array('conditions' => array('Topper.' . $this->Topper->primaryKey => $id));
			$this->request->data = $this->Topper->find('first', $options);
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
		$this->Topper->id = $id;
		if (!$this->Topper->exists()) {
			throw new NotFoundException(__('Invalid topper'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Topper->delete()) {
			$this->Session->setFlash('The topper has been deleted.','default',array('class'=>'alert alert-success'));
		} else {
			$this->Session->setFlash('The topper could not be deleted. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
